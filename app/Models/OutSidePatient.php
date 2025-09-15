<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutSidePatient extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [ 'registration_no', 'name','out_side_patient_id', 'mobile', 'age', 'address', 'title_id', 'gender_id', 'created_by_id'];

    public function title(){
        return $this->belongsTo(Title::class);
    }
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
}
