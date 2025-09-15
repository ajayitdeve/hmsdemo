<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpFinalBilling extends Model
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

    public function due_authorized_by()
    {
        return $this->belongsTo(Organization::class, "due_authorized_by_id");
    }

    public function concession_authorized_by()
    {
        return $this->belongsTo(Organization::class, "concession_authorized_by_id");
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
