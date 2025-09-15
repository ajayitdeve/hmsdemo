<?php

namespace App\Models\Ipd;

use App\Models\User;
use App\Models\CostCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NurseStation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'name', 'created_by_id', 'updated_by_id', 'cost_center_id'];

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedById()
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }
}
