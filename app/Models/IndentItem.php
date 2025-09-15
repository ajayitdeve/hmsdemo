<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndentItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['purchase_indent_id', 'item_id', 'quantity'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchaseindent()
    {
        return $this->belongsTo(\App\Models\PurchaseIndent::class, 'purchase_indent_id');
    }
}
