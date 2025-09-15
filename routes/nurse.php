<?php

use App\Http\Livewire\Nurse\BedManagement\BedTransfer;
use App\Http\Livewire\Nurse\ChooseNurseStation\ChooseNurseStation;
use App\Http\Livewire\Nurse\CrossConsultation\CrossConsultation;
use App\Http\Livewire\Nurse\Discharge\DischargeProcessStatus;
use App\Http\Livewire\Nurse\Discharge\ToBeDischarge;
use App\Http\Livewire\Nurse\DoctorMsg\DoctorMsg;
use App\Http\Livewire\Nurse\Patient\PatientList;
use App\Http\Livewire\Nurse\DrugManagement\DrugIndent;
use App\Http\Livewire\Nurse\DrugManagement\DrugIndentList;
use App\Http\Livewire\Nurse\DrugManagement\DrugIndentView;
use App\Http\Livewire\Nurse\Equipment\EquipmentTimeEntry;
use App\Http\Livewire\Nurse\Equipment\EquipmentUsage;
use App\Http\Livewire\Nurse\NursingProcess\AbnormalEntry;
use App\Http\Livewire\Nurse\NursingProcess\DietIndent;
use App\Http\Livewire\Nurse\NursingProcess\DietSheet;
use App\Http\Livewire\Nurse\NursingProcess\InTakeOutPut;
use App\Http\Livewire\Nurse\NursingProcess\NewDietPlan;
use App\Http\Livewire\Nurse\NursingProcess\NurseNote;
use App\Http\Livewire\Nurse\NursingProcess\VitalEntry;
use App\Http\Livewire\Nurse\Patient\PatientApproximateBill;
use App\Http\Livewire\Nurse\Patient\PatientInfo;
use App\Http\Livewire\Nurse\Patient\PatientMedicalDetails;
use App\Http\Livewire\Nurse\ServiceLabIndent\LabIndent;
use App\Http\Livewire\Nurse\ServiceLabIndent\LabIndentCreate;
use App\Http\Livewire\Nurse\ServiceLabIndent\LabIndentView;
use App\Http\Livewire\Nurse\Visit\DoctorVisit;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->name('admin.nurse.')->prefix('admin')->group(function () {
    Route::get('/nurse-station', ChooseNurseStation::class)->name('nurse-station');
    Route::get('/patient-list', PatientList::class)->name('patient-list');

    Route::prefix('drug-management')->name("drug-management.")->group(function () {
        Route::get('/drug-indent/{ipd_code}', DrugIndent::class)->name('create-drug-indent');
        Route::get('/drug-indent', DrugIndentList::class)->name('drug-indent');
        Route::get('/drug-indent/view/{indent_id}', DrugIndentView::class)->name('view-drug-indent');
    });

    Route::prefix('lab-indent')->name("service-lab-indent.")->group(function () {
        Route::get('/create/{ipd_code}', LabIndentCreate::class)->name('create-lab-indent');
        Route::get('/', LabIndent::class)->name('lab-indent');
        Route::get('/view/{indent_id}', LabIndentView::class)->name('view-lab-indent');
    });

    Route::prefix('bed-management')->name("bed-management.")->group(function () {
        Route::get('/bed-transfer/{ipd_code}', BedTransfer::class)->name('bed-transfer');
    });

    Route::prefix('nursing-process')->name("nursing-process.")->group(function () {
        Route::get('/nurse-note/{ipd_code}', NurseNote::class)->name('nurse-notes');
        Route::get('/vital-entry/{ipd_code}', VitalEntry::class)->name('vital-entry');
        Route::get('/intake-output/{ipd_code}', InTakeOutPut::class)->name('intake-output');
        Route::get('/diet-indent/{ipd_code}', DietIndent::class)->name('diet-indent');
        Route::get('/new-diet-plan/{ipd_code}', NewDietPlan::class)->name('new-diet-plan');
        Route::get('/diet-sheet/{ipd_code}', DietSheet::class)->name('diet-sheet');
        Route::get('/abnormal-entry/{ipd_code}', AbnormalEntry::class)->name('abnormal-entry');
    });

    Route::prefix('discharge')->name("discharge.")->group(function () {
        Route::get('/to-be-discharge/{ipd_code}', ToBeDischarge::class)->name('to-be-discharge');
        Route::get('/discharge-process-status/{ipd_code}', DischargeProcessStatus::class)->name('discharge-process-status');
    });

    Route::get('/doctor-visit/{ipd_code}', DoctorVisit::class)->name('doctor-visit');
    Route::get('/doctor-msg/{ipd_code}', DoctorMsg::class)->name('doctor-msg');

    Route::prefix('equipment')->name("equipment.")->group(function () {
        Route::get('/equipment-usage/{ipd_code}', EquipmentUsage::class)->name('equipment-usage');
        Route::get('/equipment-time-entry/{ipd_code}', EquipmentTimeEntry::class)->name('equipment-time-entry');
    });

    Route::get('/patient-approximate-bill/{ipd_code}', PatientApproximateBill::class)->name('patient-approximate-bill');
    Route::get('/patient-info/{ipd_code}', PatientInfo::class)->name('patient-info');
    Route::get('/patient-medical-details/{ipd_code}', PatientMedicalDetails::class)->name('patient-medical-details');
    Route::get('/cross-consultation/{ipd_code}', CrossConsultation::class)->name('cross-consultation');
});
