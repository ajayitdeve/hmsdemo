<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['grn_id', 'item_id', 'batch_no', 'mfd', 'exd', 'quantity', 'purchase_rate', 'bonus', 'mrp', 'discount', 'tax', 'hsncode'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function grn()
    {
        return $this->belongsTo(Grn::class);
    }

    //accessors
    public function getExdAttribute($value)
    {
        return date('d-M-Y', strtotime($value));
    }
    public function getMfdAttribute($value)
    {
        return date('d-M-Y', strtotime($value));
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d-M-Y h:i:s', strtotime($value));
    }
}
