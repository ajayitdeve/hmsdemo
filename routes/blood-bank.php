<?php

use App\Http\Livewire\BloodBank\BloodRequisitionRequest\BloodRequisitionRequest;
use App\Http\Livewire\BloodBank\BloodRequisitionRequest\BloodRequisitionRequestCreate;
use App\Http\Livewire\BloodBank\BloodRequisitionRequest\BloodRequisitionRequestEdit;
use App\Http\Livewire\BloodBank\DonorBleeding\DonorBleeding;
use App\Http\Livewire\BloodBank\DonorBleeding\DonorBleedingCreate;
use App\Http\Livewire\BloodBank\DonorBleeding\DonorBleedingEdit;
use App\Http\Livewire\BloodBank\DonorQuestionnaireConsent\DonorQuestionnaireConsent;
use App\Http\Livewire\BloodBank\DonorQuestionnaireConsent\DonorQuestionnaireConsentCreate;
use App\Http\Livewire\BloodBank\DonorQuestionnaireConsent\DonorQuestionnaireConsentEdit;
use App\Http\Livewire\BloodBank\DonorRegistration\DonorRegistration;
use App\Http\Livewire\BloodBank\DonorRegistration\DonorRegistrationCreate;
use App\Http\Livewire\BloodBank\DonorRegistration\DonorRegistrationEdit;
use App\Http\Livewire\BloodBank\TransfusionReaction\TransfusionReactionCreate;
use App\Http\Livewire\BloodBank\TransfusionReaction\TransfusionReactionEdit;
use App\Http\Livewire\BloodBank\TransfusionReaction\TransfusionReactionList;
use App\Http\Livewire\BloodBank\TransfusionReactionReturn\TransfusionReactionReturnList;
use App\Http\Livewire\Master\BagType\BagTypeMaster;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/bag-type-master', BagTypeMaster::class)->name('bag-type-master');

    Route::get('/blood-requisition/request', BloodRequisitionRequest::class)->name('blood-requisition-request');
    Route::get('/blood-requisition/request/create', BloodRequisitionRequestCreate::class)->name('blood-requisition-request.create');
    Route::get('/blood-requisition/request/{id}/edit', BloodRequisitionRequestEdit::class)->name('blood-requisition-request.edit');

    Route::prefix('blood-bank')->name("blood-bank.")->group(function () {
        Route::get('/donor/registration', DonorRegistration::class)->name('donor-registration');
        Route::get('/donor/registration/create', DonorRegistrationCreate::class)->name('donor-registration.create');
        Route::get('/donor/registration/{id}/edit', DonorRegistrationEdit::class)->name('donor-registration.edit');

        Route::get('/donor/questionnaire-and-consent', DonorQuestionnaireConsent::class)->name('donor-questionnaire-and-consent');
        Route::get('/donor/questionnaire-and-consent/create', DonorQuestionnaireConsentCreate::class)->name('donor-questionnaire-and-consent.create');
        Route::get('/donor/questionnaire-and-consent/{id}/edit', DonorQuestionnaireConsentEdit::class)->name('donor-questionnaire-and-consent.edit');

        Route::get('/donor/bleeding', DonorBleeding::class)->name('donor-bleeding');
        Route::get('/donor/bleeding/create', DonorBleedingCreate::class)->name('donor-bleeding.create');
        Route::get('/donor/bleeding/{id}/edit', DonorBleedingEdit::class)->name('donor-bleeding.edit');
    });

    Route::get('/transfusion-reaction', TransfusionReactionList::class)->name('transfusion-reaction');
    Route::get('/transfusion-reaction/create', TransfusionReactionCreate::class)->name('transfusion-reaction.create');
    Route::get('/transfusion-reaction/{id}/edit', TransfusionReactionEdit::class)->name('transfusion-reaction.edit');

    Route::get('/transfusion-return', TransfusionReactionReturnList::class)->name('transfusion-return');
});
