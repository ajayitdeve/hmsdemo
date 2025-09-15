<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodDonorBleeding extends Model
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
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function bag_type()
    {
        return $this->belongsTo(BagType::class);
    }

    public function blood_group()
    {
        return $this->belongsTo(Bloodgroup::class, "bloodgroup_id");
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function questionnaire_consent()
    {
        return $this->belongsTo(BloodDonorQuestionnaireConsent::class, "blood_donor_questionnaire_consent_id");
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
