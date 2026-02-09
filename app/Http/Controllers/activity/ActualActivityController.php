<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\ActualActivity; 
use Illuminate\Http\Request;

class ActualActivityController extends Controller
{
    public function index()
    {
        $data = ActualActivity::all();
        return view('activity.actual.index', compact('data'));
    }

    public function create()
    {
        return view('activity.actual.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $total = $request->total_cost ?? 0;

        $data['cost_p'] = ($request->actual_p > 0) ? $total / $request->actual_p : 0;
        $data['cost_spk'] = ($request->actual_spk > 0) ? $total / $request->actual_spk : 0;
        $data['cost_do'] = ($request->actual_do > 0) ? $total / $request->actual_do : 0;

        ActualActivity::create($data);
        return redirect()->route('activity.actual.index')->with('success', 'Data Actual berhasil ditambahkan');
    }

    public function edit($id)
    {
        $activity = ActualActivity::findOrFail($id);
        return view('activity.actual.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = ActualActivity::findOrFail($id);
        $data = $request->all();
        $total = $request->total_cost ?? 0;
        $data['cost_p'] = ($request->actual_p > 0) ? $total / $request->actual_p : 0;
        $data['cost_spk'] = ($request->actual_spk > 0) ? $total / $request->actual_spk : 0;
        $data['cost_do'] = ($request->actual_do > 0) ? $total / $request->actual_do : 0;

        $activity->update($data);
        return redirect()->route('activity.actual.index')->with('success', 'Data Actual berhasil diupdate');
    }

    public function destroy($id)
    {
        $activity = ActualActivity::findOrFail($id);
        $activity->delete();
        return redirect()->route('activity.actual.index')->with('success', 'Data Actual berhasil dihapus');
    }
}