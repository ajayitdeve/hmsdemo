<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtPreBooking extends Model
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function surgery_type()
    {
        return $this->belongsTo(SurgeryType::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
