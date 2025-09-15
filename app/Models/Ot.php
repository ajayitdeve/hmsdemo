<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ot extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ot_type()
    {
        return $this->belongsTo(OtType::class);
    }

    public function cost_center()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
