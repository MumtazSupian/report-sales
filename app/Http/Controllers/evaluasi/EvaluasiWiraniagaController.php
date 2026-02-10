<?php

namespace App\Http\Controllers\evaluasi;

use App\Http\Controllers\Controller;
use App\Models\evaluasi\EvaluasiWiraniaga;
use Illuminate\Http\Request;

class EvaluasiWiraniagaController extends Controller
{
    public function index()
    {
        $data = EvaluasiWiraniaga::orderBy('nama_sales')->get();
        $grandTotal = $data->sum('total');

        return view('evaluasi.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        return view('evaluasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Hitung Total & Grading secara otomatis di sisi Server
        $calculated = $this->calculateTotalAndGrading($request);
        $data['total'] = $calculated['total'];
        $data['grading'] = $calculated['grading'];

        EvaluasiWiraniaga::create($data);

        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * INI FUNGSI YANG TADI HILANG
     * Menampilkan halaman formulir edit
     */
    public function edit($id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        return view('evaluasi.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $data = $request->all();

        // Hitung Total & Grading secara otomatis di sisi Server sebelum update
        $calculated = $this->calculateTotalAndGrading($request);
        $data['total'] = $calculated['total'];
        $data['grading'] = $calculated['grading'];

        $row->update($data);

        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        EvaluasiWiraniaga::findOrFail($id)->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Data berhasil dihapus');
    }

    /**
     * FUNGSI TAMBAHAN (Helper)
     * Untuk menghitung Total dan Grading sesuai revisi terbaru kamu
     */
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

        // Logika sesuai revisi permintaanmu
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
