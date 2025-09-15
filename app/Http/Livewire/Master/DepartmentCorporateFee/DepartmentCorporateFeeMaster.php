<?php

namespace App\Http\Livewire\Master\DepartmentCorporateFee;

use App\Models\Department;
use App\Models\DepartmentCorporateFee;
use App\Models\Ipd\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DepartmentCorporateFeeMaster extends Component
{
    public  $department_corporate_fee_id;
    public $department_id, $organization_id, $fee;
    public $departments = [];
    public $organizations = [];

    public function mount()
    {
        $this->departments = Department::where('is_consultation', 1)->get();
        $this->organizations = Organization::where('isactive', 1)->get();
    }

    function rules()
    {
        return [
            'department_id' => ['required', Rule::unique('department_corporate_fees')->where(fn($query) => $query->where('organization_id', $this->organization_id))->ignore($this->department_corporate_fee_id)],
            'organization_id' => 'required',
            'fee' => 'required|numeric|min:0',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        DepartmentCorporateFee::create([
            'department_id' => $this->department_id,
            'organization_id' => $this->organization_id,
            'fee' => $this->fee,
            'created_by_id' => Auth::user()?->id,
        ]);

        session()->flash('success', 'Department corporate fee added successfully.');
        $this->reset(['department_corporate_fee_id', 'department_id', 'organization_id', 'fee']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $department_corporate_fee_id)
    {
        $department_corporate_fee = DepartmentCorporateFee::find($department_corporate_fee_id);
        if ($department_corporate_fee) {
            $this->department_corporate_fee_id = $department_corporate_fee->id;
            $this->department_id = $department_corporate_fee->department_id;
            $this->organization_id = $department_corporate_fee->organization_id;
            $this->fee = $department_corporate_fee->fee;
        } else {
        }
    }

    public function update()
    {
        $this->validate();

        DepartmentCorporateFee::find($this->department_corporate_fee_id)->update([
            'department_id' => $this->department_id,
            'organization_id' => $this->organization_id,
            'fee' => $this->fee,
            'created_by_id' => Auth::user()?->id,
        ]);

        session()->flash('success', 'Department corporate fee updated successfully.');
        $this->reset(['department_corporate_fee_id', 'department_id', 'organization_id', 'fee']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $department_corporate_fee_id)
    {
        $this->department_corporate_fee_id = $department_corporate_fee_id;
    }

    public function destroy()
    {
        DepartmentCorporateFee::find($this->department_corporate_fee_id)->delete();
        session()->flash('success', 'Department corporate fee deleted successfully.');

        $this->reset(['department_corporate_fee_id', 'department_id', 'organization_id', 'fee']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset(['department_corporate_fee_id', 'department_id', 'organization_id', 'fee']);
    }


    public function render()
    {
        $department_corporate_fees = DepartmentCorporateFee::with(['department', 'organization'])
            ->whereHas('department')
            ->whereHas('organization')
            ->get();

        return view('livewire.master.department-corporate-fee.department-corporate-fee-master', compact('department_corporate_fees'))->extends('layouts.admin')->section('content');
    }
}
