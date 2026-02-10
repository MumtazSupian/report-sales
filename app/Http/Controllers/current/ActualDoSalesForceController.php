<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualDoSalesforce;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan

class ActualDoSalesForceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Jika role termasuk pusat, tampilkan semua data
        if (in_array($user->role, $pusatRoles)) {
            $data = ActualDoSalesforce::all();
        } else {
            // Jika bukan pusat (misal: BM), hanya tampilkan data cabangnya sendiri
            $data = ActualDoSalesforce::where('cabang', $user->cabang)->get();
        }

        return view('current.actual_do_salesforces.index', compact('data'));
    }

    public function create()
    {
        return view('current.actual_do_salesforces.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $total = 0;

        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        // Simpan data dengan menyertakan 'cabang' dari user yang login
        ActualDoSalesforce::create(array_merge(
            $request->only(array_merge(['grading', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang
            ]
        ));

        return redirect()->route('current.actual-do-salesforces.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(ActualDoSalesforce $actualDoSalesforce)
    {
        $user = Auth::user();

        // Keamanan: Cegah user edit data milik cabang lain via URL
        if ($user->role == 'BM' && $actualDoSalesforce->cabang != $user->cabang) {
            return redirect()->route('current.actual-do-salesforces.index')
                             ->with('error', 'Akses dilarang!');
        }

        return view('current.actual_do_salesforces.edit', compact('actualDoSalesforce'));
    }

    public function update(Request $request, ActualDoSalesforce $actualDoSalesforce)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $total = 0;

        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualDoSalesforce->update(array_merge(
            $request->only(array_merge(['grading', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-do-salesforces.index')
                         ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(ActualDoSalesforce $actualDoSalesforce)
    {
        $user = Auth::user();

        // Keamanan: Cegah user hapus data milik cabang lain
        if ($user->role == 'BM' && $actualDoSalesforce->cabang != $user->cabang) {
            return redirect()->route('current.actual-do-salesforces.index')
                             ->with('error', 'Waduh, tidak bisa hapus data cabang lain!');
        }

        $actualDoSalesforce->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
