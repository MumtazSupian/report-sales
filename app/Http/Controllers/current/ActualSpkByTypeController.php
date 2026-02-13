<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSpkByType;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan

class ActualSpkByTypeController extends Controller
{
    public function index()
    {
        $year = now()->year;
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter: Pusat melihat semua, Cabang hanya melihat data cabangnya
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualSpkByType::all();
        } else {
            $data = ActualSpkByType::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual_spk_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('current.actual_spk_by_type.create', compact('year', 'commercial_units', 'passenger_units'));
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

                            ActualSpkByType::create($dataToCreate);
                        }
                    }
                }
            }
        }

        return redirect()->route('current.actual-spk-by-type.index')
            ->with('success', 'Data SPK berhasil disimpan');
    }

    public function edit(ActualSpkByType $actualSpkByType)
    {
        $user = Auth::user();

        // Keamanan: Cegah user edit data cabang lain via URL manual
        if ($user->role == 'BM' && $actualSpkByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-spk-by-type.index')
                ->with('error', 'Akses dilarang! Ini bukan data cabang Anda.');
        }

        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('current.actual_spk_by_type.edit', compact('actualSpkByType', 'commercial_units', 'passenger_units'));
    }

    public function update(Request $request, ActualSpkByType $actualSpkByType)
    {
        $user = Auth::user();

        // Proteksi sisi server
        if ($user->role == 'BM' && $actualSpkByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-spk-by-type.index')->with('error', 'Akses ditolak.');
        }

        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $commercial_units = ['NEW CARRY'];
        $jenis_unit = in_array($request->type_unit, $commercial_units) ? 'Commercial' : 'Passenger';

        $actualSpkByType->update(array_merge(
            [
                'jenis_unit' => $jenis_unit,
                'type_unit'  => $request->type_unit,
                'tahun'      => $request->tahun,
                'total'      => $total
            ],
            $request->only($months)
        ));

        return redirect()->route('current.actual-spk-by-type.index')
            ->with('success', 'Data SPK berhasil diperbarui');
    }

    public function destroy(ActualSpkByType $actualSpkByType)
    {
        $user = Auth::user();

        // Keamanan: Hanya boleh hapus data milik cabang sendiri
        if ($user->role == 'BM' && $actualSpkByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-spk-by-type.index')
                ->with('error', 'Waduh, mau hapus data cabang lain? Tidak bisa!');
        }

        $actualSpkByType->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
