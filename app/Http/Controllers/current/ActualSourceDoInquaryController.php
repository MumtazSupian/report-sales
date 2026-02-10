<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSourceDoInquary;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan untuk mengambil data login

class ActualSourceDoInquaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter: Pusat melihat semua, Cabang hanya melihat datanya sendiri
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualSourceDoInquary::all();
        } else {
            $data = ActualSourceDoInquary::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual-source-do-inquary.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        return view('current.actual-source-do-inquary.create');
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
        ActualSourceDoInquary::create(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang // Menandai data berdasarkan cabang penginput
            ]
        ));

        return redirect()->route('current.actual-source-do-inquary.index')
            ->with('success', 'Data Source DO Inquiry berhasil disimpan');
    }

    public function edit(ActualSourceDoInquary $actualSourceDoInquary)
    {
        $user = Auth::user();

        // Keamanan: Cegah user masuk ke halaman edit milik cabang lain
        if ($user->role == 'BM' && $actualSourceDoInquary->cabang != $user->cabang) {
            return redirect()->route('current.actual-source-do-inquary.index')
                ->with('error', 'Akses dilarang! Anda tidak memiliki izin untuk data ini.');
        }

        return view('current.actual-source-do-inquary.edit', compact('actualSourceDoInquary'));
    }

    public function update(Request $request, ActualSourceDoInquary $actualSourceDoInquary)
    {
        $user = Auth::user();

        // Proteksi di sisi server sebelum update dijalankan
        if ($user->role == 'BM' && $actualSourceDoInquary->cabang != $user->cabang) {
            return redirect()->route('current.actual-source-do-inquary.index')->with('error', 'Update ditolak.');
        }

        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualSourceDoInquary->update(array_merge(
            $request->only(array_merge(['source_inquary', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-source-do-inquary.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(ActualSourceDoInquary $actualSourceDoInquary)
    {
        $user = Auth::user();

        // Keamanan: Hanya boleh hapus data milik cabang sendiri
        if ($user->role == 'BM' && $actualSourceDoInquary->cabang != $user->cabang) {
            return redirect()->route('current.actual-source-do-inquary.index')
                ->with('error', 'Waduh, mau hapus data cabang lain? Tidak bisa ya.');
        }

        $actualSourceDoInquary->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
