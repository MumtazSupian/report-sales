<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\PlanActivity; 
use Illuminate\Http\Request;

class PlanActivityController extends Controller
{
    public function index()
    {
        $data = PlanActivity::all();
        return view('activity.plan.index', compact('data'));
    }

    public function create()
    {
        return view('activity.plan.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $total = $request->total_cost ?? 0;
        $data['cost_p'] = ($request->actual_p > 0) ? $total / $request->actual_p : 0;
        $data['cost_spk'] = ($request->actual_spk > 0) ? $total / $request->actual_spk : 0;
        $data['cost_do'] = ($request->actual_do > 0) ? $total / $request->actual_do : 0;

        PlanActivity::create($data);
        return redirect()->route('activity.plan.index')->with('success', 'Data Plan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $activity = PlanActivity::findOrFail($id);
        return view('activity.plan.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = PlanActivity::findOrFail($id);
        $data = $request->all();
        $total = $request->total_cost ?? 0;

        $data['cost_p'] = ($request->actual_p > 0) ? $total / $request->actual_p : 0;
        $data['cost_spk'] = ($request->actual_spk > 0) ? $total / $request->actual_spk : 0;
        $data['cost_do'] = ($request->actual_do > 0) ? $total / $request->actual_do : 0;

        $activity->update($data);
        return redirect()->route('activity.plan.index')->with('success', 'Data Plan berhasil diupdate');
    }

    public function destroy($id)
    {
        $activity = PlanActivity::findOrFail($id);
        $activity->delete();
        return redirect()->route('activity.plan.index')->with('success', 'Data Plan berhasil dihapus');
    }
}