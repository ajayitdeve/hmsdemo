<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\NurseStation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPharmacyIndent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function indent_items()
    {
        return  $this->hasMany(IpPharmacyIndentItem::class);
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

    public function nurse_station()
    {
        return $this->belongsTo(NurseStation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }

    public function indent_billing()
    {
        return $this->hasOne(IpPharmacyIndentBilling::class, "ip_pharmacy_indent_id");
    }
}
