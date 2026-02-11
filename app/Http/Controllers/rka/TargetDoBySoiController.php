<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetDoBySoi;
use Illuminate\Support\Facades\Auth;

class TargetDoBySoiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = TargetDoBySoi::all();
        } else {
            $data = TargetDoBySoi::where('cabang', $user->cabang)->get();
        }

        return view('rka.target_do_by_soi.index', compact('data'));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['BM'])) {
            return redirect()->route('rka.target-do-by-soi.index')->with('error', 'Hanya BM yang dapat menambah data.');
        }
        return view('rka.target_do_by_soi.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'BM') {
            return redirect()->route('rka.target-do-by-soi.index')->with('error', 'Akses ditolak.');
        }

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        TargetDoBySoi::create([
            'source_inquiry' => $request->source_inquiry,
            'tahun' => $request->tahun,
            'jan' => $request->jan,
            'feb' => $request->feb,
            'mar' => $request->mar,
            'apr' => $request->apr,
            'mei' => $request->mei,
            'jun' => $request->jun,
            'jul' => $request->jul,
            'agu' => $request->agu,
            'sep' => $request->sep,
            'okt' => $request->okt,
            'nov' => $request->nov,
            'des' => $request->des,
            'total' => $total,
            'cabang' => $user->cabang, 
        ]);

        return redirect()->route('rka.target-do-by-soi.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = TargetDoBySoi::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-do-by-soi.index')->with('error', 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        return view('rka.target_do_by_soi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TargetDoBySoi::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-do-by-soi.index')->with('error', 'Akses ilegal.');
        }

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        $data->update([
            'source_inquiry' => $request->source_inquiry,
            'tahun' => $request->tahun,
            'jan' => $request->jan,
            'feb' => $request->feb,
            'mar' => $request->mar,
            'apr' => $request->apr,
            'mei' => $request->mei,
            'jun' => $request->jun,
            'jul' => $request->jul,
            'agu' => $request->agu,
            'sep' => $request->sep,
            'okt' => $request->okt,
            'nov' => $request->nov,
            'des' => $request->des,
            'total' => $total,
        ]);

        return redirect()->route('rka.target-do-by-soi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = TargetDoBySoi::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-do-by-soi.index')->with('error', 'Anda tidak boleh menghapus data ini.');
        }

        $data->delete();

        return redirect()->route('rka.target-do-by-soi.index')->with('success', 'Data berhasil dihapus');
    }
}
    