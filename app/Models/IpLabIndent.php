<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpLabIndent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function indent_items()
    {
        return $this->hasMany(IpLabIndentItem::class);
    }

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function indent_billing()
    {
        return $this->hasOne(IpServiceBilling::class, "ip_lab_indent_id");
    }
}
