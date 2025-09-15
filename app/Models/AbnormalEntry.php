<?php

namespace App\Models;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\NurseStation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbnormalEntry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function abnormalEntryItems()
    {
        return $this->hasMany(AbnormalEntryItem::class, 'abnormal_entry_id');
    }
    public function ipd()
    {
        return $this->belongsTo(Ipd::class, 'ipd_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function nurseStation()
    {
        return $this->belongsTo(NurseStation::class, 'nurse_station_id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
