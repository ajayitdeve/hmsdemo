<?php

namespace App\Http\Livewire\Patient;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Village;
use Livewire\Component;
use App\Models\Relation;

class EditPatient extends Component
{

    public $patient, $patient_id;
    public $name,$email,$mobile,$age,$address,$father_name,$dob,$pincode,$relation_id;
    public $ageError = '',$rawage,$villages = [], $village_text,$village_id,$relations=[];
    public function mount($id){
        $this->relations=Relation::get();
        $this->patient_id = $id;
        $this->patient = Patient::find($id);
        $this->name= $this->patient->name;
        $this->email= $this->patient->email;
        $this->mobile= $this->patient->mobile;
        $this->age= $this->patient->age;
        $this->address= $this->patient->address;
        $this->father_name= $this->patient->father_name;
        $this->dob= $this->patient->dob;
        $this->pincode= $this->patient->pincode;
        $this->relation_id=$this->patient->relation_id;


    }

    public function rules()
    {
        return [
            'name' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'address' => 'required',
            'father_name' => 'required',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function render()
    {
        return view('livewire.patient.edit-patient')->extends('layouts.admin')->section('content');;
    }

    public function update(){
        $this->patient->name=$this->name;
        $this->patient->email=$this->email;
        $this->patient->mobile=$this->mobile;
        $this->patient->age=$this->age;
        $this->address=$this->patient->address;
        $this->father_name=$this->patient->father_name;
        $this->dob=$this->patient->dob;
        $this->pincode=$this->patient->pincode;
        $this->patient->relation_id=$this->relation_id;
        $this->patient->save();
       // dd($this->patient);
       return redirect()->route('admin.patient.list')->with('message','Patient Details Updated Successful');
    }
    public function calculateAge()
    {

        $date = Carbon::parse($this->dob);
        $testdate = $date->diffInYears(Carbon::now());
        //dd($testdate);
        if ($testdate <= 100) {
            $parsedDOB = Carbon::parse($this->dob);
            $this->age = Carbon::parse($parsedDOB)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->rawage = Carbon::parse($parsedDOB)->age;
            $this->ageError = "";
        } else {
            $parsedDOB = Carbon::parse($this->dob);
            $this->age = 'Invalid';
            $this->ageError = "Age Must be less than 100";
        }
    }
    public function changeRwaAge()
    {
        if ((int) ($this->rawage) >= 99) {
            $this->ageError = "Age Must be less than 100";
            $this->age = 'Invalid';
        } else {
            $this->ageError = "";
        }
        $currentDate = Carbon::now();
        $newDate = Carbon::now()->subYears((int) $this->rawage);
        $this->age = Carbon::parse($newDate)->diff(Carbon::now())->format('%y years, %m months and %d days');
        $this->dob = $newDate->format('Y-m-d');
    }



    public function villageChanged()
    {
        if ($this->village_text == null) {
            $this->villages = [];
            $this->village_id = null;
        } else {
            $this->villages = Village::orWhere('name', 'like', '%' . $this->village_text . '%')->get();
        }

    }

    public function villageSelectionChanged()
    {
        if ($this->village_id != -1) {
            $this->village_text = null;
            //setting complaete address
            $village = Village::find($this->village_id);
            $this->address = $village->name . ', Block-' . $village->block->name . ', District-' . $village->district->name . ' ,' . $village->state->name;
        } else {
            $this->address = null;
        }

    }
}
