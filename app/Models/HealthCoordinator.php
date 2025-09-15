<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthCoordinator extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'name', 'father_name', 'email', 'address', 'password', 'remember_token', 'mobile', 'dob', 'Address', 'is_active'];
}
