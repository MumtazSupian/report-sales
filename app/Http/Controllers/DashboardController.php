<?php

namespace App\Http\Controllers;

use App\Models\rka\TargetDoUnit;
use App\Models\rka\TargetSalesforce;
use App\Models\rka\TargetInquiry; 
use App\Models\rka\TargetDoBySoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // date('n') menghasilkan angka 1-12. Kita mapping ke nama kolom paman.
        $bulanMap = [
            1 => 'jan', 2 => 'feb', 3 => 'mar', 4 => 'apr', 5 => 'mei', 6 => 'jun',
            7 => 'jul', 8 => 'agu', 9 => 'sep', 10 => 'okt', 11 => 'nov', 12 => 'des'
        ];
        
        $bulanSekarangAngka = (int)date('n'); 
        $bulan = $bulanMap[$bulanSekarangAngka]; 

        // 1. Inisialisasi Query untuk Performance & Salesforce
        $performance = TargetDoUnit::query();
        $salesforce = TargetSalesforce::query();

        if ($user->role !== 'admin') {
            $performance->where('cabang', $user->cabang);
            $salesforce->where('cabang', $user->cabang);
        }

        // 2. LOGIKA GABUNGAN SOI (Mengambil data sesuai bulan otomatis)
        $all_sources = TargetInquiry::pluck('source_inquiry')
                        ->merge(TargetDoBySoi::pluck('source_inquiry'))
                        ->unique();

        $soi_combined = [];
        foreach ($all_sources as $source) {
            $queryInq = TargetInquiry::where('source_inquiry', $source);
            $queryDo  = TargetDoBySoi::where('source_inquiry', $source);

            if ($user->role !== 'admin') {
                $queryInq->where('cabang', $user->cabang);
                $queryDo->where('cabang', $user->cabang);
            }

            $dataInq = $queryInq->first();
            $dataDo  = $queryDo->first();

            $soi_combined[] = (object)[
                'source_inquiry' => $source,
                'trg_inq' => $dataInq ? $dataInq->$bulan : 0, 
                'trg_do'  => $dataDo ? $dataDo->$bulan : 0    
            ];
        }

        return view('dashboard', [
            'performance'  => $performance->get(),
            'salesforce'   => $salesforce->get(),
            'soi_combined' => $soi_combined,
            'bulan'        => $bulan 
        ]);
    }
}