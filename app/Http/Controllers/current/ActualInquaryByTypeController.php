<?php

namespace App\Http\Controllers\current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualInquaryByType;
use Illuminate\Support\Facades\Auth; // Tambahkan facade Auth

class ActualInquaryByTypeController extends Controller
{
    public function index()
    {
        $year = now()->year;
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Logika Filter Data
        if (in_array($user->role, $pusatRoles)) {
            // Jika admin/pusat, ambil semua data
            $data = ActualInquaryByType::all();
        } else {
            // Jika cabang, filter berdasarkan kolom cabang milik user
            $data = ActualInquaryByType::where('cabang', $user->cabang)->get();
        }

        $grandTotal = $data->sum('total');

        return view('current.actual_inquary_by_type.index', compact('data', 'year', 'grandTotal'));
    }

    public function create()
    {
        $year = now()->year;
        return view('current.actual_inquary_by_type.create', compact('year'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        // Menyimpan data dengan menyertakan otomatis kolom 'cabang'
        ActualInquaryByType::create(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            [
                'total' => $total,
                'cabang' => $user->cabang // Cabang diambil dari session login
            ]
        ));

        return redirect()->route('current.actual-inquary-by-type.index')
            ->with('success', 'Data Inquiry berhasil disimpan');
    }

    public function edit(ActualInquaryByType $actualInquaryByType)
    {
        $user = Auth::user();

        // Validasi Keamanan: Mencegah akses lintas cabang
        if ($user->role == 'BM' && $actualInquaryByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-inquary-by-type.index')
                ->with('error', 'Anda tidak memiliki akses ke data cabang lain!');
        }

        return view('current.actual_inquary_by_type.edit', compact('actualInquaryByType'));
    }

    public function update(Request $request, ActualInquaryByType $actualInquaryByType)
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        $total = 0;
        foreach ($months as $m) {
            $total += (int) $request->$m;
        }

        $actualInquaryByType->update(array_merge(
            $request->only(array_merge(['mobil_type', 'tahun'], $months)),
            ['total' => $total]
        ));

        return redirect()->route('current.actual-inquary-by-type.index')
            ->with('success', 'Data Inquiry berhasil diupdate');
    }

    public function destroy(ActualInquaryByType $actualInquaryByType)
    {
        $user = Auth::user();

        // Validasi Keamanan sebelum hapus
        if ($user->role == 'BM' && $actualInquaryByType->cabang != $user->cabang) {
            return redirect()->route('current.actual-inquary-by-type.index')
                ->with('error', 'Dilarang menghapus data cabang lain!');
        }

        $actualInquaryByType->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
