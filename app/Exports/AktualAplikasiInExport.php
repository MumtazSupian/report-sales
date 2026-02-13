<?php

namespace App\Exports;

use App\Models\leasing\AktualAplikasiIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;

class AktualAplikasiInExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        // Mengambil data sesuai hak akses user (Sama dengan logika di Controller)
        if (in_array($user->role, $pusatRoles)) {
            return AktualAplikasiIn::all();
        } else {
            return AktualAplikasiIn::where('cabang', $user->cabang)->get();
        }
    }

    // Judul Kolom di Excel
    public function headings(): array
    {
        return [
            'LEASING NAME', 'CABANG', 'TAHUN',
            'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN',
            'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES',
            'TOTAL'
        ];
    }

    // Mapping data ke kolom yang sesuai
    public function map($row): array
    {
        return [
            $row->leasing,
            $row->cabang,
            $row->tahun,
            $row->jan, $row->feb, $row->mar, $row->apr, $row->mei, $row->jun,
            $row->jul, $row->agu, $row->sep, $row->okt, $row->nov, $row->des,
            $row->total
        ];
    }

    // Styling agar Header Excel Tebal (Bold)
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
