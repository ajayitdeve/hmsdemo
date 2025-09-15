<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function role_stock_point()
    {
        return $this->hasOne(RoleStockPoint::class, "role_id", "id");
    }
}
