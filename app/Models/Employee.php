<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(EmployeeCategory::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function marital()
    {
        return $this->belongsTo(Marital::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function cost_center()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function bloodgroup()
    {
        return $this->belongsTo(Bloodgroup::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, "created_by_id");
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, "updated_by_id");
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
