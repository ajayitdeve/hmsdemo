<?php

namespace App\Models\Ipd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ward_id', 'nurse_station_id', 'cost_center_id', 'name', 'code', 'beds', 'status', 'display_name', 'block', 'wing', 'created_by_id', 'updated_by_id'];

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }

    public function beds()
    {
        return $this->hasMany(Bed::class, 'room_id', 'id');
    }

    public function room_beds()
    {
        return $this->hasMany(Bed::class, 'room_id', 'id');
    }

    public function nurseStation()
    {
        return $this->belongsTo(NurseStation::class, 'nurse_station_id', 'id');
    }
    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedById()
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }
}
