<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtPreOperation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ot_booking()
    {
        return $this->belongsTo(OtBooking::class);
    }

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
        return $this->hasMany(OtPreOperationAttendant::class, 'ot_pre_operation_id');
    }

    public function anaesthesia_check_first_record()
    {
        return $this->hasOne(OtPreOperationAnaesthesiaCheckFirstRecord::class);
    }

    public function anaesthesia_check_second_record()
    {
        return $this->hasOne(OtPreOperationAnaesthesiaCheckSecondRecord::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
