<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DoctorUnit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['unit_id','doctor_id','doctor_department_id','created_by_id'];
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function doctor_department(){
        return $this->belongsTo(DoctorDepartment::class);
    }
}
