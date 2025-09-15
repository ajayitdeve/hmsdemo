<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamStockPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "stock_points" => "array",
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
