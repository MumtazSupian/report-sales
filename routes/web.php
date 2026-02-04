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

Route::get('/', function () {
    return view('dashboard');
});


Route::prefix('rka')->name('rka.')->group(function () {
    Route::get('/dashboard', function () {return view('rka.dashboard_rka');});
    Route::resource('target-do-units', TargetDoUnitController::class);
    Route::resource('target-salesforces', TargetSalesforceController::class);
    Route::resource('target-inquiries', TargetInquiryController::class);
    Route::resource('target-do-by-soi', TargetDoBySoiController::class);
});

Route::prefix('leasing')->name('leasing.')->group(function () {
    Route::get('/dashboard', function () {return view('leasing.dashboard_leasing');});
    Route::resource('aktual-aplikasi-in',AktualAplikasiInController::class);
    Route::resource('aktual-po',AktualPoController::class);
    Route::resource('aktual-reject',AktualRejectController::class);
});


Route::prefix('activity')->name('activity.')->group(function () {
    Route::get('/dashboard', function () {return view('activity.dashboard_activity');});
    Route::resource('activity', ActivityPlanController::class);
});

