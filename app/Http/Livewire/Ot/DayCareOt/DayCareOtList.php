<?php

namespace App\Http\Livewire\Ot\DayCareOt;

use App\Models\OtDayCare;
use Livewire\Component;

class DayCareOtList extends Component
{
    public $day_care_ots = [];

    public function mount()
    {
        $this->day_care_ots = OtDayCare::latest()->get();
    }

    public function render()
    {
        return view('livewire.ot.day-care-ot.day-care-ot-list')->extends('layouts.admin')->section('content');
    }
}
