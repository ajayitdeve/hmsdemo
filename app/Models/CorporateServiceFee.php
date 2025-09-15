<?php

namespace App\Models;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorporateServiceFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
