<?php

namespace App\Http\Livewire\Ot\PreOperation;

use App\Models\OtPreOperation;
use Livewire\Component;

class PreOperationList extends Component
{
    public $pre_operations = [];

    public function mount()
    {
        $this->pre_operations = OtPreOperation::latest()->get();
    }

    public function render()
    {
        return view('livewire.ot.pre-operation.pre-operation-list')->extends('layouts.admin')->section('content');
    }
}
