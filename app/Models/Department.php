<?php

namespace App\Models;

use App\Models\Service\ServiceGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code', 'is_medical', 'is_nmch', 'is_consultation'];
    // public function getIsMedicalAttribute($value)
    // {
    //     return $value?'Medical':'Non Medical';
    // }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function department_fee()
    {
        return $this->hasMany(DepartmentConsultationFee::class);
    }

    public function serviceGroups()
    {
        return $this->hasMany(ServiceGroup::class);
    }
}
