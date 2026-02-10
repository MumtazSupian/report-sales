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
        return view('current.actual_spk_by_type.create', compact('year'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        // Simpan data dengan menyertakan kolom cabang otomatis dari profil user
        ActualSpkByType::create(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang // Cabang otomatis terisi
            ]
        ));

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

        return view('current.actual_spk_by_type.edit', compact('actualSpkByType'));
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

        $actualSpkByType->update(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
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
