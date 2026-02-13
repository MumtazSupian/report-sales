<?php

namespace App\Http\Controllers\evaluasi;

use App\Http\Controllers\Controller;
use App\Models\evaluasi\EvaluasiWiraniaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EvaluasiExport;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluasiWiraniagaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

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
        $data['cabang'] = $user->cabang;

        EvaluasiWiraniaga::create($data);

        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'BM' && $row->cabang != $user->cabang) {
            return redirect()->route('evaluasi.index')->with('error', 'Akses dilarang!');
        }

        return view('evaluasi.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'BM' && $row->cabang != $user->cabang) {
            return redirect()->route('evaluasi.index')->with('error', 'Update ditolak.');
        }

        $data = $request->all();

        // Hitung ulang Total & Grading saat update
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

        if ($user->role == 'BM' && $row->cabang != $user->cabang) {
            return redirect()->route('evaluasi.index')->with('error', 'Tidak boleh menghapus data cabang lain!');
        }

        $row->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Logika Perhitungan Grading Dinamis
     */
    private function calculateTotalAndGrading($request)
    {
        $months = [
            (int)$request->input('jan', 0),
            (int)$request->input('feb', 0),
            (int)$request->input('mar', 0),
            (int)$request->input('apr', 0),
            (int)$request->input('mei', 0),
            (int)$request->input('jun', 0),
        ];

        $total6Bulan = array_sum($months);

        // 1. Cari index bulan pertama aktif (penjualan > 0)
        $firstIdx = -1;
        foreach ($months as $idx => $val) {
            if ($val > 0) {
                $firstIdx = $idx;
                break;
            }
        }

        // Jika tidak ada penjualan sama sekali
        if ($firstIdx === -1) {
            return ['total' => 0, 'grading' => "TRAINEE -> EVALUASI"];
        }

        // 2. Ambil 3 bulan SEJAK AKTIF (Window 3 Bulan Pertama)
        $data3BulanAwal = array_slice($months, $firstIdx, 3);
        $total3Awal = array_sum($data3BulanAwal);
        $avg3Awal = $total3Awal / count($data3BulanAwal);

        // 3. Ambil 3 bulan TERAKHIR (Apr-Jun) untuk deteksi kenaikan performa saat edit
        $data3BulanAkhir = array_slice($months, 3, 3);
        $total3Akhir = array_sum($data3BulanAkhir);
        $avg3Akhir = $total3Akhir / 3;

        // Rata-rata 6 bulan (dihitung sejak bulan aktif)
        $avg6 = $total6Bulan / (6 - $firstIdx);

        // LOGIKA PENENTUAN GRADING
        if ($avg6 >= 5 && $total6Bulan >= 31) {
            $grading = "PLATINUM";
        } elseif ($avg6 >= 4 && $total6Bulan >= 25) {
            $grading = "GOLD -> KADAR PLATINUM";
        }
        // Cek performa 3 bulan awal ATAU performa kenaikan di 3 bulan akhir
        elseif ($avg3Awal >= 2 || $total3Awal >= 7 || $avg3Akhir >= 2 || $total3Akhir >= 6) {
            $grading = "SILVER -> KADAR GOLD";
        } elseif ($avg3Awal >= 1) {
            $grading = "TRAINEE -> KADAR SILVER";
        } else {
            $grading = "TRAINEE -> EVALUASI";
        }

        return [
            'total' => $total6Bulan,
            'grading' => $grading
        ];
    }

    public function exportExcel()
    {
        return Excel::download(new EvaluasiExport, 'evaluasi-wiraniaga.xlsx');
    }
    public function exportPdf()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = EvaluasiWiraniaga::orderBy('nama_sales')->get();
        } else {
            $data = EvaluasiWiraniaga::where('cabang', $user->cabang)->orderBy('nama_sales')->get();
        }

        $grandTotal = $data->sum('total');

        $pdf = Pdf::loadView('evaluasi.export_pdf', compact('data', 'grandTotal'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('evaluasi-wiraniaga.pdf');
    }
}
