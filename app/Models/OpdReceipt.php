<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpdReceipt extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['opd_billing_id', 'patient_id', 'patient_visit_id'];
}
