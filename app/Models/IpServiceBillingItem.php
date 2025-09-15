<?php

namespace App\Models;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpServiceBillingItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function ip_service_billing()
    {
        return $this->belongsTo(IpServiceBilling::class);
    }
}
