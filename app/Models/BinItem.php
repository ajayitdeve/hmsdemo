<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BinItem extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['bin_group_id', 'stock_point_id', 'bin_id', 'item_id'];

    public function stockpoint(){
        return $this->belongsTo(StockPoint::class,'stock_point_id');
    }
    public function bingroup(){
        return $this->belongsTo(BinGroup::class,'bin_group_id');
    }
    public function bin(){
        return $this->belongsTo(Bin::class,'bin_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }

}
