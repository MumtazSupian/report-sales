<?php
namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSalesforce;

class ActualSalesForceController extends Controller
{
     public function index()
    {
        $data = ActualSalesforce::all();
        $grandTotal = $data->sum('total');

        return view('current.actual_salesforces.index', compact('data','grandTotal'));
    }

    public function create()
    {
        return view('current.actual_salesforces.create');
    }

    public function store(Request $request)
    {
        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];
        $total = 0;
        foreach($months as $m){
            $total += (int) $request->$m;
        }

        ActualSalesforce::create(array_merge(
            $request->only(array_merge(['grading','tahun'],$months)),
            ['total'=>$total]
        ));

        return redirect()->route('current.actual-salesforces.index');
    }

    public function edit(ActualSalesforce $actualSalesforce)
    {
        return view('current.actual_salesforces.edit', compact('actualSalesforce'));
    }

    public function update(Request $request, ActualSalesforce $actualSalesforce)
    {
        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];
        $total = 0;
        foreach($months as $m){
            $total += (int) $request->$m;
        }

        $actualSalesforce->update(array_merge(
            $request->only(array_merge(['grading','tahun'],$months)),
            ['total'=>$total]
        ));

        return redirect()->route('current.actual-salesforces.index');
    }

    public function destroy(ActualSalesforce $actualSalesforce)
    {
        $actualSalesforce->delete();
        return back();
    }
}
