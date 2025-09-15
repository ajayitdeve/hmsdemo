<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mrq extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['stock_point_to_id', 'stock_point_from_id', 'code', 'request_date', 'status', 'remarks', 'created_by_id'];
    public function mrqitems()
    {
        return $this->hasMany(MrqItem::class);
    }

    public function stockpointto()
    {
        return $this->belongsTo(StockPoint::class, 'stock_point_to_id', 'id');
    }
    public function stockpointfrom()
    {
        return $this->belongsTo(StockPoint::class, 'stock_point_from_id', 'id');
    }
}
