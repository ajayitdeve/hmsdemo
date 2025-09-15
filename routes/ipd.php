<?php

use App\Http\Controllers\IpBillingController;
use App\Http\Livewire\Ipd\CorporateRegistration\CorporateRegistration;
use App\Http\Livewire\Ipd\CorporateRelation\CorporateRelationMaster;
use App\Http\Livewire\Ipd\Organization\OrganizationMaster;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Ipd\Bed\BedMaster;
use App\Http\Livewire\Ipd\Room\RoomMaster;
use App\Http\Livewire\Ipd\Ward\WardMaster;
use App\Http\Controllers\Ipd\BedController;
use App\Http\Controllers\Ipd\CorporateRegistrationController;
use App\Http\Livewire\FrontDesk\ADT\InPatientCreditLimit\InpatientCreditLimit;
use App\Http\Livewire\FrontDesk\ADT\IpService\IpService;
use App\Http\Livewire\FrontDesk\ADT\IpService\IpServiceList;
use App\Http\Livewire\FrontDesk\BedStatusEnquiry\BedStatusEnquiry;
use App\Http\Livewire\FrontDesk\InPatientEnquiry\InPatientEnquiry;
use App\Http\Livewire\FrontDesk\Wallet\WalletList;
use App\Http\Livewire\Ipd\CorporateRegistration\CorporateRegistrationList;
use App\Http\Livewire\Ipd\InPatientPreRefund\InPatientPreRefundList;
use App\Http\Livewire\Ipd\InPatientPreRefund\InPatientPreRefundMaster;
use App\Http\Livewire\Ipd\Ipd\IpdAdmission;
use App\Http\Livewire\Ipd\IpdDischarge\IpdDischargeList;
use App\Http\Livewire\Ipd\IpdDischarge\IpdDischargeMaster;
use App\Http\Livewire\Ipd\IpdFinalBill\IpdFinalBillList;
use App\Http\Livewire\Ipd\IpdFinalBill\IpdFinalBillMaster;
use App\Http\Livewire\Ipd\IpdList\IpdList;
use App\Http\Livewire\Ipd\WardGroup\WardGroupMaster;
use App\Http\Livewire\Ipd\WardTariff\WardTariffMaster;
use App\Http\Livewire\Ipd\NurseStation\NurseStationMaster;
use App\Http\Livewire\Ipd\OrganizationPharmacyDiscountMaster;
use App\Http\Livewire\Ipd\OrganizationTariffMaster;
use App\Models\Ipd\Bed;
use App\Models\Ipd\Ipd;

Route::middleware(['auth'])->name('admin.ipd.')->prefix('admin')->group(function () {

  Route::get('/ipd/nurse-station-master', NurseStationMaster::class)->name('nurse-station-master');
  Route::get('/ipd/ward-tariff-master', WardTariffMaster::class)->name('ward-tariff-master');
  Route::get('/ipd/ward-group-master', WardGroupMaster::class)->name('ward-group-master');
  Route::get('/ipd/ward-master', WardMaster::class)->name('ward-master');
  Route::get('/ipd/room-master', RoomMaster::class)->name('room-master');
  Route::get('/ipd/bed-master/{room_id}', BedMaster::class)->name('bed-master');
  Route::get('/ipd/import-beds-form/{ward_id}/{room_id}', [BedController::class, 'import_beds_form'])->name('import-beds-form');
  Route::post('/ipd/import-beds', [BedController::class, 'import_beds'])->name('import-beds');
  Route::get('/ipd/admission', IpdAdmission::class)->name('admission');
  Route::get('/ipd/ipd-list', IpdList::class)->name('ipd-list');

  //Corporate Registration And Corporate Consultation
  Route::get('/ipd/organization-master', OrganizationMaster::class)->name('organization-master');
  Route::get('/ipd/corporate-relation-master', CorporateRelationMaster::class)->name('corporate-relation-master');
  Route::get('/ipd/corporate-registration', CorporateRegistration::class)->name('corporate-registration');
  Route::get('/ipd/corporate-registration/list', CorporateRegistrationList::class)->name('corporate-registration-list');
  Route::get('/ipd/corporate-registration/{id}/print', [CorporateRegistrationController::class, 'print'])->name('corporate-registration-print');

  // Route::get('/ipd/corporate-consultation', CorporateConsultation::class)->name('corporate-consultation');
  // Route::get('/ipd/corporate-consultation/list', CorporateConsultationList::class)->name('corporate-consultation-list');

  Route::get('/ipd/organization-tariff-master', OrganizationTariffMaster::class)->name('organization-tariff-master');
  // Route::get('/ipd/organization-pharmacy-discount-master', OrganizationPharmacyDiscountMaster::class)->name('organization-pharmacy-discount-master');

  // In Patient Pre Refund
  Route::get('/ipd/in-patient-pre-refund/list', InPatientPreRefundList::class)->name('in-patient-pre-refund');
  Route::get('/ipd/in-patient-pre-refund', InPatientPreRefundMaster::class)->name('in-patient-pre-refund.create');
  Route::get('/ipd/in-patient-pre-refund/{id}/print', [IpBillingController::class, 'ip_in_patient_pre_refund_print'])->name('in-patient-pre-refund.print');

  // Ipd Final Bills
  Route::get('/ipd/ip-final-bill/list', IpdFinalBillList::class)->name('ip-final-bill-master');
  Route::get('/ipd/ip-final-bill', IpdFinalBillMaster::class)->name('ip-final-bill.create');
  Route::get('/ipd/ip-final-bill/{id}/print', [IpBillingController::class, 'ip_final_bill_print'])->name('ip-final-bill.print');

  Route::get('/ipd/ip-discharge/list', IpdDischargeList::class)->name('ip-discharge-master');
  Route::get('/ipd/ip-discharge', IpdDischargeMaster::class)->name('ip-discharge.create');
  Route::get('/ipd/ip-discharge/{id}/print', [IpBillingController::class, 'ip_discharge_print'])->name('ip-discharge.print');
});

Route::middleware(['auth'])->name('admin.front-desk.')->prefix('admin')->group(function () {
  Route::prefix('adt')->name("adt.")->group(function () {
    Route::prefix('ip-service')->name("ip-service.")->group(function () {
      Route::get('/create', IpService::class)->name('create');
      Route::get('/', IpServiceList::class)->name('list');

      Route::get('/print/{bill_id}', [IpBillingController::class, 'ip_service_billing_print'])->name('billing.print');
    });

    Route::prefix('patient')->name("patient.")->group(function () {
      Route::get('/credit-limit', InpatientCreditLimit::class)->name('credit-limit');
    });
  });

  Route::get('/wallet', WalletList::class)->name('wallet');

  Route::get('/in-patient-enquiry', InPatientEnquiry::class)->name('in-patient-enquiry');
  Route::get('/bed-status-enquiry', BedStatusEnquiry::class)->name('bed-status-enquiry');
});
