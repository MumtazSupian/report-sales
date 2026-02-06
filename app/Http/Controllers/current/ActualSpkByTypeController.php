<?php

namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSpkByType;

class ActualSpkByTypeController extends Controller
{
    public function index()
    {
        $year = now()->year;

        $data = ActualSpkByType::all();
        $grandTotal = $data->sum('total');

        return view('current.actual_spk_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        return view('current.actual_spk_by_type.create', compact('year'));
    }

    public function store(Request $request)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        ActualSpkByType::create(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-spk-by-type.index');
    }

    public function edit(ActualSpkByType $actualSpkByType)
    {
        return view('current.actual_spk_by_type.edit', compact('actualSpkByType'));
    }

    public function update(Request $request, ActualSpkByType $actualSpkByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        $actualSpkByType->update(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));
        return redirect()->route('current.actual-spk-by-type.index');
    }

    public function destroy(ActualSpkByType $actualSpkByType)
    {
        $actualSpkByType->delete();
        return back();
    }
}
