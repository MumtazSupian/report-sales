<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\PlanActivity; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class PlanActivityController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role, ['Admin', 'OM', 'Admin DCA', 'OM DCA'])) {
            $data = PlanActivity::all();
        } else {
            $data = PlanActivity::where('cabang', $user->cabang)->get();
        }

        return view('activity.plan.index', compact('data'));
    }

    public function create()
    {
        return view('activity.plan.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['cabang'] = Auth::user()->cabang; 

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
        
        if (!in_array(Auth::user()->role, ['Admin', 'OM']) && $activity->cabang !== Auth::user()->cabang) {
            abort(403, 'tidak punya akses ke data cabang lain!');
        }

        return view('activity.plan.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = PlanActivity::findOrFail($id);
        
        if (!in_array(Auth::user()->role, ['Admin', 'OM']) && $activity->cabang !== Auth::user()->cabang) {
            abort(403);
        }

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
        
        if (!in_array(Auth::user()->role, ['Admin', 'OM']) && $activity->cabang !== Auth::user()->cabang) {
            abort(403);
        }

        $activity->delete();
        return redirect()->route('activity.plan.index')->with('success', 'Data Plan berhasil dihapus');
    }
}