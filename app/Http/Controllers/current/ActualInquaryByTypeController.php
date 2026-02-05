<?php
namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualInquaryByType;

class ActualInquaryByTypeController extends Controller
{
     public function index()
    {
        $year = now()->year;

        $data = ActualInquaryByType::all();
        $grandTotal = $data->sum('total');

        return view('current.actual_inquary_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        return view('current.actual_inquary_by_type.create', compact('year'));
    }

    public function store(Request $request)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        ActualInquaryByType::create(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-inquary-by-type.index');
    }

    public function edit(ActualInquaryByType $actualInquaryByType)
    {
        return view('current.actual_inquary_by_type.edit', compact('actualInquaryByType'));
    }

    public function update(Request $request, ActualInquaryByType $actualInquaryByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        $actualInquaryByType->update(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));
        return redirect()->route('current.actual-inquary-by-type.index');
    }

    public function destroy(ActualInquaryByType $actualInquaryByType)
    {
        $actualInquaryByType->delete();
        return back();
    }
}
