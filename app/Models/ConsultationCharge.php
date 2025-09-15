<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsultationCharge extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['patient_id', 'patient_visit_id', 'amount','received_by_id','foc','foc_by_id'];
    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function patientvisit(){
        return $this->belongsTo(PatientVisit::class,'patient_visit_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'received_by_id');
    }

}
