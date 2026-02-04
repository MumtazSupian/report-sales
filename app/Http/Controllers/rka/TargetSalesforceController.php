<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetSalesforce;

class TargetSalesforceController extends Controller
{
    public function index()
    {
        $data = TargetSalesforce::all();
        return view('rka.target_salesforces.index', compact('data'));
    }

    public function create()
    {
        return view('rka.target_salesforces.create');
    }

    public function store(Request $request)
    {
        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];

        $data = [
            'grading' => $request->grading,
            'tahun'   => $request->tahun,
        ];

        $total = 0;

        foreach ($months as $m) {
            $value = $request->$m ?? 0;
            $data[$m] = $value;
            $total += $value;
        }

        $data['total'] = $total;

        TargetSalesforce::create($data);

        return redirect()->route('rka.target-salesforces.index');
    }

    public function edit($id)
    {
        $row = TargetSalesforce::findOrFail($id);
        return view('rka.target_salesforces.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = TargetSalesforce::findOrFail($id);

        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];

        $data = [
            'grading' => $request->grading,
            'tahun'   => $request->tahun,
        ];

        $total = 0;

        foreach ($months as $m) {
            $value = $request->$m ?? 0;
            $data[$m] = $value;
            $total += $value;
        }

        $data['total'] = $total;

        $row->update($data);

        return redirect()->route('rka.target-salesforces.index');
    }

    public function destroy($id)
    {
        TargetSalesforce::findOrFail($id)->delete();
        return redirect()->route('rka.target-salesforces.index');
    }
}
