<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetDoUnit;

class TargetDoUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TargetDoUnit::all();
        return view('rka.target_do_units.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rka.target_do_units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        \App\Models\rka\TargetDoUnit::create([
            'mobil_type' => $request->mobil_type,
            'tahun'      => $request->tahun,
            'jan'        => $request->jan,
            'feb'        => $request->feb,
            'mar'        => $request->mar,
            'apr'        => $request->apr,
            'mei'        => $request->mei,
            'jun'        => $request->jun,
            'jul'        => $request->jul,
            'agu'        => $request->agu,
            'sep'        => $request->sep,
            'okt'        => $request->okt,
            'nov'        => $request->nov,
            'des'        => $request->des,
            'total'      => $total,
        ]);

        return redirect()->route('rka.target-do-units.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = TargetDoUnit::findOrFail($id);
        return view('rka.target_do_units.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = TargetDoUnit::findOrFail($id);

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        $data->update([
            'mobil_type' => $request->mobil_type,
            'tahun'      => $request->tahun,
            'jan'        => $request->jan,
            'feb'        => $request->feb,
            'mar'        => $request->mar,
            'apr'        => $request->apr,
            'mei'        => $request->mei,
            'jun'        => $request->jun,
            'jul'        => $request->jul,
            'agu'        => $request->agu,
            'sep'        => $request->sep,
            'okt'        => $request->okt,
            'nov'        => $request->nov,
            'des'        => $request->des,
            'total'      => $total,
        ]);

        return redirect()->route('rka.target-do-units.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TargetDoUnit::findOrFail($id);
        $data->delete();

        return redirect()->route('rka.target-do-units.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
