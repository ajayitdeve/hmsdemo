<?php

namespace App\Models;

use App\Models\Ipd\CorporateConsultation;
use App\Models\Ipd\CorporateRegistration;
use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['registration_no', 'password', 'registration_date', 'name', 'email', 'mobile', 'dob', 'age', 'address', 'village_id', 'pincode', 'father_name', 'mother_name', 'patient_type_id', 'title_id', 'gender_id', 'marital_id', 'bloodgroup_id', 'religion_id', 'occupation_id', 'nationality_id', 'relation_id', 'is_rural', 'remarks', 'created_by_id', 'id_type_id', 'identification_no'];


    public function salution()
    {
        return $this->belongsTo(Title::class, 'title_id');
    }
    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id', 'id');
    }
    public function relation()
    {
        return $this->belongsTo(\App\Models\Relation::class, 'relation_id');
    }
    public function religion()
    {
        return $this->belongsTo(\App\Models\Religion::class, 'religion_id');
    }
    public function gender()
    {
        return $this->belongsTo(\App\Models\Gender::class, 'gender_id');
    }
    public function patienttype()
    {
        return $this->belongsTo(\App\Models\PatientType::class, 'patient_type_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function referral()
    {
        return $this->hasOne(\App\Models\Referral::class, 'patient_id');
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function marital_status()
    {
        return $this->belongsTo(Marital::class, 'marital_id', 'id');
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('registration_no', 'like', "%{$value}%");
    }
    public function patientvisits()
    {
        return $this->hasMany(\App\Models\PatientVisit::class);
    }

    public function idType()
    {
        return $this->belongsTo(IdType::class, 'id_type_id', 'id');
    }

    public function ipds()
    {
        return $this->hasMany(Ipd::class);
    }

    public function corporate_registrations()
    {
        return $this->hasMany(CorporateRegistration::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
