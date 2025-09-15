<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PurchaseOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [ 'vendor_id', 'stock_point_id', 'purchase_term_id', 'purchase_indent_id', 'code', 'status', 'remarks', 'created_by_id',];
    public function stockpoint(){
        return $this->belongsTo(StockPoint::class,'stock_point_id');
     }
     public function vendor(){
        return $this->belongsTo(\App\Models\Vendor::class,'vendor_id');
     }
  
     public function purchaseindent(){
      return $this->belongsTo(\App\Models\PurchaseIndent::class,'purchase_indent_id');
   }     public function purchaseOrderItems(){
      return $this->hasMany(PurchaseOrderItem::class,'purchase_order_id');
     }

     public function purchaseterm(){
      return $this->belongsTo(\App\Models\PurchaseTerm::class,'purchase_term_id');
     }

public function calSubtotal($purchase_id){
   $purchaseOrderItems=\App\Models\PurchaseOrderItem::where('purchase_order_id',$purchase_id)->get();
   $subTotal=0.0;
   foreach($purchaseOrderItems as $purchaseOrderItem){
      $subTotal=$subTotal+(float)$purchaseOrderItem->quantity * (float)$purchaseOrderItem->unitrate;
   }
   return $subTotal;
}
public function calDiscount($purchase_id){
   $purchaseOrderItems=\App\Models\PurchaseOrderItem::where('purchase_order_id',$purchase_id)->get();
   $discountedAmount=0.0;
   $subTotal=0.0;
      foreach($purchaseOrderItems as $purchaseOrderItem){
   
       $subTotal=$subTotal+(float)$purchaseOrderItem->quantity * (float)$purchaseOrderItem->unitrate;
      
       if($purchaseOrderItem->discount_percent!=null){
         $discountedAmount=$discountedAmount +( ((float)$purchaseOrderItem->quantity * (float)$purchaseOrderItem->unitrate)*$purchaseOrderItem->discount_percent/100);
       }
      }
  return  $discountedAmount;
}

public function calTaxamount($purchase_id){
   $purchaseOrderItems=\App\Models\PurchaseOrderItem::where('purchase_order_id',$purchase_id)->get();
   $taxAmount=0.0;
   foreach($purchaseOrderItems as $purchaseOrderItem){
     $currentSubtoal=(float)$purchaseOrderItem->quantity * (float)$purchaseOrderItem->unitrate;
     $currentDiscount= $currentSubtoal *$purchaseOrderItem->discount_percent/100;
     $currentTax=($currentSubtoal-$currentDiscount)*$purchaseOrderItem->item->igst/100;
     $taxAmount=$taxAmount +$currentTax;
   }
   return $taxAmount;
}

public function calGrandtotal($purchase_id){
   return $this->calSubtotal($purchase_id) - $this->calDiscount($purchase_id) + $this->calTaxamount($purchase_id);
}

}

