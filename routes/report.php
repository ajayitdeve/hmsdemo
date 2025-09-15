<?php

use App\Http\Livewire\Report\CancellationReport\CancellationReport;
use App\Http\Livewire\Report\ChangePatientReport\ChangePatientReport;
use App\Http\Livewire\Report\IpAdmissionReport\IpAdmissionReport;
use App\Http\Livewire\Report\IpAdvanceReport\IpAdvanceReport;
use App\Http\Livewire\Report\IpExpenditureReport\IpExpenditureReport;
use App\Http\Livewire\Report\MonthDayWiseReport\MonthDayWiseReport;
use App\Http\Livewire\Report\OpConsultationReport\OpConsultationReport;
use App\Http\Livewire\Report\ReceiptWiseShiftCollection\ReceiptWiseShiftCollection;
use App\Http\Livewire\Report\OpdRegisterReport\OpdRegisterReport;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::prefix('report')->name("report.")->group(function () {
        Route::get('/op-consultation-report', OpConsultationReport::class)->name('op-consultation-report');
        Route::get('/receipt-wise-shift-collection', ReceiptWiseShiftCollection::class)->name('receipt-wise-shift-collection');
        // Route::get('/change-patient-report', ChangePatientReport::class)->name('change-patient-report');
        Route::get('/cancellation-report', CancellationReport::class)->name('cancellation-report');
        Route::get('/month-day-wise-report', MonthDayWiseReport::class)->name('month-day-wise-report');

        Route::get('/ip-admission-report', IpAdmissionReport::class)->name('ip-admission-report');

        Route::get('/ip-advance-report', IpAdvanceReport::class)->name('ip-advance-report');
        // Route::get('/ip-expenditure-report', IpExpenditureReport::class)->name('ip-expenditure-report');

        // Route::get('/opd-register-report', OpdRegisterReport::class)->name('opd-register-report');
    });
});

// Report/IpExpenditureReport/IpExpenditureReport