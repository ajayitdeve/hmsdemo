<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpPharmacyDue extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ip_pharmacy_indent_billing()
    {
        return $this->belongsTo(IpPharmacyIndentBilling::class,'ip_pharmacy_indent_billing_id','id');
    }
}
