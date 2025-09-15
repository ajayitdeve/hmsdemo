<?php

namespace App\Http\Livewire\Nurse\DrugManagement;

use App\Models\IpPharmacyIndent;
use App\Models\User;
use App\Traits\NurseDepartment;
use Livewire\Component;

class DrugIndentList extends Component
{
    use NurseDepartment;

    public $ipd;
    protected $queryString = ['ipd'];

    public $drug_indents = [], $indent_id, $reason, $approved_by, $show_cancel_button, $users = [];

    public function mount()
    {
        $this->checkNurseStationSession();

        $this->drug_indents = IpPharmacyIndent::where('nurse_station_id', session('nurse_station_id'))
            ->when($this->ipd, function ($query) {
                $query->whereHas('ipd', function ($subQuery) {
                    $subQuery->where('ipdcode', $this->ipd);
                });
            })
            ->latest()
            ->get();

        $this->users = User::all();
    }

    public function view_cancel_indent($indent_id, $show_cancel_button = false)
    {
        $this->reset(['indent_id', 'reason', 'approved_by', 'show_cancel_button']);

        $this->indent_id = $indent_id;
        $indent = IpPharmacyIndent::find($this->indent_id);
        if ($indent) {
            $this->reason = $indent->cancelled_reason;
            $this->approved_by = $indent->cancelled_by_id;

            if ($show_cancel_button) {
                $this->show_cancel_button = true;
            }

            $this->dispatchBrowserEvent('show-cancel-modal');
        }
    }

    public function cancel_indent()
    {
        $this->validate([
            'reason' => 'required',
            'approved_by' => 'required',
        ]);

        $indent = IpPharmacyIndent::find($this->indent_id);
        if ($indent) {
            $indent->is_cancelled = 1;
            $indent->cancelled_reason = $this->reason;
            $indent->cancelled_by_id = $this->approved_by;
            $indent->save();

            $this->reset(['indent_id', 'reason', 'approved_by']);
            $this->mount();
            $this->dispatchBrowserEvent('hide-cancel-modal');
        }
    }

    public function render()
    {
        return view('livewire.nurse.drug-management.drug-indent-list')->extends('layouts.admin')->section('content');
    }
}
