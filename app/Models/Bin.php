<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bin extends Model
{
    use HasFactory,SoftDeletes;
protected $fillable=['bin_group_id', 'stock_point_id', 'name'];
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function stockpoint(){
        return $this->belongsTo(StockPoint::class,'stock_point_id');
    }
    public function bingroup(){
        return $this->belongsTo(BinGroup::class,'bin_group_id');
    }
}
