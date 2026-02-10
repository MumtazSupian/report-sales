<?php

namespace App\Http\Controllers\leasing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\leasing\AktualReject;
use Illuminate\Support\Facades\Auth;

class AktualRejectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = AktualReject::all();
        } else {
            $data = AktualReject::where('cabang', $user->cabang)->get();
        }

        return view('leasing.aktual_reject.index', compact('data'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'BM') {
            return redirect()->route('leasing.aktual-reject.index')->with('error', 'Akses ditolak.');
        }
        return view('leasing.aktual_reject.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'BM') {
            return redirect()->route('leasing.aktual-reject.index')->with('error', 'Hanya BM yang bisa menambah data.');
        }

        $total = $request->jan + $request->feb + $request->mar + $request->apr + $request->mei + $request->jun +
                 $request->jul + $request->agu + $request->sep + $request->okt + $request->nov + $request->des;

        AktualReject::create([
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

        return redirect()->route('leasing.aktual-reject.index')->with('success', 'Data Aktual Reject berhasil disimpan');
    }

    public function edit($id)
    {
        $data = AktualReject::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('leasing.aktual-reject.index')->with('error', 'Anda tidak punya akses ke data ini.');
        }

        return view('leasing.aktual_reject.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = AktualReject::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('leasing.aktual-reject.index')->with('error', 'Update ditolak.');
        }

        $total = $request->jan + $request->feb + $request->mar + $request->apr + $request->mei + $request->jun +
                 $request->jul + $request->agu + $request->sep + $request->okt + $request->nov + $request->des;

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

        return redirect()->route('leasing.aktual-reject.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = AktualReject::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('leasing.aktual-reject.index')
                ->with('error', 'Hanya BM pemilik data yang boleh menghapus.');
        }

        $data->delete();

        return redirect()->route('leasing.aktual-reject.index')
            ->with('success', 'Data berhasil dihapus');
    }
}