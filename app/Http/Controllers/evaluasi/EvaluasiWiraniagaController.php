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

        // total keseluruhan (seperti Excel bagian bawah)
        $grandTotal = $data->sum('total');

        return view('evaluasi.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        return view('evaluasi.create');
    }

    // Cari bagian public function store dan ganti isinya dengan ini:
public function store(Request $request)
{
    $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun'];
    $data = $request->all();

    // Hitung Total
    $total = 0;
    foreach ($months as $m) {
        $total += $request->input($m, 0);
    }
    $data['total'] = $total;

    // Hitung Grading Otomatis (berdasarkan rata-rata Jan-Mar sesuai permintaanmu)
    $data['grading'] = EvaluasiWiraniaga::hitungPeringkat(
        $request->input('jan', 0),
        $request->input('feb', 0),
        $request->input('mar', 0)
    );

    EvaluasiWiraniaga::create($data);

    return redirect()->route('evaluasi.index')->with('success', 'Data berhasil disimpan dengan peringkat ' . $data['grading']);
}

// Lakukan hal yang sama untuk public function update:
public function update(Request $request, $id)
{
    $row = EvaluasiWiraniaga::findOrFail($id);
    $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun'];
    $data = $request->all();

    $total = 0;
    foreach ($months as $m) {
        $total += $request->input($m, 0);
    }
    $data['total'] = $total;

    $data['grading'] = EvaluasiWiraniaga::hitungPeringkat(
        $request->input('jan', 0),
        $request->input('feb', 0),
        $request->input('mar', 0)
    );

    $row->update($data);

    return redirect()->route('evaluasi.index')->with('success', 'Data berhasil diperbarui');
}

    public function destroy($id)
    {
        EvaluasiWiraniaga::findOrFail($id)->delete();

        return redirect()->route('evaluasi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
