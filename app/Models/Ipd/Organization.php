<?php

namespace App\Models\Ipd;

use App\Models\CostCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['cost_center_id', 'code', 'name', 'pan', 'tan', 'color', 'type', 'isactive', 'isletterreqcoloruired', 'effectedfrom', 'effectedto', 'clearancedays', 'contractdate', 'consultation_number', 'consultation_days', 'consultation_discount', 'ip_org_percent', 'ip_emp_percent', 'op_org_percent', 'op_emp_percent', 'remarks', 'org_credit_limit', 'contact_person_id', 'created_by_id', 'updated_by_id'];

    public  function cost_center()
    {
        return $this->belongsTo(CostCenter::class);
    }
}
