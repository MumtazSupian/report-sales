<?php

namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSourceDoInquary;

class ActualSourceDoInquaryController extends Controller
{
   public function index()
    {
        $data = ActualSourceDoInquary::all();
        $grandTotal = $data->sum('total');

        return view('current.actual-source-do-inquary.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        return view('current.actual-source-do-inquary.create');
    }

    public function store(Request $request)
    {
        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        ActualSourceDoInquary::create(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-source-do-inquary.index');
    }

    public function edit(ActualSourceDoInquary $actualSourceDoInquary)
    {
        return view('current.actual-source-do-inquary.edit', compact('actualSourceDoInquary'));
    }

    public function update(Request $request, ActualSourceDoInquary $actualSourceDoInquary)
    {
        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualSourceDoInquary->update(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-source-do-inquary.index');
    }

    public function destroy(ActualSourceDoInquary $actualSourceDoInquary)
    {
        $actualSourceDoInquary->delete();
        return back();
    }
}
