<?php

namespace App\Exports;

// UBAH BAGIAN INI: Sesuaikan dengan lokasi model di controller Anda
use App\Models\summary\Summary;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class SummaryExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $summaries = Summary::orderBy('cabang')->get();
        } else {
            $summaries = Summary::where('cabang', $user->cabang)
                ->orderBy('operasional')
                ->get();
        }

        return view('summary.summary.export_excel', [
            'summaries' => $summaries
        ]);
    }
}
