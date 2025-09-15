<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockPoint extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['name', 'code', 'type_id', 'cost_center_id', 'stock_point_to'];
    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class, 'type_id');
    }
    public function costcenter()
    {
        return $this->belongsTo(\App\Models\CostCenter::class, 'cost_center_id');
    }

    public function purchaseindents()
    {
        return $this->hasMany(\App\Models\PurchaseIndent::class);
    }
}
