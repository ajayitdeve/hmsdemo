<?php

namespace App\Models;

use App\Models\Ipd\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCorporateFee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
