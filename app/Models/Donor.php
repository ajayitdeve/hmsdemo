<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function ipd()
    {
        return $this->belongsTo(Ipd::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function relation()
    {
        return $this->belongsTo(\App\Models\Relation::class, 'relation_id');
    }
    public function religion()
    {
        return $this->belongsTo(\App\Models\Religion::class, 'religion_id');
    }
    public function gender()
    {
        return $this->belongsTo(\App\Models\Gender::class, 'gender_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function idType()
    {
        return $this->belongsTo(IdType::class, 'id_type_id', 'id');
    }

    public function questionnaire_consent()
    {
        return $this->belongsTo(BloodDonorQuestionnaireConsent::class, "id", "donor_id");
    }

    public function bleeding()
    {
        return $this->belongsTo(BloodDonorBleeding::class, "id", "donor_id");
    }

    public function created_by()
    {
        return  $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
