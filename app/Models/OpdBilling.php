<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pathology\SampleCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpdBilling extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function opdBillingItems()
    {
        return $this->hasMany(OpdBillingItems::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function patientVisit()
    {
        return $this->belongsTo(PatientVisit::class);
    }

    public function serviceDue()
    {
        return $this->hasOne(ServiceDue::class, 'opd_billing_id', 'id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function outSidePatient()
    {
        return $this->belongsTo(OutSidePatient::class, 'out_side_patient_id', 'id');
    }
    public function sampleCollection()
    {
        return $this->hasOne(SampleCollection::class);
    }

    public function diagnosticResult()
    {
        return $this->hasOne(SampleCollection::class, "opd_billing_id", "id");
    }
}
