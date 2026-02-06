<?php

namespace App\Http\Controllers\activity;

use App\Http\Controllers\Controller;
use App\Models\activity\ActivityPlan;
use Illuminate\Http\Request;

class ActivityPlanController extends Controller
{
    public function index()
    {
        // Mengambil semua data untuk ditampilkan di tabel dashboard
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
        $total = $request->total_cost ?? 0;

        $data['cost_p'] = ($request->actual_p > 0) ? $total / $request->actual_p : 0;
        $data['cost_spk'] = ($request->actual_spk > 0) ? $total / $request->actual_spk : 0;
        $data['cost_do'] = ($request->actual_do > 0) ? $total / $request->actual_do : 0;

        ActivityPlan::create($data);
        return redirect()->route('activity.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $activity = ActivityPlan::findOrFail($id);
        return view('activity.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = ActivityPlan::findOrFail($id);
        $data = $request->all();
        $total = $request->total_cost ?? 0;

        $data['cost_p'] = ($request->actual_p > 0) ? $total / $request->actual_p : 0;
        $data['cost_spk'] = ($request->actual_spk > 0) ? $total / $request->actual_spk : 0;
        $data['cost_do'] = ($request->actual_do > 0) ? $total / $request->actual_do : 0;

        $activity->update($data);
        return redirect()->route('activity.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $activity = ActivityPlan::findOrFail($id);
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Data berhasil dihapus');
    }
}