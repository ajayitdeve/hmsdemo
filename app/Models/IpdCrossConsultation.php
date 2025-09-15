<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpdCrossConsultation extends Model
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }
}
