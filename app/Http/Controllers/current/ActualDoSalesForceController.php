<?php
namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualDoSalesforce;

class ActualDoSalesForceController extends Controller
{
    public function index()
    {
        $data = ActualDoSalesforce::all();
        return view('current.actual_do_salesforces.index', compact('data'));
    }

    public function create()
    {
        return view('current.actual_do_salesforces.create');
    }

    public function store(Request $request)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $total = 0;

        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        ActualDoSalesforce::create(array_merge(
            $request->only(array_merge(['grading', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-do-salesforces.index');
    }

    public function edit(ActualDoSalesforce $actualDoSalesforce)
    {
        return view('current.actual_do_salesforces.edit', compact('actualDoSalesforce'));
    }

    public function update(Request $request, ActualDoSalesforce $actualDoSalesforce)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $total = 0;

        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualDoSalesforce->update(array_merge(
            $request->only(array_merge(['grading', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-do-salesforces.index');
    }

    public function destroy(ActualDoSalesforce $actualDoSalesforce)
    {
        $actualDoSalesforce->delete();
        return back();
    }
}
