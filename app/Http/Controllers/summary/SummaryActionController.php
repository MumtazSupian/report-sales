<?php

namespace App\Http\Controllers\summary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\summary\SummaryAction;
use Illuminate\Support\Facades\Auth;
use App\Exports\SummaryActionExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SummaryActionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Jika user pusat, tampilkan semua. Jika bukan (cabang), tampilkan per cabang.
        if (in_array($user->role, $pusatRoles)) {
            $summary_actions = SummaryAction::orderBy('id', 'desc')->get();
        } else {
            $summary_actions = SummaryAction::where('cabang', $user->cabang)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('summary.summaryaction.index', compact('summary_actions'));
    }

    public function create()
    {
        return view('summary.summaryaction.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

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
            'cabang' => $user->cabang, // Otomatis mengisi kolom cabang sesuai login
        ]);

        return redirect()->route('summary.summaryaction.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $summary_actions = SummaryAction::findOrFail($id);
        $user = Auth::user();

        // Proteksi Keamanan URL: Mencegah user cabang mengedit data milik cabang lain
        if ($user->role == 'BM' && $summary_actions->cabang != $user->cabang) {
            return redirect()->route('summary.summaryaction.index')->with('error', 'Akses dilarang!');
        }

        return view('summary.summaryaction.edit', compact('summary_actions'));
    }

    public function update(Request $request, $id)
    {
        $summary_actions = SummaryAction::findOrFail($id);
        $user = Auth::user();

        // Proteksi sisi server
        if ($user->role == 'BM' && $summary_actions->cabang != $user->cabang) {
            return redirect()->route('summary.summaryaction.index')->with('error', 'Update ditolak.');
        }

        $request->validate([
            'operasional' => 'required|string',
            'kondisi_yang_ada' => 'nullable|string',
            'action_perbaikan' => 'nullable|string',
            'do_dont' => 'nullable|in:X,V',
        ]);

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
        $summary_actions = SummaryAction::findOrFail($id);
        $user = Auth::user();

        // Proteksi hapus data cabang lain
        if ($user->role == 'BM' && $summary_actions->cabang != $user->cabang) {
            return redirect()->route('summary.summaryaction.index')->with('error', 'Waduh, mau hapus punya siapa?');
        }

        $summary_actions->delete();

        return redirect()->route('summary.summaryaction.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new SummaryActionExport, 'summary-action.xlsx');
    }

    public function exportPdf()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $actions = SummaryAction::all();
        } else {
            $actions = SummaryAction::where('cabang', $user->cabang)->get();
        }

        $pdf = Pdf::loadView('summary.summaryaction.export_pdf', compact('actions'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('summary-action.pdf');
    }
}
