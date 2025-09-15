<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BinGroup extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['stock_point_id','name'];

    public function stockpoint(){
        return $this->belongsTo(StockPoint::class,'stock_point_id');
    }
}
