<?php

namespace App\Http\Controllers\summary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\summary\Summary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SummaryExport;
use Barryvdh\DomPDF\Facade\Pdf;


class SummaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Jika user pusat/admin, tampilkan semua data.
        // Jika user cabang, filter berdasarkan kolom 'cabang'.
        if (in_array($user->role, $pusatRoles)) {
            $summaries = Summary::all();
        } else {
            $summaries = Summary::where('cabang', $user->cabang)->get();
        }

        return view('summary.summary.index', compact('summaries'));
    }

    public function create()
    {
        return view('summary.summary.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

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
            'cabang'           => $user->cabang, // Otomatis simpan cabang dari user login
        ]);

        return redirect()->route('summary.summary.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $summary = Summary::findOrFail($id);
        $user = Auth::user();

        // Keamanan: Cegah user edit data milik cabang lain
        if ($user->role == 'BM' && $summary->cabang != $user->cabang) {
            return redirect()->route('summary.summary.index')->with('error', 'Akses dilarang!');
        }

        return view('summary.summary.edit', compact('summary'));
    }

    public function update(Request $request, $id)
    {
        $summary = Summary::findOrFail($id);
        $user = Auth::user();

        // Proteksi sisi server
        if ($user->role == 'BM' && $summary->cabang != $user->cabang) {
            return redirect()->route('summary.summary.index')->with('error', 'Update ditolak.');
        }

        $request->validate([
            'operasional'       => 'required|in:Jumlah Sales Force by Grading,Jumlah Inquiry by Type,Jumlah Activity by Type,Source Of Inquiry,Issue,Usulan',
            'plan_perbaikan'    => 'nullable|string',
            'aktual_perbaikan'  => 'nullable|string',
            'do_dont'           => 'nullable|in:X,V',
        ]);

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
        $summary = Summary::findOrFail($id);
        $user = Auth::user();

        // Proteksi hapus data cabang lain
        if ($user->role == 'BM' && $summary->cabang != $user->cabang) {
            return redirect()->route('summary.summary.index')->with('error', 'Dilarang menghapus data cabang lain!');
        }

        $summary->delete();

        return redirect()->route('summary.summary.index')
            ->with('success', 'Data berhasil dihapus');
    }
    public function exportExcel()
    {
        // Class Excel sekarang sudah dikenali karena ada 'use' di atas
        return Excel::download(new SummaryExport, 'summary-improvement.xlsx');
    }

    public function exportPdf()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];
        if (in_array($user->role, $pusatRoles)) {
            $summaries = Summary::all();
        } else {
            $summaries = Summary::where('cabang', $user->cabang)->get();
        }
        $pdf = Pdf::loadView('summary.summary.export_pdf', compact('summaries'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('summary-improvement.pdf');
    }
}
