<?php

namespace App\Models\Ipd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bed extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['ward_id', 'room_id', 'code', 'bed_status', 'display_name', 'is_dummy_room', 'is_oxygen', 'is_suction', 'is_window', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];

    public function patient_bed()
    {
        return $this->hasOne(PatientBed::class, "bed_id", "id");
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedById()
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }
    public function ipds()
    {
        return $this->hasMany(Ipd::class, 'bed_id', 'id');
    }
}
