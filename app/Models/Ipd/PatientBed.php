<?php

namespace App\Models\Ipd;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientBed extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class, "bed_id", "id");
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class);
    }
}
