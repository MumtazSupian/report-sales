<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rka\TargetDoUnitController;
use App\Http\Controllers\rka\TargetSalesforceController;
use App\Http\Controllers\rka\TargetInquiryController;
use App\Http\Controllers\rka\TargetDoBySoiController;

use App\Http\Controllers\leasing\AktualAplikasiInController;
use App\Http\Controllers\leasing\AktualPoController;
use App\Http\Controllers\leasing\AktualRejectController;

use App\Http\Controllers\activity\ActivityPlanController;

use App\Http\Controllers\current\ActualDoByTypeController;
use App\Http\Controllers\current\ActualDoSalesForceController;
use App\Http\Controllers\current\ActualInquaryByTypeController;
use App\Http\Controllers\current\ActualSalesByLeasingController;
use App\Http\Controllers\current\ActualSalesForceController;
use App\Http\Controllers\current\ActualSourceDoInquaryController;
use App\Http\Controllers\current\ActualSourceInquaryController;
use App\Http\Controllers\current\ActualSpkByTypeController;

use App\Http\Controllers\evaluasi\EvaluasiWiraniagaController;

use App\Http\Controllers\summary\SummaryController;
use App\Http\Controllers\summary\SummaryActionController;


Route::get('/', function () {
    return view('dashboard');
});


Route::prefix('rka')->name('rka.')->group(function () {
    Route::get('/dashboard', function () {
        return view('rka.dashboard_rka');
    });
    Route::resource('target-do-units', TargetDoUnitController::class);
    Route::resource('target-salesforces', TargetSalesforceController::class);
    Route::resource('target-inquiries', TargetInquiryController::class);
    Route::resource('target-do-by-soi', TargetDoBySoiController::class);
});

Route::prefix('leasing')->name('leasing.')->group(function () {
    Route::get('/dashboard', function () {
        return view('leasing.dashboard_leasing');
    });
    Route::resource('aktual-aplikasi-in', AktualAplikasiInController::class);
    Route::resource('aktual-po', AktualPoController::class);
    Route::resource('aktual-reject', AktualRejectController::class);
});


Route::prefix('activity')->group(function () {
    Route::get('/dashboard', function () {return view('activity.dashboard_activity');});
    Route::resource('activity', ActivityPlanController::class);
});


Route::prefix('current')->name('current.')->group(function () {
    Route::get('/dashboard', function () {return view('current.dashboard_current');});
    Route::resource('actual-do-by-type',ActualDoByTypeController::class);
    Route::resource('actual-do-salesforces',ActualDoSalesForceController::class);
    Route::resource('actual-inquary-by-type', ActualInquaryByTypeController::class);
    Route::resource('actual-sales-by-leasing', ActualSalesByLeasingController::class);
    Route::resource('actual-salesforces', ActualSalesForceController::class);
    Route::resource('actual-source-do-inquary', ActualSourceDoInquaryController::class);
    Route::resource('actual-source-inquary', ActualSourceInquaryController::class);
    Route::resource('actual-spk-by-type', ActualSpkByTypeController::class);
});


Route::prefix('evaluasi')->group(function () {
    Route::get('/dashboard', function () {return view('evaluasi.dashboard_evaluasi');});
    Route::resource('evaluasi', EvaluasiWiraniagaController::class);
});


Route::prefix('summary')->name('summary.')->group(function () {
    Route::get('/dashboard', function () {return view('summary.dashboard_summary');});
    Route::resource('summary', SummaryController::class);
    Route::resource('summaryaction', SummaryActionController::class);
});

