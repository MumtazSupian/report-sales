<?php

namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use App\Models\current\ActualDoByType;
use Illuminate\Http\Request;

class ActualDoByTypeController extends Controller
{
    public function index()
    {
        $year = now()->year;

        $data = ActualDoByType::all();
        $grandTotal = $data->sum('total');

        return view('current.actual_do_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        return view('current.actual_do_by_type.create', compact('year'));
    }

    public function store(Request $request)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        ActualDoByType::create(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-do-by-type.index');
    }

    public function edit(ActualDoByType $actualDoByType)
    {
        return view('current.actual_do_by_type.edit', compact('actualDoByType'));
    }

    public function update(Request $request, ActualDoByType $actualDoByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        $actualDoByType->update(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));
        return redirect()->route('current.actual-do-by-type.index');
    }

    public function destroy(ActualDoByType $actualDoByType)
    {
        $actualDoByType->delete();
        return back();
    }
}
