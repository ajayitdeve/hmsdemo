<?php

namespace App\Models\Pathology;

use App\Models\Doctor;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\OpdBilling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticResult extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['patient_id', 'patient_visit_id', 'out_side_patient_id', 'code', 'doctor_id', 'patient_type', 'sample_collection_id', 'opd_billing_id', 'ref_no', 'status', 'result_date', 'created_by_id', 'updated_by_id', 'approved_by_id'];

    public function diagnosticResultValues()
    {
        return $this->hasMany(DiagnosticResultValue::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function opdBilling()
    {
        return $this->belongsTo(OpdBilling::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function sampleCollection()
    {
        return $this->belongsTo(SampleCollection::class);
    }


    public function outSidePatient()
    {
        return $this->belongsTo(OutSidePatient::class);
    }
}
