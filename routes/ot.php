<?php

use App\Http\Livewire\Master\Ot\AnesthesiaTypeMaster;
use App\Http\Livewire\Master\Ot\OtMaster;
use App\Http\Livewire\Master\Ot\OtTypeMaster;
use App\Http\Livewire\Master\Ot\SurgeryMaster;
use App\Http\Livewire\Master\Ot\SurgeryTypeMaster;
use App\Http\Livewire\Ot\DayCareOt\DayCareOt;
use App\Http\Livewire\Ot\DayCareOt\DayCareOtEdit;
use App\Http\Livewire\Ot\DayCareOt\DayCareOtList;
use App\Http\Livewire\Ot\OtScheduling\OtScheduling;
use App\Http\Livewire\Ot\OtPreBooking\OtPreBooking;
use App\Http\Livewire\Ot\OtBooking\OtBooking;
use App\Http\Livewire\Ot\OtBooking\OtBookingEdit;
use App\Http\Livewire\Ot\OtBooking\OtBookingList;
use App\Http\Livewire\Ot\OtPreBooking\OtPreBookingEdit;
use App\Http\Livewire\Ot\OtPreBooking\OtPreBookingList;
use App\Http\Livewire\Ot\PostOperation\PostOperation;
use App\Http\Livewire\Ot\PostOperation\PostOperationEdit;
use App\Http\Livewire\Ot\PostOperation\PostOperationList;
use App\Http\Livewire\Ot\PreOperation\PreOperation;
use App\Http\Livewire\Ot\PreOperation\PreOperationEdit;
use App\Http\Livewire\Ot\PreOperation\PreOperationList;
use App\Http\Livewire\Ot\PreOperationCheckList\PreOperationCheckList;
use App\Http\Livewire\Ot\PreOperationCheckList\PreOperationCheckListEdit;
use App\Http\Livewire\Ot\PreOperationCheckList\PreOperationCheckListView;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/ot-type-master', OtTypeMaster::class)->name('ot-type-master');
    Route::get('/ot-master', OtMaster::class)->name('ot-master');
    Route::get('/surgery-type-master', SurgeryTypeMaster::class)->name('surgery-type-master');
    Route::get('/surgery-master', SurgeryMaster::class)->name('surgery-master');
    Route::get('/anesthesia-type-master', AnesthesiaTypeMaster::class)->name('anesthesia-type-master');

    Route::prefix('ot')->name("ot.")->group(function () {
        Route::get('/ot-scheduling', OtScheduling::class)->name('ot-scheduling');

        Route::get('/ot-pre-booking', OtPreBookingList::class)->name('ot-pre-booking');
        Route::get('/ot-pre-booking/create',  OtPreBooking::class)->name('ot-pre-booking.create');
        Route::get('/ot-pre-booking/{id}/edit',  OtPreBookingEdit::class)->name('ot-pre-booking.edit');

        Route::get('/ot-booking', OtBookingList::class)->name('ot-booking');
        Route::get('/ot-booking/create', OtBooking::class)->name('ot-booking.create');
        Route::get('/ot-booking/{id}/edit', OtBookingEdit::class)->name('ot-booking.edit');

        Route::get('/day-care', DayCareOtList::class)->name('day-care');
        Route::get('/day-care/create', DayCareOt::class)->name('day-care.create');
        Route::get('/day-care/{id}/edit', DayCareOtEdit::class)->name('day-care.edit');

        Route::get('/pre-operation', PreOperationList::class)->name('pre-operation');
        Route::get('/pre-operation/create', PreOperation::class)->name('pre-operation.create');
        Route::get('/pre-operation/{id}/edit', PreOperationEdit::class)->name('pre-operation.edit');

        Route::get('/pre-operation-checklist', PreOperationCheckListView::class)->name('pre-operation-checklist');
        Route::get('/pre-operation-checklist/create', PreOperationCheckList::class)->name('pre-operation-checklist.create');
        Route::get('/pre-operation-checklist/{id}/edit', PreOperationCheckListEdit::class)->name('pre-operation-checklist.edit');

        Route::get('/post-operation', PostOperationList::class)->name('post-operation');
        Route::get('/post-operation/create', PostOperation::class)->name('post-operation.create');
        Route::get('/post-operation/{id}/edit', PostOperationEdit::class)->name('post-operation.edit');
    });
});

// Ot/OTSurgeryRequest/OTSurgeryRequest