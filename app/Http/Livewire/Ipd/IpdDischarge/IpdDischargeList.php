<?php

namespace App\Http\Livewire\Ipd\IpdDischarge;

use App\Models\IpDischarge;
use Livewire\Component;

class IpdDischargeList extends Component
{
    public $ip_discharges = [];

    public function mount()
    {
        $this->ip_discharges = IpDischarge::latest()->get();
    }

    public function render()
    {
        return view('livewire.ipd.ipd-discharge.ipd-discharge-list')->extends('layouts.admin')->section('content');
    }
}
