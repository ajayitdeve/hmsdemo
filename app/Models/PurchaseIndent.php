<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseIndent extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = ['stock_point_id', 'vendor_id', 'type_id', 'code', 'date', 'request_date', 'status', 'remarks'];
   public function stockpoint()
   {
      return $this->belongsTo(StockPoint::class, 'stock_point_id');
   }
   public function vendor()
   {
      return $this->belongsTo(\App\Models\Vendor::class, 'vendor_id');
   }
   public function type()
   {
      return $this->belongsTo(\App\Models\Type::class, 'type_id');
   }
   public function indentitems()
   {
      return $this->hasMany(\App\Models\IndentItem::class);
   }
   public function purchaseorder()
   {
      return $this->hasMany(\App\Models\PurchaseOrder::class, 'purchase_indent_id');
   }
}
