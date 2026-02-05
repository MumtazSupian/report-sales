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

    public function store(Request $request)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun'];

        $data = $request->only([
            'nama_sales_head',
            'nama_sales',
            'tanggal_masuk',
            'tanggal_evaluasi',
            'grading',
            'evaluasi',
            'tanggal_keluar'
        ]);

        $data['total'] = 0;

        foreach ($months as $m) {
            $data[$m] = $request->input($m, 0);
            $data['total'] += $data[$m];
        }

        EvaluasiWiraniaga::create($data);

        return redirect()->route('evaluasi.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        return view('evaluasi.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = EvaluasiWiraniaga::findOrFail($id);
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun'];

        $data = $request->only([
            'nama_sales_head',
            'nama_sales',
            'tanggal_masuk',
            'tanggal_evaluasi',
            'grading',
            'evaluasi',
            'tanggal_keluar'
        ]);

        $data['total'] = 0;

        foreach ($months as $m) {
            $data[$m] = $request->input($m, 0);
            $data['total'] += $data[$m];
        }

        $row->update($data);

        return redirect()->route('evaluasi.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        EvaluasiWiraniaga::findOrFail($id)->delete();

        return redirect()->route('evaluasi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
