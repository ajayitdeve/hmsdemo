<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Rate extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['item_id', 'batch_no', 'current_purchase_rate', 'current_sale_rate', 'new_purchase_rate', 'new_sale_rate', 'doc', 'status', 'approved_by_id', 'remarks'];
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
