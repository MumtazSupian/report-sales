<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSalesforce;
use Illuminate\Support\Facades\Auth; // Penting untuk logika login

class ActualSalesForceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter: Pusat melihat semua, Cabang hanya melihat miliknya
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualSalesforce::all();
        } else {
            $data = ActualSalesforce::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual_salesforces.index', compact('data', 'grandTotal'));
    }

    public function create()
    {
        return view('current.actual_salesforces.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $total = 0;

        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        // Simpan data dengan menyertakan kolom cabang otomatis dari user login
        ActualSalesforce::create(array_merge(
            $request->only(array_merge(['grading', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang
            ]
        ));

        return redirect()->route('current.actual-salesforces.index')
            ->with('success', 'Data Salesforce berhasil disimpan');
    }

    public function edit(ActualSalesforce $actualSalesforce)
    {
        $user = Auth::user();

        // Keamanan: Cegah user edit data cabang lain via URL manual
        if ($user->role == 'BM' && $actualSalesforce->cabang != $user->cabang) {
            return redirect()->route('current.actual-salesforces.index')
                ->with('error', 'Akses dilarang! Anda hanya bisa mengedit data cabang Anda.');
        }

        return view('current.actual_salesforces.edit', compact('actualSalesforce'));
    }

    public function update(Request $request, ActualSalesforce $actualSalesforce)
    {
        $user = Auth::user();

        // Proteksi tambahan di sisi server
        if ($user->role == 'BM' && $actualSalesforce->cabang != $user->cabang) {
            return redirect()->route('current.actual-salesforces.index')->with('error', 'Akses ditolak.');
        }

        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualSalesforce->update(array_merge(
            $request->only(array_merge(['grading', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-salesforces.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(ActualSalesforce $actualSalesforce)
    {
        $user = Auth::user();

        // Keamanan: Hanya boleh hapus data milik sendiri
        if ($user->role == 'BM' && $actualSalesforce->cabang != $user->cabang) {
            return redirect()->route('current.actual-salesforces.index')
                ->with('error', 'Waduh, tidak boleh hapus data cabang lain!');
        }

        $actualSalesforce->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
