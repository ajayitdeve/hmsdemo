<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "roles" => "array",
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user_group()
    {
        return $this->belongsTo(UserGroup::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function stock_point()
    {
        return $this->hasOne(TeamStockPoint::class, "team_id", "id");
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
