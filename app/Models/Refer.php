<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Refer extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['patient_id', 'patient_visit_id', 'department_id_from', 'unit_id_from', 'doctor_id_from', 'department_id_to', 'unit_id_to', 'doctor_id_to', 'refer_at', 'remarks', 'created_by_id'] ;
    public function unit(){
        return $this->belongsTo(\App\Models\Unit::class,'unit_id_from');
    }

    public function doctor(){
        return $this->belongsTo(\App\Models\Doctor::class,'doctor_id_from');
    }

    public function department(){
        return $this->belongsTo(\App\Models\Department::class,'department_id_from');
    }
    public function unitto(){
        return $this->belongsTo(\App\Models\Unit::class,'unit_id_to');
    }

    public function doctorto(){
        return $this->belongsTo(\App\Models\Doctor::class,'doctor_id_to');
    }

    public function departmentto(){
        return $this->belongsTo(\App\Models\Department::class,'department_id_to');
    }
}
