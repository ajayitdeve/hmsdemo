<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'department_id', 'created_by_id'];

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }

    public function doctors()
    {
        return $this->hasMany(\App\Models\Doctor::class);
    }
}
