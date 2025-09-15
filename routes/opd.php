<?php

use App\Http\Livewire\Admin\ConsultationReport\DoctorWiseConsulatation;
use App\Http\Livewire\Admin\ConsultationReport\DoctorWiseConsultation;
use App\Http\Livewire\Admin\HealthCoordinator\HealthCoordinatorMaster;
use App\Http\Livewire\FrontDesk\TodayUserWiseCollection;
use App\Http\Livewire\FrontDesk\UserWiseCashCollection;
use App\Http\Livewire\OpdBillCancel\OpdBillCancellation;
use App\Http\Livewire\OpdBilling\OpdBillingOverallDiscount;
use App\Http\Livewire\Patient\BookConsultation;
use App\Http\Livewire\Patient\EditPatient;
use App\Http\Livewire\Patient\NewConsultationList;
use App\Http\Livewire\Patient\OldConsultationList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Patient\Revisit;
use App\Http\Livewire\Patient\PatientList;
use App\Http\Controllers\PatientController;
use App\Http\Livewire\OpdBilling\OpdBilling;
use App\Http\Livewire\Refer\ReferOpdPatient;
use App\Http\Controllers\OpdBillingController;
use App\Http\Livewire\Patient\ConsultationList;
use App\Http\Controllers\PatientVisitController;
use App\Http\Livewire\Patient\NewPatientRegistration;
use App\Http\Controllers\ConsultationChargeController;
use App\Http\Livewire\OpdBillingOutSidePatient\OpdBillingOutSidePatient;
use App\Http\Livewire\RegistrationWithConsultation\RegistrationWithConsultationMaster;

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    //Patient Registration Routes
    Route::get('/patient/create', NewPatientRegistration::class)->name('patient.create');
    Route::get('/patient/list', PatientList::class)->name('patient.list');
    //new patient receipt print
    Route::get('/patient/print-receipt/{patient_visit_id}', [PatientController::class, 'print_receipt'])->name('patient.print-receipt');
    Route::get('/patient/print_consultation_charge/{patient_visit_id}', [PatientController::class, 'print_consultation_charge'])->name('patient.print_consultation_charge');
    Route::get('/patient/book-consultation/{patient_id}', [PatientController::class, 'book_consultation'])->name('patient.book-consultation');
    Route::any('/patient/save-book-consultation', [PatientController::class, 'save_book_consultation'])->name('patient.save-book-consultation');
    //book consultation
    Route::get('/patient/book-consultation/{patient_id}', BookConsultation::class)->name('patient.book-consultation');


    //patient PatientVisit i.e. Consultation List
    Route::get('/patient/consultation-list', ConsultationList::class)->name('patient.consultation-list');
    Route::get('/patient/old-consultation-list', OldConsultationList::class)->name('patient.old-consultation-list');
    Route::get('/patient/new-consultation-list', NewConsultationList::class)->name('patient.new-consultation-list');

    //Route::get('/patient/consultation-list', AllConsultation::class)->name('patient.consultation-list');
    // Route::get('/datatable-livewire', AllConsultation::class);
    //doctor wise consultation list
    Route::get('/patient-visit/doctor-wise-consultation', [PatientVisitController::class, 'doctor_wise_consultation'])->name('patient-visit.doctor-wise-consultation');
    //doctor wise consultation list
    Route::get('/patient-visit/doctor-wise-consultation-list/{doctor_id}', [PatientVisitController::class, 'doctor_wise_consultation_list'])->name('patient-visit.doctor-wise-consultation-list');
    //consultationcharges
    Route::get('/consultation-charges/index', [ConsultationChargeController::class, 'index'])->name('consultation-charges.index');
    //OpdCoredinator
    Route::get('/opd-cordinator/assign-doctor', \App\Http\Livewire\OpdCoordinator\AssignDoctor::class)->name('opd-coordinator.assign-doctor');
    //Route::get('/opd-cordinator/assign-doctor', AssignDoctorDataTable::class)->name('opd-coordinator.assign-doctor');

    //Refer
    Route::get('/refer-patient', ReferOpdPatient::class)->name('refer-patient');
    //RegistrationWithConsultaion
    Route::get('/registration-with-consultation', RegistrationWithConsultationMaster::class)->name('patient.registration-with-consultation');
    //revisit
    Route::get('/revisit', Revisit::class)->name('patient.revisit');

    //Opd Billing
    Route::get('/opd-billing', OpdBilling::class)->name('opd-billing');
    //Opd Billing-overall Discount
    Route::get('/opd-billing-overall-discount', OpdBillingOverallDiscount::class)->name('opd-billing-overall-discount');



    Route::get('opd-billing-receipt-print/{opd_billing_receipt_id}', [OpdBillingController::class, 'print'])->name('opd_billing_receipt_print');
    //opdbilling print for overall discount
    Route::get('opd-billing-overall-discount-receipt-print/{opd_billing_receipt_id}', [OpdBillingController::class, 'print_overall_discount'])->name('opd-billing-overall-discount-receipt-print');
    //OPD Billing OutSidePatient osp-out side patient
    Route::get('/opd-billing-osp', OpdBillingOutSidePatient::class)->name('opd-billing-osp');
    Route::get('opd-billing-osp-receipt-print/{opd_billing_receipt_id}', [OpdBillingController::class, 'print_osp'])->name('opd_billing_receipt_osp_print');
    Route::get('all-opd-bill', [OpdBillingController::class, 'index'])->name('all-opd-bill');
    //Cancle Bill
    Route::get('opd-bill-cancellation', OpdBillCancellation::class)->name('opd-bill-cancellation');

    //front desk routes
    Route::get('front-desk/user-wise-cash-collection', UserWiseCashCollection::class)->name('front-desk.user-wise-cash-collection');
    Route::get('front-desk/today-user-wise-cash-collection', TodayUserWiseCollection::class)->name('front-desk.today-user-wise-cash-collection');
    //route for patient edit
    Route::get('patient/edit-patient/{id}', EditPatient::class)->name('patient.edit-patient');



    //DoctorWise Consulatation

    Route::get('/consultation/doctor-wise-consultation/{doctor_id}', DoctorWiseConsultation::class)->name('consultation.doctor-wise-consultation');
});
