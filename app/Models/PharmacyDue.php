<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PharmacyDue extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['stock_point_id', 'patient_id', 'patient_visit_id', 'opd_medicine_receipt_id','total_amount','paid_amount', 'due_amount', 'is_due_cleared', 'due_clrarance_date', 'approved_by_id'] ;
    public function opdmedicinereceipt(){
        return $this->belongsTo(OpdMedicineReceipt::class,'opd_medicine_receipt_id');
    }
}
