<?php

namespace App\Http\Livewire\Ipd\IpdFinalBill;

use App\Models\IpFinalBilling;
use Livewire\Component;

class IpdFinalBillList extends Component
{
    public $ip_final_bills = [];

    public function mount()
    {
        $this->ip_final_bills = IpFinalBilling::latest()->get();
    }

    public function render()
    {
        return view('livewire.ipd.ipd-final-bill.ipd-final-bill-list')->extends('layouts.admin')->section('content');
    }
}
