<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpDischarge extends Model
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

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function dischargeType()
    {
        return $this->belongsTo(DischargeType::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
