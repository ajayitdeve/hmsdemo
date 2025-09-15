<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SaleStore extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['gin_item_id','stock_point_from_id','stock_point_id', 'gin_id', 'bin_id','item_id', 'batch_no', 'mfd', 'exd', 'quantity','received'];
    public function gin(){
        return $this->belongsTo(\App\Models\Gin::class);
    }
    public function item(){
        return $this->belongsTo(\App\Models\Item::class);
    }

    public function stockpoint(){
        return $this->belongsTo(\App\Models\StockPoint::class,'stock_point_id');
    }
    //accessors
    public function getExdAttribute($value){
        return date('d-M-Y', strtotime($value));
    }
    public function getMfdAttribute($value){
        return date('d-M-Y', strtotime($value));
    }
    public function getCreatedAtAttribute($value){
        return date('d-M-Y h:i:s', strtotime($value));
    }
}
