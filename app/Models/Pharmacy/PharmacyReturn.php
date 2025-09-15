<?php

namespace App\Models\Pharmacy;

use App\Models\User;
use App\Models\Patient;
use App\Models\StockPoint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharmacyReturn extends Model
{
    use HasFactory;
    protected $fillable = ['opd_medicine_receipt_id','stock_point_id','patient_id','code','return_date','patient_type','cause',
    'remarks','created_by_id','approved_by_id'];


    public function pharmacyReturnItems(){
        return $this->hasMany(PharmacyReturnItem::class,'');
    }
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function stockPoint(){
        return $this->belongsTo(StockPoint::class,'stock_point_id','id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by_id','id');
    }
    public function approvedBy(){
        return $this->belongsTo(User::class,'approved_by_id','id');
    }
}
