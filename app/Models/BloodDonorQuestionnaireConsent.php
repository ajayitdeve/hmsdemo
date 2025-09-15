<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodDonorQuestionnaireConsent extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
