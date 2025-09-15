<?php

namespace App\Models\Service;

use App\Models\CorporateServiceFee;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\IpServiceBillingItem;
use App\Models\OpdBillingItems;
use App\Models\Service\Teriff;
use App\Models\Pathology\Format;
use App\Models\Pathology\Template;
use App\Models\Pathology\SpecimenSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function teriff()
    {
        return $this->belongsTo(Teriff::class, 'teriff_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function servicegroup()
    {
        return $this->belongsTo(ServiceGroup::class, 'service_group_id');
    }
    public function billinghead()
    {
        return $this->belongsTo(BillingHead::class, 'billing_head_id');
    }
    public function costcenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id');
    }

    public function specimenSetup()
    {
        return $this->hasOne(SpecimenSetup::class);
    }

    public function format()
    {
        return $this->hasOne(Format::class);
    }
    // public function formats(){
    //     return $this->hasMany(Format::class);
    // }


    public function template()
    {
        return $this->hasOne(Template::class);
    }

    public function opd_billing_items()
    {
        return $this->hasMany(OpdBillingItems::class);
    }

    public function ip_service_billing_items()
    {
        return $this->hasMany(IpServiceBillingItem::class);
    }

    public function corporate_service_fee()
    {
        return $this->hasOne(CorporateServiceFee::class);
    }
}
