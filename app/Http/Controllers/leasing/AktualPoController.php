<?php

namespace App\Http\Controllers\leasing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\leasing\AktualPo;

class AktualPoController extends Controller
{
    public function index()
    {
        $data = AktualPo::all();
        return view('leasing.aktual_po.index', compact('data'));
    }

    public function create()
    {
        return view('leasing.aktual_po.create');
    }

    public function store(Request $request)
    {
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
        ]);

        return redirect()->route('leasing.aktual-po.index');
    }

    public function edit($id)
    {
        $data = AktualPo::findOrFail($id);
        return view('leasing.aktual_po.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = AktualPo::findOrFail($id);

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
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = AktualPo::findOrFail($id);
        $data->delete();

        return redirect()->route('leasing.aktual-po.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
