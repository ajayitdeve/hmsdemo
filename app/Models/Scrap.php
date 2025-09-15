<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    use HasFactory;
    protected $fillable = ['stock_point_from_id','stock_point_to_id','code','remarks','scrap_transfer_date','status','created_by_id','updated_by_id','approved_by_id'] ;
     public function stockPointFrom(){
        return $this->belongsTo(StockPoint::class,'stock_point_from_id','id');
     }
     public function stockPointTo(){
        return $this->belongsTo(StockPoint::class,'stock_point_to_id','id');
     }
}
