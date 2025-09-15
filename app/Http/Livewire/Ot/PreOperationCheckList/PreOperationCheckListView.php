<?php

namespace App\Http\Livewire\Ot\PreOperationCheckList;

use App\Models\OtPreOperationCheckList;
use Livewire\Component;

class PreOperationCheckListView extends Component
{
    public $pre_operation_checklists = [];

    public function mount()
    {
        $this->pre_operation_checklists = OtPreOperationCheckList::latest()->get();
    }

    public function render()
    {
        return view('livewire.ot.pre-operation-check-list.pre-operation-check-list-view')->extends('layouts.admin')->section('content');
    }
}
