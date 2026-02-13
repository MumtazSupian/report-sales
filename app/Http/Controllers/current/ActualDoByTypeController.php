<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use App\Models\current\ActualDoByType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class ActualDoByTypeController extends Controller
{
    public function index()
    {
        $year = now()->year;
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter Data: Admin melihat semua, User melihat per cabang
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualDoByType::all();
        } else {
            $data = ActualDoByType::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual_do_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];
        
        return view('current.actual_do_by_type.create', compact('year', 'commercial_units', 'passenger_units'));
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

                            // Initialize all months to 0
                            foreach ($months as $m) {
                                $dataToCreate[$m] = 0;
                            }
                            // Set the specific month amount
                            $dataToCreate[$month] = $amount;

                            ActualDoByType::create($dataToCreate);
                        }
                    }
                }
            }
        }

        return redirect()->route('current.actual-do-by-type.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(ActualDoByType $actualDoByType)
    {
        $user = Auth::user();

        // Proteksi agar user cabang lain tidak bisa edit lewat URL
        if ($user->role == 'BM' && $actualDoByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-do-by-type.index')->with('error', 'Akses dilarang!');
        }

        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('current.actual_do_by_type.edit', compact('actualDoByType', 'commercial_units', 'passenger_units'));
    }

    public function update(Request $request, ActualDoByType $actualDoByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        
        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        $commercial_units = ['NEW CARRY'];
        $jenis_unit = in_array($request->type_unit, $commercial_units) ? 'Commercial' : 'Passenger';

        $actualDoByType->update(array_merge(
            [
                'jenis_unit' => $jenis_unit,
                'type_unit'  => $request->type_unit,
                'tahun'      => $request->tahun,
                'total'      => $total
            ],
            $request->only($months)
        ));

        return redirect()->route('current.actual-do-by-type.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(ActualDoByType $actualDoByType)
    {
        $user = Auth::user();

        // Proteksi hapus data
        if ($user->role == 'BM' && $actualDoByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-do-by-type.index')
                             ->with('error', 'Waduh, mau hapus punya siapa? Gak boleh ya!');
        }

        $actualDoByType->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
