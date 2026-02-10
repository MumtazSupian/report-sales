<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetSalesforce;
use Illuminate\Support\Facades\Auth;

class TargetSalesforceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = TargetSalesforce::all();
        } else {
            $data = TargetSalesforce::where('cabang', $user->cabang)->get();
        }

        return view('rka.target_salesforces.index', compact('data'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'BM') {
            return redirect()->route('rka.target-salesforces.index')->with('error', 'Akses ditolak.');
        }
        return view('rka.target_salesforces.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'BM') {
            return redirect()->route('rka.target-salesforces.index')->with('error', 'Akses ilegal.');
        }

        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];

        $data = [
            'grading' => $request->grading,
            'tahun'   => $request->tahun,
            'cabang'  => $user->cabang, 
        ];

        $total = 0;
        foreach ($months as $m) {
            $value = $request->$m ?? 0;
            $data[$m] = $value;
            $total += $value;
        }

        $data['total'] = $total;

        TargetSalesforce::create($data);

        return redirect()->route('rka.target-salesforces.index')->with('success', 'Data target salesforce berhasil disimpan');
    }

    public function edit($id)
    {
        $row = TargetSalesforce::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $row->cabang != $user->cabang) {
            return redirect()->route('rka.target-salesforces.index')->with('error', 'Anda tidak memiliki hak akses untuk mengedit data ini.');
        }

        return view('rka.target_salesforces.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = TargetSalesforce::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $row->cabang != $user->cabang) {
            return redirect()->route('rka.target-salesforces.index')->with('error', 'Perubahan ditolak.');
        }

        $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];

        $data = [
            'grading' => $request->grading,
            'tahun'   => $request->tahun,
        ];

        $total = 0;
        foreach ($months as $m) {
            $value = $request->$m ?? 0;
            $data[$m] = $value;
            $total += $value;
        }

        $data['total'] = $total;

        $row->update($data);

        return redirect()->route('rka.target-salesforces.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $row = TargetSalesforce::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $row->cabang != $user->cabang) {
            return redirect()->route('rka.target-salesforces.index')->with('error', 'Anda dilarang menghapus data ini.');
        }

        $row->delete();
        return redirect()->route('rka.target-salesforces.index')->with('success', 'Data berhasil dihapus');
    }
}