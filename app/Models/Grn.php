<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Grn extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['vendor_id', 'purchase_order_id', 'code', 'invoice_no', 'invoice_date', 'invoice_value', 'remarks', 'created_by_id',] ;

 public function purchaseOrder(){
    return $this->belongsTo(PurchaseOrder::class);
 }
 public function vendor(){
    return $this->belongsTo(Vendor::class);
 }

 public function createdBy(){
    return $this->belongsTo(User::class,'created_by_id','id');
 }

}
