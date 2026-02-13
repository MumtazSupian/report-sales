<?php

namespace App\Http\Controllers;

use App\Models\rka\TargetDoUnit;
use App\Models\rka\TargetSalesforce;
use App\Models\rka\TargetInquiry;
use App\Models\rka\TargetDoBySoi;
use App\Models\leasing\AktualPo;
use App\Models\leasing\AktualReject;
use App\Models\leasing\AktualAplikasiIn;
use App\Models\current\ActualDoByType;
use App\Models\current\ActualSpkByType;
use App\Models\current\ActualInquaryByType;
use App\Models\current\ActualSourceInquary;
use App\Models\current\ActualSourceDoInquary;
use App\Models\current\ActualSalesForce;
use App\Models\current\ActualDoSalesForce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tahunSekarang = 2026; 

        // 1. MAPPING BULAN
        $bulanMap = [
            1 => 'jan', 2 => 'feb', 3 => 'mar', 4 => 'apr', 5 => 'mei', 6 => 'jun',
            7 => 'jul', 8 => 'agu', 9 => 'sep', 10 => 'okt', 11 => 'nov', 12 => 'des'
        ];

        $bulanSekarangAngka = (int)date('n');
        $bulanDefault = $bulanMap[$bulanSekarangAngka];
        $bulan = $request->get('filter_bulan', $bulanDefault);

        // 2. DEFINE MASTER LIST MOBIL (Sesuai ENUM Paman)
        // Kita pakai ini sebagai patokan utama agar semua mobil muncul
        $listMobil = [
            'NEW CARRY',
            'APV BLIND VAN',
            'ERTIGA',
            'XL7',
            'SPRESO',
            'IGNIS',
            'e-VITARA',
            'GRAND VITARA',
            'JIMNY 3D',
            'JIMNY 5D',
            'FRONX',
            'BALENO',
        ];

        $performance = []; // Array penampung hasil akhir

        foreach ($listMobil as $namaMobil) {
            // A. Standarisasi Nama untuk Pencarian Database (Huruf kecil & trim)
            $searchName = strtolower(trim($namaMobil));

            // B. AMBIL DATA TARGET (RKA)
            // Kita cari di tabel target apakah mobil ini ada targetnya?
            // Mapping Legacy Names to New Type Units
            $typeMapping = [
                'new carry'     => ['NEW CARRY'],
                'apv blind van' => ['APV BLIND VAN'],
                'ertiga'        => ['ERTIGA'],
                'xl7'           => ['XL7'],
                'spreso'        => ['SPRESO'],
                'ignis'         => ['IGNIS'],
                'e-vitara'      => ['e-VITARA'],
                'grand vitara'  => ['GRAND VITARA'],
                'jimny 3d'      => ['JIMNY 3D'],
                'jimny 5d'      => ['JIMNY 5D'],
                'jimny'         => ['JIMNY 3D', 'JIMNY 5D'],
                'baleno'        => ['BALENO'],
                'fronx'         => ['FRONX']
            ];

            $targetTypes = $typeMapping[$searchName] ?? [$searchName]; // Fallback to name if not in map

            $qTarget = TargetDoUnit::whereIn('type_unit', $targetTypes);
            
            if ($user->role !== 'admin') {
                $qTarget->where('cabang', $user->cabang);
            }
            
            $targets = $qTarget->get();

            // Sum up the targets (Aggregation)
            $dTarget = new \stdClass();
            foreach ($bulanMap as $m) {
                $dTarget->$m = $targets->sum($m);
            }

            // C. AMBIL DATA ACTUAL (DO, SPK, INQ)
            // Kita cari di tabel actual
            $qActDo  = ActualDoByType::where('type_unit', $namaMobil)->where('tahun', $tahunSekarang);
            $qActSpk = ActualSpkByType::where('type_unit', $namaMobil)->where('tahun', $tahunSekarang);
            $qActInq = ActualInquaryByType::where('type_unit', $namaMobil)->where('tahun', $tahunSekarang);

            if ($user->role !== 'admin') {
                $qActDo->where('cabang', $user->cabang);
                $qActSpk->where('cabang', $user->cabang);
                $qActInq->where('cabang', $user->cabang);
            }

            $dDo  = $qActDo->first();
            $dSpk = $qActSpk->first();
            $dInq = $qActInq->first();

            // D. BENTUK DATA BARIS (OBJECT BARU)
            // Kita buat object manual agar struktur datanya rapih
            $row = new \stdClass();
            $row->mobil_type = $namaMobil; // Pakai nama dari List Master (Biar rapih huruf besar semua)
            
            // Masukkan Nilai Target Bulan Berjalan (Kalau data target gak ada, anggap 0)
            $row->$bulan = $dTarget ? $dTarget->$bulan : 0; 

            // Masukkan Nilai Actual Bulan Berjalan
            $row->act_do  = $dDo ? intval($dDo->$bulan) : 0;
            $row->act_spk = $dSpk ? intval($dSpk->$bulan) : 0;
            $row->act_inq = $dInq ? intval($dInq->$bulan) : 0;

            // Hitung YTD (Year to Date) & Total Target
            $ytdTarget = 0;
            $ytdActDo  = 0;
            
            foreach ($bulanMap as $m) {
                // Simpan data target per bulan ke row object (untuk keperluan view detail jika ada)
                $row->$m = $dTarget ? ($dTarget->$m ?? 0) : 0;

                // Hitung akumulasi
                $ytdTarget += intval($dTarget ? ($dTarget->$m ?? 0) : 0);
                $ytdActDo  += intval($dDo ? ($dDo->$m ?? 0) : 0);
                
                if ($m == $bulan) break;
            }

            $row->ytd_target = $ytdTarget;
            $row->ytd_act_do = $ytdActDo;

            // Target N+1 (Bulan Depan)
            $keys = array_values($bulanMap);
            $currentIndex = array_search($bulan, $keys);
            $nextMonth = ($currentIndex < 11) ? $keys[$currentIndex + 1] : 'des';
            $row->plan_rka_next = $dTarget ? ($dTarget->$nextMonth ?? 0) : 0;

            // Masukkan ke array utama
            $performance[] = $row;
        }

        // 3. LOGIKA LEASING (Sama seperti sebelumnya)
        $leasingList = ['Suzuki Finance', 'BCA Finance', 'KKB BCA', 'Mandiri Tunas Finance', 'KKB MANDIRI', 'BSI', 'Mandiri Utama Finance', 'Indomobil Finance', 'Adira Finance', 'BNI Finance', 'MAYBANK', 'Oto Multiartha Finance', 'NIAGA Finance', 'Clipan Finance', 'Lain - Lain'];
        $leasing_performance = [];
        
        foreach ($leasingList as $leasingName) {
            $qPo = AktualPo::where('leasing', $leasingName)->where('tahun', $tahunSekarang);
            $qRj = AktualReject::where('leasing', $leasingName)->where('tahun', $tahunSekarang);
            $qIn = AktualAplikasiIn::where('leasing', $leasingName)->where('tahun', $tahunSekarang);

            if ($user->role !== 'admin') {
                $qPo->where('cabang', $user->cabang);
                $qRj->where('cabang', $user->cabang);
                $qIn->where('cabang', $user->cabang);
            }

            $dPo = $qPo->first(); $dRj = $qRj->first(); $dIn = $qIn->first();

            $ytdPo = 0; $ytdRj = 0; $ytdIn = 0;
            foreach ($bulanMap as $m) {
                $ytdPo += $dPo ? intval($dPo->$m) : 0;
                $ytdRj += $dRj ? intval($dRj->$m) : 0;
                $ytdIn += $dIn ? intval($dIn->$m) : 0;
                if ($m == $bulan) break;
            }

            $leasing_performance[] = (object)[
                'nama'   => $leasingName,
                'po'     => $dPo ? intval($dPo->$bulan) : 0,
                'reject' => $dRj ? intval($dRj->$bulan) : 0,
                'aplin'  => $dIn ? intval($dIn->$bulan) : 0,
                'ytd_po'     => $ytdPo,
                'ytd_reject' => $ytdRj,
                'ytd_aplin'  => $ytdIn,
            ];
        }

        // 4. SOI
        $all_sources = TargetInquiry::pluck('source_inquiry')->merge(TargetDoBySoi::pluck('source_inquiry'))->unique();
        $soi_combined = [];
        foreach ($all_sources as $source) {
            $qi = TargetInquiry::where('source_inquiry', $source);
            $qd = TargetDoBySoi::where('source_inquiry', $source);
            if ($user->role !== 'admin') {
                $qi->where('cabang', $user->cabang);
                $qd->where('cabang', $user->cabang);
            }
            $di = $qi->first(); $dd = $qd->first();
            $soi_combined[] = (object)[
                'source_inquiry' => $source, 
                'trg_inq' => $di ? intval($di->$bulan) : 0, 
                'trg_do' => $dd ? intval($dd->$bulan) : 0
            ];
        }

        // 5. PERFORMANCE SOI (ACTUAL)
        $actInqQuery = ActualSourceInquary::where('tahun', $tahunSekarang);
        $actDoQuery = ActualSourceDoInquary::where('tahun', $tahunSekarang);

        if ($user->role !== 'admin') {
            $actInqQuery->where('cabang', $user->cabang);
            $actDoQuery->where('cabang', $user->cabang);
        }

        // Get Data & Group By Source
        $actInqData = $actInqQuery->get()->groupBy('source_inquary')->map(function ($rows) use ($bulan) {
            return $rows->sum($bulan);
        });

        $actDoData = $actDoQuery->get()->groupBy('source_inquary')->map(function ($rows) use ($bulan) {
            return $rows->sum($bulan);
        });

        // Merge Unique Sources
        $allActualSources = $actInqData->keys()->merge($actDoData->keys())->unique();
        
        $soi_performance = [];
        foreach ($allActualSources as $source) {
            $soi_performance[] = (object)[
                'source_name' => $source,
                'act_inq'     => $actInqData->get($source, 0),
                'act_do'      => $actDoData->get($source, 0),
            ];
        }

        // 6. SALES FORCE PERFORMANCE
        $sfTargets = TargetSalesforce::when($user->role !== 'admin', fn($q) => $q->where('cabang', $user->cabang))->get();
        
        $actSfQuery = ActualSalesForce::where('tahun', $tahunSekarang);
        $actDoSfQuery = ActualDoSalesForce::where('tahun', $tahunSekarang);

        if ($user->role !== 'admin') {
            $actSfQuery->where('cabang', $user->cabang);
            $actDoSfQuery->where('cabang', $user->cabang);
        }

        // Aggregate Actuals by Grading
        $actSfData = $actSfQuery->get()->groupBy('grading')->map(function ($rows) use ($bulan) {
            return $rows->sum($bulan);
        });

        $actDoSfData = $actDoSfQuery->get()->groupBy('grading')->map(function ($rows) use ($bulan) {
            return $rows->sum($bulan);
        });

        // Merge Targets and Actuals
        // We use Targets as the base because standard gradings should come from there.
        // If there are extra gradings in Actuals that are not in Targets, we might miss them if we strictly loop Targets.
        // So let's collect all unique gradings first.
        
        $allGradings = $sfTargets->pluck('grading')
            ->merge($actSfData->keys())
            ->merge($actDoSfData->keys())
            ->unique();

        $salesforce_performance = [];
        foreach ($allGradings as $grading) {
            // Find target for this grading (if any)
            $targetRow = $sfTargets->firstWhere('grading', $grading);
            
            $salesforce_performance[] = (object)[
                'grading' => $grading,
                'trg_sf'  => $targetRow ? ($targetRow->$bulan ?? 0) : 0,
                'act_sf'  => $actSfData->get($grading, 0),
                'act_do'  => $actDoSfData->get($grading, 0),
                // Add other target fields if needed later
            ];
        }

        return view('dashboard', [
            'performance'   => collect($performance), // Sekarang isinya array object lengkap
            'salesforce'    => collect($salesforce_performance), // Updated to use merged collection
            'soi_combined'  => $soi_combined,
            'soi_performance' => $soi_performance,
            'leasing_performance' => $leasing_performance,
            'bulan'         => $bulan,
            'bulan_list'    => $bulanMap
        ]);
    }
}