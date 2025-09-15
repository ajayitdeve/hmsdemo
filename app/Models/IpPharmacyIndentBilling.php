<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPharmacyIndentBilling extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ip_billing_items()
    {
        return $this->hasMany(IpPharmacyIndentBillingItem::class);
    }

    public function pharmacy_indent()
    {
        return $this->belongsTo(IpPharmacyIndent::class, "ip_pharmacy_indent_id", "id");
    }

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function stock_point()
    {
        return $this->belongsTo(StockPoint::class);
    }

    public function IpPharmacyDue()
    {
        return $this->hasOne(IpPharmacyDue::class, 'ip_pharmacy_indent_billing_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
