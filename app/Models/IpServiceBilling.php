<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Pathology\IpdSampleCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpServiceBilling extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function billing_items()
    {
        return $this->hasMany(IpServiceBillingItem::class);
    }

    public function lab_indent()
    {
        return $this->belongsTo(IpLabIndent::class, "ip_lab_indent_id");
    }

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ipServiceDue()
    {
        return $this->hasOne(IpServiceDue::class, "ip_service_billing_id", "id");
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id", "id");
    }

    public function ipd_sample_collection()
    {
        return $this->hasOne(IpdSampleCollection::class);
    }
}
