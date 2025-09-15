<?php

namespace App\Models\Ipd;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\VisitType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateConsultation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function visit_type()
    {
        return $this->belongsTo(VisitType::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
