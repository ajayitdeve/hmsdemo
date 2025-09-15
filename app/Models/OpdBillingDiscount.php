<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpdBillingDiscount extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['opd_billing_id','discount','discount_approved_by_id'];
}
