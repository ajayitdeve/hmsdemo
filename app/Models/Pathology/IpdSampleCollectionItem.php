<?php

namespace App\Models\Pathology;

use App\Models\IpServiceBillingItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpdSampleCollectionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ipd_billing_item()
    {
        return $this->belongsTo(IpServiceBillingItem::class, 'ip_service_billing_item_id', 'id');
    }
}
