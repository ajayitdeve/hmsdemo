<?php

namespace App\Http\Livewire\Master\ChangeDepartmentConsultationFee;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\DepartmentConsultationFee;

class ChangeDepartmentConsultationFeeMaster extends Component
{
    public $departmentConsultationFees = [];
    public $department_id, $fee;
    public $department_consultation_fee_id, $departments = [];
    public $newFee = null, $doc = null, $approved_by_id, $remarks, $user = [], $users = [];

    public function mount()
    {
        $this->departments = Department::get();
        $this->users = User::get();
    }

    function rules()
    {
        return [
            'department_id' => 'required',
            'newFee' => 'required',
            'doc' => 'required',
            'approved_by_id' => 'required',
            'remarks' => 'required'
        ];
    }

    protected $messages = [
        'department_id.unique' => 'Consultion Charge for this department Alredy exits.',
        'newFee.required' => 'Department Consultaion Fee Required.',
        'approved_by_id.required' => 'Approval Required',
        'doc.required' => 'Date of Change is Required',
        'remarks.required' => 'Remarks Required'
    ];

    public function save()
    {
        $validatedData = $this->validate();
        //first set all existing department fee ; 'is_active=0'
        foreach ($this->departmentConsultationFees as $departmentConsultationFee) {
            $departmentConsultationFee->update([
                'is_active' => 0,
                'updated_at' => \Carbon\Carbon::now(),
                'updated_by_id' => Auth::user()?->id,
                'approved_by_id' => $this->approved_by_id
            ]);
        }

        //Now Add New Department Consultation Fee : 'is_active=0'
        //'department_id','fee','doc','is_active','created_by_id','updated_by_id','approved_by_id','remarks'
        $departmentConsultationFee = [
            'department_id' => $this->department_id,
            'fee' => $this->newFee,
            'doc' => $this->doc,
            'is_active' => 1,
            'remarks' => $this->remarks,
            'created_by_id' => Auth::user()?->id,
            'updated_by_id' => Auth::user()?->id,
            'approved_by_id' => $this->approved_by_id,
        ];
        $result = DepartmentConsultationFee::create($departmentConsultationFee);
        if ($result) {
            return redirect()->route('admin.change-department-consultation-fee')->with('message', 'Department Consultation fee Added Successfully.');
        } else {
            session()->flash('message', 'Something went wront ! Try Again');
        }
    }

    public function departmentChanged()
    {
        // dd($this->department_id);
        $this->departmentConsultationFees = DepartmentConsultationFee::where('department_id', $this->department_id)->get();
        // dd($this->departmentConsultationFees);
    }


    public function render()
    {
        // $departmentConsultationFees = DepartmentConsultationFee::all();
        return view('livewire.master.change-department-consultation-fee.change-department-consultation-fee-master')->extends('layouts.admin')->section('content');
    }
}
