<?php

namespace App\Http\Livewire\Master\DepartmentConsultationFee;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\DepartmentConsultationFee;
use Carbon\Carbon;

class DepartmentConsultationFeeMaster extends Component
{
    public  $department_id, $fee;
    public $department_consultation_fee_id, $departments = [];

    public function mount()
    {
        $this->departments = Department::where('is_consultation', 1)->get();
    }

    function rules()
    {
        return [
            'department_id' => 'required|unique:department_consultation_fees',
            'fee' => 'required'
        ];
    }

    protected $messages = [
        'department_id.unique' => 'Consultion Charge for this department Alredy exits.',
        'fee.required' => 'Department Consultaion Fee Required.',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $departmentConsultationFee = [
            'department_id' => $this->department_id,
            'fee' => $this->fee,
            'created_by_id' => Auth::user()?->id,
            'approved_by_id' => Auth::user()?->id,
            'created_at' => Carbon::now(),
        ];
        $result = DepartmentConsultationFee::insert($departmentConsultationFee);
        if ($result) {
            session()->flash('success', 'Department Consultation fee Added Successfully.');
            $this->reset();
            $this->mount();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('error', 'Something went wront ! Try Again');
            $this->reset();
            $this->mount();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function edit(int $department_consultation_fee_id)
    {
        $departmentConsultationFee = DepartmentConsultationFee::find($department_consultation_fee_id);
        if ($departmentConsultationFee) {
            $this->department_consultation_fee_id = $department_consultation_fee_id;
            $this->department_id = $departmentConsultationFee->department_id;
            $this->fee = $departmentConsultationFee->fee;
        } else {
        }
    }

    public function update()
    {
        // $this->validate();
        DepartmentConsultationFee::where('id', $this->department_consultation_fee_id)->update(
            [
                'department_id' => $this->department_id,
                'fee' => $this->fee,
                'created_by_id' => Auth::user()?->id,
                'approved_by_id' => Auth::user()?->id,
                'updated_at' => Carbon::now(),
            ]
        );
        session()->flash('success', 'Department Consultation Fee Edited Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $department_consultation_fee_id)
    {
        $this->department_consultation_fee_id = $department_consultation_fee_id;
    }

    public function destroy()
    {
        DepartmentConsultationFee::find($this->department_consultation_fee_id)->delete();
        session()->flash('success', 'Department Consultation fee  deleted Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function closeModal()
    {
        $this->reset();
        $this->mount();
    }

    public function render()
    {
        $departmentConsultationFees = DepartmentConsultationFee::all();
        return view('livewire.master.department-consultation-fee.department-consultation-fee-master', ['departmentConsultationFees' => $departmentConsultationFees])->extends('layouts.admin')->section('content');
    }
}
