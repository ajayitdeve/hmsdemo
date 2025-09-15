<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpServiceDue extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ip_service_billing()
    {
        return $this->belongsTo(IpServiceBilling::class,'ip_service_billing_id','id');
    }
}
