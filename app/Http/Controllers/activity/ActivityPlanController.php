<?php

namespace App\Http\Controllers\activity;

use App\Http\Controllers\Controller;
use App\Models\activity\ActivityPlan;
use Illuminate\Http\Request;

class ActivityPlanController extends Controller
{
    public function index()
    {
        $data = ActivityPlan::all();
        return view('activity.index', compact('data'));
    }

    public function create()
    {
        return view('activity.create');
    }

   public function store(Request $request)
{
    $data = $request->all();

    // ambil total cost
    $total = $request->total_cost;

    // hitung cost/p
    $data['cost_p'] = ($request->actual_p > 0)
        ? $total / $request->actual_p
        : 0;

    // hitung cost/spk
    $data['cost_spk'] = ($request->actual_spk > 0)
        ? $total / $request->actual_spk
        : 0;

    // hitung cost/do
    $data['cost_do'] = ($request->actual_do > 0)
        ? $total / $request->actual_do
        : 0;

    ActivityPlan::create($data);

    return redirect()->route('activity.index')
                     ->with('success', 'Data berhasil ditambahkan');
}


    public function edit(ActivityPlan $activity)
    {
        return view('activity.edit', compact('activity'));
    }

   public function update(Request $request, ActivityPlan $activity)
{
    $data = $request->all();

    $total = $request->total_cost;

    $data['cost_p'] = ($request->actual_p > 0)
        ? $total / $request->actual_p
        : 0;

    $data['cost_spk'] = ($request->actual_spk > 0)
        ? $total / $request->actual_spk
        : 0;

    $data['cost_do'] = ($request->actual_do > 0)
        ? $total / $request->actual_do
        : 0;

    $activity->update($data);

    return redirect()->route('activity.index')
                     ->with('success', 'Data berhasil diupdate');
}


    public function destroy(ActivityPlan $activity)
    {
        $activity->delete();

        return redirect()->route('activity.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
