<?php

namespace App\Models;

use App\Models\OpdMedicineTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpdMedicineReceipt extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];


    public function opdmedicinetransactions(){
        return $this->hasMany(OpdMedicineTransaction::class,'opd_medicine_receipt_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function patientvisit(){
        return $this->belongsTo(PatientVisit::class,'patient_visit_id');
    }

    public function stockpoint(){
        return $this->belongsTo(StockPoint::class,'stock_point_id');
    }

    public function pharmacydue(){
        return $this->hasOne(PharmacyDue::class,'opd_medicine_receipt_id','id');
    }

    public function outSidePatient(){
        return $this->belongsTo(OutSidePatient::class,'out_side_patient_id','id');
    }

    public function cancleBy(){
        return $this->belongsTo(User::class,'cancle_by_id','id');
    }
}