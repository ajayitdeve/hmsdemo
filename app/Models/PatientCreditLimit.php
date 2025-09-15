<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientCreditLimit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function authrization()
    {
        return $this->belongsTo(Organization::class, "authrization_by");
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
