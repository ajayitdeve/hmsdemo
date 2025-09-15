<?php

namespace App\Models\Ipd;

use App\Models\AdminType;
use App\Models\AdmissionPurpose;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Unit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ipd extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['patient_id', 'corporate_registration_id', 'patient_visit_id', 'cost_center_id', 'department_id', 'unit_id', 'ward_id', 'room_id', 'bed_id', 'referral_id', 'nationality_id', 'admin_type_id', 'case_type_id', 'admission_purpose_id', 'ipdcode', 'reason', 'company', 'policy_no', 'payment_by', 'payment', 'exp_app_amt', 'diet', 'admit_type', 'expected_stay_days', 'mother_admission_no', 'is_with_mother', 'pan_no', 'type_of_admin', 'estimated_amt', 'patient_source', 'passport_no'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function corporate_registration()
    {
        return $this->belongsTo(CorporateRegistration::class, 'corporate_registration_id', 'id');
    }

    public function admin_type()
    {
        return $this->belongsTo(AdminType::class, 'admin_type_id', 'id');
    }

    public function admin_purpose()
    {
        return $this->belongsTo(AdmissionPurpose::class, 'admission_purpose_id', 'id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'ipd_id', 'id');
    }

    public function patient_visit()
    {
        return $this->belongsTo(PatientVisit::class, "patient_visit_id", "id");
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, "ward_id", "id");
    }

    public function room()
    {
        return $this->belongsTo(Room::class, "room_id", "id");
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class, "bed_id", "id");
    }

    public function patientBeds()
    {
        return $this->hasMany(PatientBed::class, 'ipd_id', 'id');
    }

    public function cost_center()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
