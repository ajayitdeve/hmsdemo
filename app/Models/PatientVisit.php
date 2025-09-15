<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientVisit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function visitType()
    {
        return $this->belongsTo(VisitType::class, 'visit_type_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ipd()
    {
        return $this->hasOne(Ipd::class, "patient_visit_id", "id");
    }

    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class, 'unit_id');
    }

    public function doctor()
    {
        return $this->belongsTo(\App\Models\Doctor::class, 'doctor_id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }

    public function refers()
    {
        return $this->hasMany(\App\Models\Refer::class, 'patient_visit_id');
    }


    public function scopeSearch($query, $value)
    {
        // $result= DB::table('patient_visits')
        // ->join('patients','patient_visits.patient_id','=','patients.id')
        // ->where('patients.name','like',"%{$value}%")
        // ->orWhere('patients.registration_no','like',"%{$value}%")
        // ->orWhere('patient_visits.visit_no','like',"%{$value}%")

        // ;
        $result = PatientVisit::join('patients', 'patient_visits.patient_id', '=', 'patients.id')
            ->where('patients.name', 'like', "%{$value}%")
            ->orWhere('patients.registration_no', 'like', "%{$value}%")
            ->orWhere('patient_visits.visit_no', 'like', "%{$value}%");

        return   $result;
    }

    public function scopeFilter($query, $from, $to)
    {
        // $result= DB::table('patient_visits')
        // ->join('patients','patient_visits.patient_id','=','patients.id')
        // ->orWhereBetween('patient_visits.visit_date', [$from, $to])
        // ;


        $result = PatientVisit::join('patients', 'patient_visits.patient_id', '=', 'patients.id')
            ->orWhereBetween('patient_visits.visit_date', [$from, $to]);

        return   $result;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
