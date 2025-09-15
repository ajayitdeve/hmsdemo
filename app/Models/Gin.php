<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gin extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['stock_point_id', 'stock_point_from_id', 'mrq_id', 'code', 'status', 'remarks', 'created_by_id', 'approved_by_id'];

    public function ginitems()
    {
        return $this->hasMany(\App\Models\GinItem::class);
    }
    public function mrq()
    {
        return $this->belongsTo(\App\Models\Mrq::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-M-Y h:i:s', strtotime($value));
    }

    public function createdby()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by_id');
    }
    public function stockpointfrom()
    {
        return $this->belongsTo(\App\Models\StockPoint::class, 'stock_point_from_id');
    }

    public function stockpoint()
    {
        return $this->belongsTo(\App\Models\StockPoint::class, 'stock_point_id');
    }
    public function approvedby()
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by_id');
    }
}
