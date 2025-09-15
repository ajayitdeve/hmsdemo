<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['purchase_order_id', 'item_id', 'quantity', 'unitrate', 'unitsalerate', 'bonus', 'discount_percent'];
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }

    public function purchaseorder()
    {
        return $this->belongsTo(\App\Models\PurchaseOrder::class);
    }
}
