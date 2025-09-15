<?php

namespace App\Models\Pathology;

use App\Models\OpdBillingItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleCollectionItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['sample_collection_id', 'opd_billing_items_id', 'sample_done'];

    public function opdBillingItem()
    {
        return $this->belongsTo(OpdBillingItems::class, 'opd_billing_items_id', 'id');
    }
}
