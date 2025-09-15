<?php

namespace App\Models;

use App\Models\StockPoint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

class RoleStockPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function stockpoint()
    {
        return $this->belongsTo(StockPoint::class, 'stock_point_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
