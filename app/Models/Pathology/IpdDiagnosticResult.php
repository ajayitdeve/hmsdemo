<?php

namespace App\Models\Pathology;

use App\Models\Doctor;
use App\Models\IpServiceBilling;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpdDiagnosticResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function diagnosticResultValues()
    {
        return $this->hasMany(IpdDiagnosticResultValue::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ip_service_billing()
    {
        return $this->belongsTo(IpServiceBilling::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function sampleCollection()
    {
        return $this->belongsTo(SampleCollection::class);
    }
}
