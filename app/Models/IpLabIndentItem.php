<?php

namespace App\Models;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpLabIndentItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function lab_indent()
    {
        return $this->belongsTo(IpLabIndent::class, "ip_lab_indent_id");
    }

    public function corporate_service_fee()
    {
        return $this->belongsTo(CorporateServiceFee::class, "corporate_service_fee_id");
    }
}
