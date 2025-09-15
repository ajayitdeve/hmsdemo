<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function referral()
    {
        return $this->morphOne(Referral::class, 'referrable');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function consultationtype()
    {
        return $this->belongsTo(ConsultationType::class, 'consultation_type_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
