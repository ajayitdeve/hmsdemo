<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiceDue extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['patient_id', 'patient_visit_id', 'opd_billing_id', 'total_amount', 'paid_amount', 'due_amount', 'is_due_cleared', 'due_clrarance_date', 'approved_by_id'];
    public function opdBilling()
    {
        return $this->belongsTo(OpdBilling::class);
    }
}
