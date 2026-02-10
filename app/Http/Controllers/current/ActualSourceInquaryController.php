<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSourceInquary;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan

class ActualSourceInquaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter: Pusat melihat semua, Cabang hanya melihat datanya sendiri
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualSourceInquary::all();
        } else {
            $data = ActualSourceInquary::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual_source_inquary.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        return view('current.actual_source_inquary.create', compact('year'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        // Simpan data dengan menyertakan kolom cabang otomatis dari profil user login
        ActualSourceInquary::create(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang // Menandai data berdasarkan cabang penginput
            ]
        ));

        return redirect()->route('current.actual-source-inquary.index')
            ->with('success', 'Data Source Inquiry berhasil disimpan');
    }

    public function edit(ActualSourceInquary $actualSourceInquary)
    {
        $user = Auth::user();

        // Keamanan: Cegah user masuk ke halaman edit milik cabang lain via URL
        if ($user->role == 'BM' && $actualSourceInquary->cabang != $user->cabang) {
            return redirect()->route('current.actual-source-inquary.index')
                ->with('error', 'Akses dilarang! Anda hanya boleh mengelola data cabang Anda.');
        }

        return view('current.actual_source_inquary.edit', compact('actualSourceInquary'));
    }

    public function update(Request $request, ActualSourceInquary $actualSourceInquary)
    {
        $user = Auth::user();

        // Proteksi sisi server
        if ($user->role == 'BM' && $actualSourceInquary->cabang != $user->cabang) {
            return redirect()->route('current.actual-source-inquary.index')->with('error', 'Update ditolak.');
        }

        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualSourceInquary->update(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-source-inquary.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(ActualSourceInquary $actualSourceInquary)
    {
        $user = Auth::user();

        // Keamanan: Hanya boleh hapus data milik cabang sendiri
        if ($user->role == 'BM' && $actualSourceInquary->cabang != $user->cabang) {
            return redirect()->route('current.actual-source-inquary.index')
                ->with('error', 'Waduh, mau hapus data cabang lain? Tidak bisa ya!');
        }

        $actualSourceInquary->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
