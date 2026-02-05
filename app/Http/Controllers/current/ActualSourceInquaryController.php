<?php

namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSourceInquary;

class ActualSourceInquaryController extends Controller
{
    public function index()
    {
        $data = ActualSourceInquary::all();
        $grandTotal = $data->sum('total');

        return view('current.actual_source_inquary.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        return view('current.actual_source_inquary.create', compact('year'));
    }

    public function store(Request $request)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        ActualSourceInquary::create(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-source-inquary.index');
    }

    public function edit(ActualSourceInquary $actualSourceInquary)
    {
        return view('current.actual_source_inquary.edit', compact('actualSourceInquary'));
    }

    public function update(Request $request, ActualSourceInquary $actualSourceInquary)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualSourceInquary->update(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-source-inquary.index');
    }

    public function destroy(ActualSourceInquary $actualSourceInquary)
    {
        $actualSourceInquary->delete();
        return back();
    }
}
