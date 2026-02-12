<?php

namespace App\Exports;

use App\Models\summary\SummaryAction; // Sesuaikan dengan namespace model Anda
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class SummaryActionExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $actions = SummaryAction::orderBy('cabang')->get();
        } else {
            $actions = SummaryAction::where('cabang', $user->cabang)->get();
        }

        return view('summary.summaryaction.export_excel', [
            'actions' => $actions
        ]);
    }
}
