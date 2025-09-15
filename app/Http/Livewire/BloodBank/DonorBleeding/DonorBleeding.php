<?php

namespace App\Http\Livewire\BloodBank\DonorBleeding;

use App\Models\BloodDonorBleeding;
use Livewire\Component;

class DonorBleeding extends Component
{
    public $donor_bleedings;

    public function mount()
    {
        $this->donor_bleedings = BloodDonorBleeding::latest()->get();
    }
    public function render()
    {
        return view('livewire.blood-bank.donor-bleeding.donor-bleeding')->extends('layouts.admin')->section('content');
    }
}
