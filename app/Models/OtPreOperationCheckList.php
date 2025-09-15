<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtPreOperationCheckList extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

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

    public function blood_group()
    {
        return $this->belongsTo(Bloodgroup::class, 'bloodgroup_id');
    }

    public function patient_checklist()
    {
        return $this->hasOne(OtPreOperationPatientCheckList::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
