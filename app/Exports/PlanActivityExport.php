<?php

namespace App\Exports;

use App\Models\activity\PlanActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;

class PlanActivityExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::user();
        if (in_array($user->role, ['Admin', 'OM', 'Admin DCA', 'OM DCA'])) {
            return PlanActivity::all();
        } else {
            return PlanActivity::where('cabang', $user->cabang)->get();
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NO',
                'CABANG',
                'JENIS',
                'ACTIVITY',
                'LOKASI',
                'UPLOAD KONTEN',
                '',
                'WAKTU',
                '',
                'PIC',
                'JML SALES',
                'TARGET',
                '',
                '',
                'ACTUAL',
                '',
                '',
                '',
                'TOTAL COST',
                'COST/P',
                'COST/SPK',
                'COST/DO',
                'KETERANGAN'
            ],
            [
                '', '', '', '', '',
                'Jenis', 'Type',
                'Tgl', 'Jam',
                '', '',
                'P', 'HP', 'SPK',
                'P', 'HP', 'SPK', 'DO',
                '', '', '', '', ''
            ]
        ];
    }

    public function map($row): array
    {
        static $no = 1;
        return [
            $no++,
            $row->cabang,
            $row->jenis_activity,
            $row->activity,
            $row->platform_lokasi,
            $row->jenis_unit,
            $row->type_unit,
            $row->tanggal,
            $row->jam,
            $row->pic,

            $row->jml_sales_shift,
            $row->target_p,
            $row->target_hp,
            $row->target_spk,
            $row->actual_p,
            $row->actual_hp,
            $row->actual_spk,
            $row->actual_do,
            $row->total_cost,
            $row->cost_p,
            $row->cost_spk,
            $row->cost_do,
            $row->keterangan,
        ];
    }
}
