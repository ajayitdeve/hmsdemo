<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodRequisitionRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function out_side_patient()
    {
        return $this->belongsTo(OutSidePatient::class, 'out_side_patient_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function blood_group()
    {
        return $this->belongsTo(Bloodgroup::class, "bloodgroup_id");
    }

    public function sample_blood_groups()
    {
        return $this->hasMany(BloodRequisitionRequestSampleBloodGroup::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
