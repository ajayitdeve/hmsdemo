<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function purchaseindents()
    {
        return $this->hasMany(\App\Models\PurchaseIndent::class);
    }

    public function inventories()
    {
        return $this->hasMany(\App\Models\Inventory::class);
    }

    public function rates()
    {
        return $this->hasMany(\App\Models\Rate::class);
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class);
    }
    public function itemgroup()
    {
        return $this->belongsTo(\App\Models\ItemGroup::class, 'item_group_id');
    }
    public function generic()
    {
        return $this->belongsTo(\App\Models\Generic::class);
    }

    public function form()
    {
        return $this->belongsTo(\App\Models\Form::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    public function itemspecialization()
    {
        return $this->belongsTo(\App\Models\ItemSpecialization::class, 'item_specialization_id');
    }
    public function manufacturer()
    {
        return $this->belongsTo(\App\Models\Manufacturer::class);
    }

    public function purchaseuom()
    {
        return $this->belongsTo(\App\Models\Uom::class, 'purchase_uom_id');
    }

    public function issueuom()
    {
        return $this->belongsTo(\App\Models\Uom::class, 'issue_uom_id');
    }

    public function salestores()
    {
        return $this->hasMany(\App\Models\SaleStore::class);
    }
}
