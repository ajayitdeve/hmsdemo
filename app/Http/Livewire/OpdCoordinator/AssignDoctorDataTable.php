<?php

namespace App\Http\Livewire\OpdCoordinator;

use Livewire\Component;
use Livewire\WithPagination;
class AssignDoctorDataTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage=20;
    public $search='';
    public $sortDirection='DESC';
    public $sortColumn= 'name';
    //for date filter
    public $from=null,$to=null,$isDateSerch=false,$isNormalSearch=false;


    public $patient_visit_id,$patientVisit,$units=[],$departments=[],$doctors=[];
    public $visit_no, $visit_type, $visit_date, $visit_status, $description, $patient_id, $doctor_id,$department_id, $unit_id;
    public function mount(){
        $this->patientVisit=null;
        $this->departments=\App\Models\Department::get();
        $this->units=\App\Models\Unit::get();
        $this->doctors=\App\Models\Doctor::get();
    }
    public function departmentChanged(){
        if($this->department_id!=null){
            $this->units=\App\Models\Unit::where('department_id',$this->department_id)->get();
        }
    }
    public function unitChanged(){
        if($this->unit_id!=null){
            $this->doctors=\App\Models\Doctor::where('unit_id',$this->unit_id)->get();
           // dd($this->doctors);
        }
    }
    public function assignDoctor($patient_visit_id){

        $patientVisit=\App\Models\PatientVisit::find($patient_visit_id);
        $this->patient_visit_id=$patient_visit_id;

        if($patientVisit){
            $this->patientVisit=$patientVisit;
            $this->visit_no=$patientVisit->visit_no;
             $this->visit_type=$patientVisit;
             $this->visit_date=$patientVisit->visit_date;
             $this->visit_status=$patientVisit->visit_status;
             $this->description=$patientVisit->description;
             $this->patient_id=$patientVisit->patient_id;
             $this->department_id=$patientVisit->department_id;
             $this->doctor_id=$patientVisit->doctor_id;
             $this->unit_id=$patientVisit->unit_id;

        }


    }

    public function save(){
        \App\Models\PatientVisit::where('id',$this->patient_visit_id)->update([  'department_id'=>$this->department_id,'doctor_id'=>$this->doctor_id,'unit_id'=>$this->unit_id]);
        session()->flash('message', 'Doctor Assigned  Successfully.');
        $this->reset('visit_no', 'visit_type', 'visit_date', 'visit_status', 'description', 'patient_id', 'doctor_id','department_id', 'unit_id');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function doSort($column){
        if($this->sortColumn=$column){
            $this->sortDirection=($this->sortDirection=='ASC')?'DESC': 'ASC';
            return ;
        }
        $this->sortColumn=$column;
        $this->sortDirection='ASC';

    }
    //life cycle hooks
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchByDate(){
        $this->search=null;
        $this->isDateSerch=true;
    }
    public function clearFilter(){
        $this->to=null;$this->from=null;$this->search=null;
        $this->isDateSerch=false;
    }

    public function searchTextChanged(){
        $this->isNormalSearch=true;
    }
        public function render()
    {
    if($this->isDateSerch==false && $this->isNormalSearch==false){
        return view('livewire.opd-coordinator.assign-doctor-data-table',[
            'patientVisits'=>\App\Models\PatientVisit::Search($this->search)
            ->orderBy($this->sortColumn,$this->sortDirection)
            ->paginate($this->perPage)
        ])->extends('layouts.admin')->section('content');
    }else{
        if($this->isDateSerch==true){
            return view('livewire.opd-coordinator.assign-doctor-data-table',[
                'patientVisits'=>\App\Models\PatientVisit::Filter($this->from,$this->to)
                ->orderBy($this->sortColumn,$this->sortDirection)
                ->paginate($this->perPage)
            ])->extends('layouts.admin')->section('content');

        }else{
            return view('livewire.opd-coordinator.assign-doctor-data-table',[
                'patientVisits'=>\App\Models\PatientVisit::Search($this->search)
                ->orderBy($this->sortColumn,$this->sortDirection)
                ->paginate($this->perPage)
            ])->extends('layouts.admin')->section('content');
        }
    }


    }

}


