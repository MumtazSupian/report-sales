<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualInquaryByType;
use Illuminate\Support\Facades\Auth; // Tambahkan facade Auth

class ActualInquaryByTypeController extends Controller
{
    public function index()
    {
        $year = now()->year;
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter Data
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualInquaryByType::all();
        } else {
            $data = ActualInquaryByType::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual_inquary_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('current.actual_inquary_by_type.create', compact('year', 'commercial_units', 'passenger_units'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $categories = ['Commercial', 'Passenger'];

        if ($request->has('targets') && is_array($request->targets)) {
            foreach ($months as $month) {
                if (!isset($request->targets[$month])) continue;
                
                foreach ($categories as $category) {
                    if (!isset($request->targets[$month][$category])) continue;

                    foreach ($request->targets[$month][$category] as $item) {
                        $typeUnit = $item['type'] ?? null;
                        $amount = $item['amount'] ?? 0;

                        if ($typeUnit && $amount > 0) {
                            $dataToCreate = [
                                'jenis_unit' => $category,
                                'type_unit'  => $typeUnit,
                                'tahun'      => $request->tahun,
                                'cabang'     => $user->cabang,
                                'total'      => $amount,
                            ];

                            foreach ($months as $m) {
                                $dataToCreate[$m] = 0;
                            }
                            $dataToCreate[$month] = $amount;

                            ActualInquaryByType::create($dataToCreate);
                        }
                    }
                }
            }
        }

        return redirect()->route('current.actual-inquary-by-type.index')
            ->with('success', 'Data Inquiry berhasil disimpan');
    }

    public function edit(ActualInquaryByType $actualInquaryByType)
    {
        $user = Auth::user();

        if ($user->role == 'BM' && $actualInquaryByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-inquary-by-type.index')
                ->with('error', 'Anda tidak memiliki akses ke data cabang lain!');
        }

        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('current.actual_inquary_by_type.edit', compact('actualInquaryByType', 'commercial_units', 'passenger_units'));
    }

    public function update(Request $request, ActualInquaryByType $actualInquaryByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $commercial_units = ['NEW CARRY'];
        $jenis_unit = in_array($request->type_unit, $commercial_units) ? 'Commercial' : 'Passenger';

        $actualInquaryByType->update(array_merge(
            [
                'jenis_unit' => $jenis_unit,
                'type_unit'  => $request->type_unit,
                'tahun'      => $request->tahun,
                'total'      => $total
            ],
            $request->only($months)
        ));

        return redirect()->route('current.actual-inquary-by-type.index')
            ->with('success', 'Data Inquiry berhasil diupdate');
    }

    public function destroy(ActualInquaryByType $actualInquaryByType)
    {
        $user = Auth::user();

        if ($user->role == 'BM' && $actualInquaryByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-inquary-by-type.index')
                ->with('error', 'Dilarang menghapus data cabang lain!');
        }

        $actualInquaryByType->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
