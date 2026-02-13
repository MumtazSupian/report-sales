<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetDoUnit;
use Illuminate\Support\Facades\Auth;

class TargetDoUnitController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = TargetDoUnit::all();
        } else {
            $data = TargetDoUnit::where('cabang', $user->cabang)->get();
        }

        return view('rka.target_do_units.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('rka.target_do_units.create', compact('commercial_units', 'passenger_units'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

                            TargetDoUnit::create($dataToCreate);
                        }
                    }
                }
            }
        }

        return redirect()->route('rka.target-do-units.index')
            ->with('success', 'Data target berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = TargetDoUnit::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'BM' && $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-do-units.index')->with('error', 'Akses dilarang!');
        }

        $commercial_units = ['NEW CARRY'];
        $passenger_units = ['APV BLIND VAN', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'IGNIS', 'e-VITARA', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'];

        return view('rka.target_do_units.edit', compact('data', 'commercial_units', 'passenger_units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = TargetDoUnit::findOrFail($id);

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        $commercial_units = ['NEW CARRY'];
        
        // Determine Jenis Unit based on selection
        $jenis_unit = in_array($request->type_unit, $commercial_units) ? 'Commercial' : 'Passenger';

        $data->update([
            'jenis_unit' => $jenis_unit,
            'type_unit'  => $request->type_unit,
            'tahun'      => $request->tahun,
            'jan'        => $request->jan,
            'feb'        => $request->feb,
            'mar'        => $request->mar,
            'apr'        => $request->apr,
            'mei'        => $request->mei,
            'jun'        => $request->jun,
            'jul'        => $request->jul,
            'agu'        => $request->agu,
            'sep'        => $request->sep,
            'okt'        => $request->okt,
            'nov'        => $request->nov,
            'des'        => $request->des,
            'total'      => $total,
        ]);

        return redirect()->route('rka.target-do-units.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TargetDoUnit::findOrFail($id);
        $user = Auth::user();
        if ($user->role == 'BM' && $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-do-units.index')
                ->with('error', 'Waduh, mau hapus punya siapa? Gak boleh ya!');
        }

        $data->delete();

        return redirect()->route('rka.target-do-units.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
