<?php

namespace App\Http\Livewire\BloodBank\TransfusionReaction;

use App\Models\TransfusionReaction;
use Livewire\Component;

class TransfusionReactionList extends Component
{
    public $transfusion_reaction_list;

    public function mount()
    {
        $this->transfusion_reaction_list = TransfusionReaction::latest()->get();
    }
    public function render()
    {
        return view('livewire.blood-bank.transfusion-reaction.transfusion-reaction-list')->extends('layouts.admin')->section('content');
    }
}
