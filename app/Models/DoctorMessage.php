<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\NurseStation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function nurse_station()
    {
        return $this->belongsTo(NurseStation::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
