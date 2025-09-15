<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtBooking extends Model
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

    public function ot_type()
    {
        return $this->belongsTo(OtType::class);
    }

    public function ot()
    {
        return $this->belongsTo(Ot::class);
    }

    public function attendants()
    {
        return $this->hasMany(OtBookingAttendant::class, 'ot_booking_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function day_care()
    {
        return $this->hasOne(OtDayCare::class, 'ot_booking_id');
    }

    public function pre_operation()
    {
        return $this->hasOne(OtPreOperation::class, 'ot_booking_id');
    }

    public function post_operation()
    {
        return $this->hasOne(OtPostOperation::class, 'ot_booking_id');
    }
}
