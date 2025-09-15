<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransfusionReactionReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function transfusion_reaction()
    {
        return $this->belongsTo(TransfusionReaction::class);
    }

    public function by_approved()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
