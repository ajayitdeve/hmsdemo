<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentConsultationFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['department_id', 'fee', 'doc', 'is_active', 'created_by_id', 'updated_by_id', 'approved_by_id', 'remarks'];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedById()
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }
    public function approvedById()
    {
        return $this->belongsTo(User::class, 'approved_by_id', 'id');
    }
}
