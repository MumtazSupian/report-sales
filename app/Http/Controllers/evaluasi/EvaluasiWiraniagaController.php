<?php

namespace App\Http\Controllers\evaluasi;

use App\Http\Controllers\Controller;
use App\Models\evaluasi\EvaluasiWiraniaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan

class EvaluasiWiraniagaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter: Pusat melihat semua, Cabang hanya melihat wiraniaga di cabangnya
        if (in_array($user->role, $pusatRoles)) {
            $data = EvaluasiWiraniaga::orderBy('nama_sales')->get();
        } else {
            $data = EvaluasiWiraniaga::where('cabang', $user->cabang)
                ->orderBy('nama_sales')
                ->get();
        }

        $grandTotal = $data->sum('total');

        return view('evaluasi.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        return view('evaluasi.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        // Hitung Total & Grading secara otomatis di sisi Server
        $calculated = $this->calculateTotalAndGrading($request);
        $data['total'] = $calculated['total'];
        $data['grading'] = $calculated['grading'];

        // Tambahkan cabang otomatis dari user yang sedang login
        $data['cabang'] = $user->cabang;

        EvaluasiWiraniaga::create($data);

        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $user = Auth::user();

        // Keamanan: Cabang tidak boleh edit evaluasi wiraniaga cabang lain
        if ($user->role == 'BM' && $row->cabang != $user->cabang) {
            return redirect()->route('evaluasi.index')->with('error', 'Akses dilarang!');
        }

        return view('evaluasi.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $user = Auth::user();

        // Proteksi sisi server
        if ($user->role == 'BM' && $row->cabang != $user->cabang) {
            return redirect()->route('evaluasi.index')->with('error', 'Update ditolak.');
        }

        $data = $request->all();

        // Hitung Total & Grading secara otomatis sebelum update
        $calculated = $this->calculateTotalAndGrading($request);
        $data['total'] = $calculated['total'];
        $data['grading'] = $calculated['grading'];

        $row->update($data);

        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $user = Auth::user();

        // Proteksi Hapus
        if ($user->role == 'BM' && $row->cabang != $user->cabang) {
            return redirect()->route('evaluasi.index')->with('error', 'Tidak boleh menghapus data cabang lain!');
        }

        $row->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil dihapus');
    }

    private function calculateTotalAndGrading($request)
    {
        $jan = (int)$request->input('jan', 0);
        $feb = (int)$request->input('feb', 0);
        $mar = (int)$request->input('mar', 0);
        $apr = (int)$request->input('apr', 0);
        $mei = (int)$request->input('mei', 0);
        $jun = (int)$request->input('jun', 0);

        $total3Bulan = $jan + $feb + $mar;
        $total6Bulan = $total3Bulan + $apr + $mei + $jun;

        $avg3 = $total3Bulan / 3;
        $avg6 = $total6Bulan / 6;

        if ($avg6 >= 5 && $total6Bulan >= 31) {
            $grading = "PLATINUM";
        } elseif ($avg6 >= 4 && $total6Bulan >= 25) {
            $grading = "GOLD -> KADAR PLATINUM";
        } elseif ($avg3 >= 2 && $total3Bulan >= 7) {
            $grading = "SILVER -> KADAR GOLD";
        } elseif ($avg3 >= 1) {
            $grading = "TRAINEE -> KADAR SILVER";
        } else {
            $grading = "TRAINEE -> EVALUASI";
        }

        return [
            'total' => $total6Bulan,
            'grading' => $grading
        ];
    }
}
