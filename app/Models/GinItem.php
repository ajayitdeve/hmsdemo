<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GinItem extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['stock_point_id','stock_point_from_id','grn_id', 'gin_id', 'item_id', 'batch_no', 'mfd', 'exd', 'quantity'];

    public function gin(){
        return $this->belongsTo(\App\Models\Gin::class);
    }
    public function item(){
        return $this->belongsTo(\App\Models\Item::class);
    }
    public function grn(){
        return $this->belongsTo(\App\Models\Grn::class);
    }

    public function saleStores(){
        return $this->hasMany(SaleStore::class);
    }
}
