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
        return view('current.actual_do_by_type.create', compact('year'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        // Menyimpan data dengan menyertakan kolom 'cabang' dari user yang login
        ActualDoByType::create(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang // Ambil otomatis dari user login
            ]
        ));

        return redirect()->route('current.actual-do-by-type.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(ActualDoByType $actualDoByType)
    {
        $user = Auth::user();

        // Proteksi agar user cabang lain tidak bisa edit lewat URL
        if ($user->role == 'BM' && $actualDoByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-do-by-type.index')->with('error', 'Akses dilarang!');
        }

        return view('current.actual_do_by_type.edit', compact('actualDoByType'));
    }

    public function update(Request $request, ActualDoByType $actualDoByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += $request->$m;
        }

        $actualDoByType->update(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
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
