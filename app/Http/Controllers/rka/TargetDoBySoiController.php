<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetDoBySoi;

class TargetDoBySoiController extends Controller
{
    public function index()
    {
        $data = TargetDoBySoi::all();
        return view('rka.target_do_by_soi.index', compact('data'));
    }

    public function create()
    {
        return view('rka.target_do_by_soi.create');
    }

    public function store(Request $request)
    {
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
        ]);

        return redirect()->route('rka.target-do-by-soi.index');
    }

    public function edit($id)
    {
        $data = TargetDoBySoi::findOrFail($id);
        return view('rka.target_do_by_soi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TargetDoBySoi::findOrFail($id);

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

        return redirect()->route('rka.target-do-by-soi.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = TargetDoBySoi::findOrFail($id);
        $data->delete();

        return redirect()->route('rka.target-do-by-soi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
