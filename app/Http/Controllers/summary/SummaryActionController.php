<?php

namespace App\Http\Controllers\summary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\summary\SummaryAction;

class SummaryActionController extends Controller
{
    public function index()
    {
        $summary_actions = SummaryAction::orderBy('id', 'desc')->get();
        return view('summary.summaryaction.index', compact('summary_actions'));
    }
    public function create()
    {
        return view('summary.summaryaction.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'operasional' => 'required|string',
            'kondisi_yang_ada' => 'nullable|string',
            'action_perbaikan' => 'nullable|string',
            'do_dont' => 'nullable|in:X,V',
        ]);

        SummaryAction::create([
            'operasional' => $request->operasional,
            'kondisi_yang_ada' => $request->kondisi_yang_ada,
            'action_perbaikan' => $request->action_perbaikan,
            'do_dont' => $request->do_dont,
        ]);

        return redirect()->route('summary.summaryaction.index')
            ->with('success', 'Data berhasil disimpan');
    }
    public function edit($id)
    {
        $summary_actions = SummaryAction::findOrFail($id);
        return view('summary.summaryaction.edit', compact('summary_actions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'operasional' => 'required|string',
            'kondisi_yang_ada' => 'nullable|string',
            'action_perbaikan' => 'nullable|string',
            'do_dont' => 'nullable|in:X,V',
        ]);

        $summary_actions = SummaryAction::findOrFail($id);

        $summary_actions->update([
            'operasional' => $request->operasional,
            'kondisi_yang_ada' => $request->kondisi_yang_ada,
            'action_perbaikan' => $request->action_perbaikan,
            'do_dont' => $request->do_dont,
        ]);

        return redirect()->route('summary.summaryaction.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        SummaryAction::findOrFail($id)->delete();

        return redirect()->route('summary.summaryaction.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
