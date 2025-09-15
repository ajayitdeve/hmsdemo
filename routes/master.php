<?php

use App\Http\Livewire\Master\AdminPurpose\AdminPurposeMaster;
use App\Http\Livewire\Master\AdminType\AdminTypeMaster;
use App\Http\Livewire\Master\CaseType\CaseTypeMaster;
use App\Http\Livewire\Master\CategoryMaster;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Master\Unit\UnitMaster;
use App\Http\Livewire\Master\Title\TitleMaster;
use App\Http\Livewire\AddressMaster\BlockMaster;
use App\Http\Livewire\AddressMaster\StateMaster;
use App\Http\Livewire\Doctor\DoctorRegistration;
use App\Http\Livewire\Master\Gender\GenderMaster;
use App\Http\Livewire\AddressMaster\CountryMaster;
use App\Http\Livewire\AddressMaster\VillageMaster;
use App\Http\Livewire\AddressMaster\DistrictMaster;
use App\Http\Livewire\Master\Marital\MaritalMaster;
use App\Http\Livewire\Master\Referral\ReferralMaster;
use App\Http\Livewire\Master\Relation\RelationMaster;
use App\Http\Livewire\Master\Religion\ReligionMaster;
use App\Http\Livewire\Admin\ReferralOther\ReferralOther;
use App\Http\Livewire\Master\BloodGroup\BloodGroupMaster;
use App\Http\Livewire\Master\Department\DepartmentMaster;
use App\Http\Livewire\Master\Occupation\OccupationMaster;
use App\Http\Livewire\Master\Referraltype\ReferraltypeMaster;
use App\Http\Livewire\Master\Specialization\SpecializationMaster;
use App\Http\Livewire\Admin\HealthCoordinator\HealthCoordinatorMaster;
use App\Http\Livewire\Master\Abnormal\AbnormalMaster;
use App\Http\Livewire\Master\DepartmentConsultationFee\DepartmentConsultationFeeMaster;
use App\Http\Livewire\Master\ChangeDepartmentConsultationFee\ChangeDepartmentConsultationFeeMaster;
use App\Http\Livewire\Master\CorporateServiceFee\CorporateServiceFeeMaster;
use App\Http\Livewire\Master\DepartmentCorporateFee\DepartmentCorporateFeeMaster;
use App\Http\Livewire\Master\DesignationMaster;
use App\Http\Livewire\Master\DischargeType\DischargeTypeMaster;
use App\Http\Livewire\Master\Equipment\EquipmentGroupMaster;
use App\Http\Livewire\Master\Equipment\EquipmentMaster;

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
  Route::get('/gender', GenderMaster::class)->name('gender-master');
  Route::get('/title', TitleMaster::class)->name('title-master');
  Route::get('/relation', RelationMaster::class)->name('relation-master');
  Route::get('/marital', MaritalMaster::class)->name('marital-master');
  Route::get('/bloodgroup', BloodGroupMaster::class)->name('bloodgroup-master');
  Route::get('/religion', ReligionMaster::class)->name('religion-master');
  Route::get('/occupation', OccupationMaster::class)->name('occupation-master');
  Route::get('department', DepartmentMaster::class)->name('department');
  Route::get('/unit', UnitMaster::class)->name('unit-master');
  Route::get('/specialization', SpecializationMaster::class)->name('doctor-specialization-master');
  Route::get('/referral-other', ReferralOther::class)->name('referral-other');
  Route::get('/health-coordinator', HealthCoordinatorMaster::class)->name('health-coordinator');

  //AddressMaster
  Route::get('/country-master', CountryMaster::class)->name('country-master');
  Route::get('state-master', StateMaster::class)->name('state-master');
  Route::get('district-master', DistrictMaster::class)->name('district-master');
  Route::get('block-master', BlockMaster::class)->name('block-master');
  Route::get('village-master', VillageMaster::class)->name('village-master');

  // Abnormal Master
  Route::get('/abnormal-master', AbnormalMaster::class)->name('abnormal-master');

  // Equipment Master
  Route::get('/equipment-group-master', EquipmentGroupMaster::class)->name('equipment-group-master');
  Route::get('/equipment-master', EquipmentMaster::class)->name('equipment-master');

  Route::get('/case-type-master', CaseTypeMaster::class)->name('case-type-master');
  Route::get('/admission-type-master', AdminTypeMaster::class)->name('admission-type-master');
  Route::get('/admission-purpose-master', AdminPurposeMaster::class)->name('admission-purpose-master');

  // Change department Consultation fee
  Route::get('department-consultation-fee', DepartmentConsultationFeeMaster::class)->name('department-consultation-fee');
  Route::get('/doctor-fee', DoctorRegistration::class)->name('doctor-fee');
  Route::get('change-department-consultation-fee', ChangeDepartmentConsultationFeeMaster::class)->name('change-department-consultation-fee');
  Route::get('department-corporate-fee', DepartmentCorporateFeeMaster::class)->name('department-corporate-fee');
  Route::get('corporate-service-fee', CorporateServiceFeeMaster::class)->name('corporate-service-fee');

  Route::get('/referraltype', ReferraltypeMaster::class)->name('referral-type-master');
  Route::get('/referral', ReferralMaster::class)->name('referral-master');
  Route::get('/doctorregistration', DoctorRegistration::class)->name('doctor-registration');

  //Route::get('/specialist',SpecialistMaster::class)->name('doctor-specialization-master');

  Route::get('/category', CategoryMaster::class)->name('category-master');
  Route::get('/designation', DesignationMaster::class)->name('designation-master');

  Route::get('/discharge-type', DischargeTypeMaster::class)->name('discharge-type-master');
});
