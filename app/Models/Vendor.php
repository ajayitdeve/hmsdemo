<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['code', 'name', 'legal_name', 'cst_no', 'drug_license_no', 'drug_license_exp_date', 'gst_no', 'pan_no', 'payment_days', 'delivery_days', 'type_id',];
    public function purchaseindents(){
        return $this->hasMany(\App\Models\PurchaseIndent::class);
        }
}
