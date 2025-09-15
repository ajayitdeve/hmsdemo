<?php

namespace App\Http\Livewire\Ipd;

use Livewire\Component;

class OrganizationPharmacyDiscountMaster extends Component
{
    public function render()
    {
        return view('livewire.ipd.organization-pharmacy-discount-master')->extends('layouts.admin')->section('content');
    }
}
