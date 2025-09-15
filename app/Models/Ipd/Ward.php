<?php

namespace App\Models\Ipd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ward extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function wardTariff()
    {
        return $this->belongsTo(WardTariff::class);
    }
    public function wardGroup()
    {
        return $this->belongsTo(WardGroup::class);
    }
    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedById()
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'ward_id', 'id');
    }
}
