<?php

namespace App\Http\Livewire\Nurse\ChooseNurseStation;

use Livewire\Component;

class ChooseNurseStation extends Component
{
    public function mount() {}

    public function render()
    {
        return view('livewire.nurse.choose-nurse-station.choose-nurse-station')->extends('layouts.admin')->section('content');
    }
}
