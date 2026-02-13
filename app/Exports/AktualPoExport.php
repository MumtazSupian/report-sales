<?php

namespace App\Exports;

use App\Models\leasing\AktualPo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class AktualPoExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            return AktualPo::all();
        } else {
            return AktualPo::where('cabang', $user->cabang)->get();
        }
    }

    public function headings(): array
    {
        return [
            'LEASING NAME',
            'CABANG',
            'TAHUN',
            'JAN',
            'FEB',
            'MAR',
            'APR',
            'MEI',
            'JUN',
            'JUL',
            'AGU',
            'SEP',
            'OKT',
            'NOV',
            'DES',
            'TOTAL'
        ];
    }

    public function map($row): array
    {
        return [
            $row->leasing,
            $row->cabang,
            $row->tahun,
            $row->jan,
            $row->feb,
            $row->mar,
            $row->apr,
            $row->mei,
            $row->jun,
            $row->jul,
            $row->agu,
            $row->sep,
            $row->okt,
            $row->nov,
            $row->des,
            $row->total
        ];
    }
}
