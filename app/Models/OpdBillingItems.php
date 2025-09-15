<?php

namespace App\Models;

use App\Models\Pathology\SampleCollection;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpdBillingItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function opdBilling()
    {
        return $this->belongsTo(OpdBilling::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
