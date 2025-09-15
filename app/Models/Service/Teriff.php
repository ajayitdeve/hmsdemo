<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teriff extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'name', 'contact_person', 'from', 'to', 'isneverexpired'];
}
