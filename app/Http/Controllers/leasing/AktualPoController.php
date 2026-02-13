<?php

namespace App\Http\Controllers\leasing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\leasing\AktualPo;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktualPoExport;

class AktualPoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = AktualPo::all();
        } else {
            $data = AktualPo::where('cabang', $user->cabang)->get();
        }

        return view('leasing.aktual_po.index', compact('data'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'BM') {
            return redirect()->route('leasing.aktual-po.index')->with('error', 'Akses terbatas.');
        }
        return view('leasing.aktual_po.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'BM') {
            return redirect()->route('leasing.aktual-po.index')->with('error', 'Hanya BM yang dapat menambah data.');
        }

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        AktualPo::create([
            'leasing' => $request->leasing,
            'tahun'   => $request->tahun,
            'jan'     => $request->jan,
            'feb'     => $request->feb,
            'mar'     => $request->mar,
            'apr'     => $request->apr,
            'mei'     => $request->mei,
            'jun'     => $request->jun,
            'jul'     => $request->jul,
            'agu'     => $request->agu,
            'sep'     => $request->sep,
            'okt'     => $request->okt,
            'nov'     => $request->nov,
            'des'     => $request->des,
            'total'   => $total,
            'cabang'  => $user->cabang,
        ]);

        return redirect()->route('leasing.aktual-po.index')->with('success', 'Data Aktual PO berhasil disimpan');
    }

    public function edit($id)
    {
        $data = AktualPo::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('leasing.aktual-po.index')->with('error', 'Akses edit ditolak.');
        }

        return view('leasing.aktual_po.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = AktualPo::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('leasing.aktual-po.index')->with('error', 'Anda tidak berwenang mengupdate data ini.');
        }

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        $data->update([
            'leasing' => $request->leasing,
            'tahun'   => $request->tahun,
            'jan'     => $request->jan,
            'feb'     => $request->feb,
            'mar'     => $request->mar,
            'apr'     => $request->apr,
            'mei'     => $request->mei,
            'jun'     => $request->jun,
            'jul'     => $request->jul,
            'agu'     => $request->agu,
            'sep'     => $request->sep,
            'okt'     => $request->okt,
            'nov'     => $request->nov,
            'des'     => $request->des,
            'total'   => $total,
        ]);

        return redirect()->route('leasing.aktual-po.index')
            ->with('success', 'Data PO berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = AktualPo::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('leasing.aktual-po.index')->with('error', 'Hanya BM pemilik data yang boleh menghapus.');
        }

        $data->delete();

        return redirect()->route('leasing.aktual-po.index')
            ->with('success', 'Data PO berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new AktualPoExport, 'Aktual-PO.xlsx');
    }

    public function exportPdf()
    {
        $user = Auth::user();
        if (in_array($user->role, ['Admin', 'OM', 'Admin DCA', 'OM DCA'])) {
            $data = AktualPo::all();
        } else {
            $data = AktualPo::where('cabang', $user->cabang)->get();
        }

        $pdf = Pdf::loadView('leasing.aktual_po.pdf', compact('data'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Aktual-PO.pdf');
    }
}
