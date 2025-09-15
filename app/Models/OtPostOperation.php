<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtPostOperation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ot_booking()
    {
        return $this->belongsTo(OtBooking::class);
    }

    public function ot_pre_operation()
    {
        return $this->belongsTo(OtPreOperation::class);
    }

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
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

    public function attendants()
    {
        return $this->hasMany(OtPostOperationAttendant::class);
    }

    public function surgeon_note()
    {
        return $this->hasOne(OtPostOperationSurgeonNote::class);
    }

    public function sample_collection_note()
    {
        return $this->hasOne(OtPostOperationSampleCollectionNote::class);
    }

    public function unit_record()
    {
        return $this->hasOne(OtPostOperationUnitRecord::class);
    }

    public function operation_note()
    {
        return $this->hasOne(OtPostOperationNote::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
