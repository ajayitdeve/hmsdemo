<?php

namespace App\Models\Service;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['department_id', 'code', 'name'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
