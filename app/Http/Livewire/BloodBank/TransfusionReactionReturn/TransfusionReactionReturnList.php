<?php

namespace App\Http\Livewire\BloodBank\TransfusionReactionReturn;

use App\Models\TransfusionReaction;
use App\Models\TransfusionReactionReturn;
use App\Models\User;
use Livewire\Component;

class TransfusionReactionReturnList extends Component
{
    public $transfusion_reaction_return_id, $transfusion_reaction_id, $reason, $approved_by;
    public $transfusion_reaction_returns = [];
    public $transfusion_reactions = [];
    public $users = [];

    public function mount()
    {
        $this->transfusion_reaction_returns = TransfusionReactionReturn::latest()->get();
        $this->transfusion_reactions = TransfusionReaction::latest()->get();
        $this->users = User::latest()->get();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function rules()
    {
        return [
            "transfusion_reaction_id" => "required|unique:transfusion_reaction_returns,transfusion_reaction_id",
            "approved_by" => "required",
        ];
    }

    public function save()
    {
        $this->validate();

        $transfusion_reaction = TransfusionReaction::find($this->transfusion_reaction_id);
        if ($transfusion_reaction) {
            TransfusionReactionReturn::create([
                "transfusion_reaction_id" => $this->transfusion_reaction_id,
                "reason" => $this->reason,
                "approved_by" => $this->approved_by,
                "created_by_id" => auth()->user()?->id,
            ]);

            $transfusion_reaction->status = 1;
            $transfusion_reaction->save();

            session()->flash('message', 'Transfusion Reaction Return Added Successfully.');
            $this->reset(['transfusion_reaction_id', 'reason', 'approved_by']);
            $this->mount();
        }
    }

    public function render()
    {
        return view('livewire.blood-bank.transfusion-reaction-return.transfusion-reaction-return-list')->extends('layouts.admin')->section('content');
    }
}
