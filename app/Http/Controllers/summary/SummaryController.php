<?php

namespace App\Http\Controllers\summary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\summary\Summary;

class SummaryController extends Controller
{
    public function index()
    {
        $summaries = Summary::all();
        return view('summary.summary.index', compact('summaries'));
    }

    public function create()
    {
        return view('summary.summary.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'operasional'       => 'required|in:Jumlah Sales Force by Grading,Jumlah Inquiry by Type,Jumlah Activity by Type,Source Of Inquiry,Issue,Usulan',
            'plan_perbaikan'    => 'nullable|string',
            'aktual_perbaikan'  => 'nullable|string',
            'do_dont'           => 'nullable|in:X,V',
        ]);

        Summary::create([
            'operasional'      => $request->operasional,
            'plan_perbaikan'   => $request->plan_perbaikan,
            'aktual_perbaikan' => $request->aktual_perbaikan,
            'do_dont'          => $request->do_dont,
        ]);

        return redirect()->route('summary.summary.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $summary = Summary::findOrFail($id);
        return view('summary.summary.edit', compact('summary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'operasional'       => 'required|in:Jumlah Sales Force by Grading,Jumlah Inquiry by Type,Jumlah Activity by Type,Source Of Inquiry,Issue,Usulan',
            'plan_perbaikan'    => 'nullable|string',
            'aktual_perbaikan'  => 'nullable|string',
            'do_dont'           => 'nullable|in:X,V',
        ]);

        $summary = Summary::findOrFail($id);

        $summary->update([
            'operasional'      => $request->operasional,
            'plan_perbaikan'   => $request->plan_perbaikan,
            'aktual_perbaikan' => $request->aktual_perbaikan,
            'do_dont'          => $request->do_dont,
        ]);

        return redirect()->route('summary.summary.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Summary::findOrFail($id)->delete();

        return redirect()->route('summary.summary.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
