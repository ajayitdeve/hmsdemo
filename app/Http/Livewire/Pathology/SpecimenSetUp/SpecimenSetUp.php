<?php

namespace App\Http\Livewire\Pathology\SpecimenSetUp;


use Livewire\Component;
use App\Models\Department;
use App\Models\Pathology\Color;
use App\Models\Service\Service;
use App\Models\Pathology\TestType;
use App\Models\Pathology\Vacutainer;
use App\Models\Service\ServiceGroup;
use App\Models\Pathology\SpecimenMaster;
use \App\Models\Pathology\SpecimenSetup as SpecimenSetupModal;

class SpecimenSetUp extends Component
{

    //`code`, `department_id`, `service_group_id`, `service_id`, `specimen_master_id`, `vacutainer_id`, `test_type_id`, `color_id`, `duration`, `dosage_qty`,
    // `no_of_barcode`, `short_name`, `precaution`, `clinical_history`,`is_applicable_for_others_test`, `is_required_precaution_on_bill`, `is_infection_dieases`,
    // `is_curable`, `s1_cd`, `s2_cd`, `is_active`, `created_by_id`, `updated_by_id`
    public $code, $department_id, $service_group_id, $service_id, $specimen_master_id, $vacutainer_id, $test_type_id, $color_id, $duration, $dosage_qty, $no_of_barcode, $short_name, $precaution, $clinical_history, $is_applicable_for_others_test = false, $is_required_precaution_on_bill = false, $is_infection_dieases = false, $is_curable = false, $s1_cd, $s2_cd, $is_active = true;
    public $specimenSetups = [], $specimen_setup_id;
    public $departments = [], $servicegroups = [], $services = [], $specimenMasters = [], $vacutainers = [], $testtypes = [], $colors = [];

    public function mount()
    {
        $this->specimenSetups = SpecimenSetupModal::orderBy("id", "desc")->get();
        $this->departments = Department::get();
        $this->servicegroups = ServiceGroup::get();
        $this->services = Service::get();
        $this->specimenMasters = SpecimenMaster::get();
        $this->vacutainers = Vacutainer::get();
        $this->testtypes = TestType::get();
        $this->colors = Color::get();
    }

    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }
    public function serviceGroupChanged()
    {
        $this->servicegroups = Service::where('service_group_id', $this->service_group_id)->get();
    }
    public function closeModal()
    {
        $this->resetExcept(['departments', 'servicegroups', 'services', 'specimenMasters', 'vacutainers', 'testtypes', 'colors']);
        $this->specimenSetups = SpecimenSetupModal::orderBy("id", "desc")->get();
    }
    protected $rules = [
        'department_id' => 'required',
        'service_group_id' => 'required',
        'service_id' => 'required',
        'specimen_master_id' => 'required',
        'vacutainer_id' => 'required',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        $validatedData = $this->validate();
        $specimenSetUpMaxId = SpecimenSetupModal::max('id');
        $specimenSetUpCode = 'SAM' . $specimenSetUpMaxId + 1;
        $specimenSetUp = SpecimenSetupModal::create([
            'code' => $specimenSetUpCode,
            'department_id' => $this->department_id,
            'service_group_id' => $this->service_group_id,
            'service_id' => $this->service_id,
            'specimen_master_id' => $this->specimen_master_id,
            'vacutainer_id' => $this->vacutainer_id,
            'test_type_id' => $this->test_type_id,
            'color_id' => $this->color_id,
            'duration' => $this->duration,
            'dosage_qty' => $this->dosage_qty,
            'no_of_barcode' => $this->no_of_barcode,
            'short_name' => $this->short_name,
            'precaution' => $this->precaution,
            'clinical_history' => $this->clinical_history,
            'is_applicable_for_others_test' => $this->is_applicable_for_others_test,
            'is_required_precaution_on_bill' => $this->is_required_precaution_on_bill,
            'is_infection_dieases' => $this->is_infection_dieases,
            'is_curable' => $this->is_curable,
            's1_cd' => $this->s1_cd,
            's2_cd' => $this->s2_cd,
            'is_active' => $this->is_active,

        ]);
        if ($specimenSetUp) {

            session()->flash('message', 'Template Setup Added Successfully.');
            $this->resetExcept(['department_id', 'service_group_id', 'service_id', 'specimen_master_id', 'vacutainer_id', 'test_type_id', 'color_id']);

            $this->dispatchBrowserEvent('close-modal');
            $this->specimenMasters = SpecimenSetupModal::orderBy('id', 'desc')->get();
        }
    }

    public function edit(int $specimen_setup_id)
    {
        $this->specimen_setup_id = $specimen_setup_id;
        //  dd($this->specimen_setup_id);
        $specimenSetup = SpecimenSetupModal::find($specimen_setup_id);

        if ($specimenSetup != null) {

            $this->code = $specimenSetup->code;
            $this->department_id = $specimenSetup->department_id;
            $this->service_group_id = $specimenSetup->service_group_id;
            $this->service_id = $specimenSetup->service_id;
            $this->specimen_master_id = $specimenSetup->specimen_master_id;
            $this->vacutainer_id = $specimenSetup->vacutainer_id;
            $this->test_type_id = $specimenSetup->test_type_id;
            $this->color_id = $specimenSetup->color_id;
            $this->duration = $specimenSetup->duration;
            $this->dosage_qty = $specimenSetup->dosage_qty;
            $this->no_of_barcode = $specimenSetup->no_of_barcode;
            $this->short_name = $specimenSetup->short_name;
            $this->precaution = $specimenSetup->precaution;
            $this->clinical_history = $specimenSetup->clinical_history;
            $this->is_applicable_for_others_test = $specimenSetup->is_applicable_for_others_test;
            $this->is_required_precaution_on_bill = $specimenSetup->is_required_precaution_on_bill;
            $this->is_infection_dieases = $specimenSetup->is_infection_dieases;
            $this->is_curable = $specimenSetup->is_curable;
            $this->s1_cd = $specimenSetup->s1_cd;
            $this->s2_cd = $specimenSetup->s2_cd;
            $this->is_active = $specimenSetup->is_active;
        } else {
            die;
        }
    }
    public function update()
    {
        $specimenSetup = SpecimenSetupModal::find($this->specimen_setup_id);
        $specimenSetup->update(
            [
                'code' => $specimenSetup->code,
                'department_id' => $specimenSetup->department_id,
                'service_group_id' => $specimenSetup->service_group_id,
                'service_id' => $specimenSetup->service_id,
                'specimen_master_id' => $specimenSetup->specimen_master_id,
                'vacutainer_id' => $specimenSetup->vacutainer_id,
                'test_type_id' => $specimenSetup->test_type_id,
                'color_id' => $specimenSetup->color_id,
                'duration' => $specimenSetup->duration,
                'dosage_qty' => $specimenSetup->dosage_qty,
                'no_of_barcode' => $specimenSetup->no_of_barcode,
                'short_name' => $specimenSetup->short_name,
                'precaution' => $specimenSetup->precaution,
                'clinical_history' => $specimenSetup->clinical_history,
                'is_applicable_for_others_test' => $specimenSetup->is_applicable_for_others_test,
                'is_required_precaution_on_bill' => $specimenSetup->is_required_precaution_on_bill,
                'is_infection_dieases' => $specimenSetup->is_infection_dieases,
                'is_curable' => $specimenSetup->is_curable,
                's1_cd' => $specimenSetup->s1_cd,
                's2_cd' => $specimenSetup->s2_cd,
                'is_active' => $specimenSetup->is_active,

            ]
        );
        session()->flash('message', 'Updated Successfully.');
        $this->resetExcept(['department_id', 'service_group_id', 'service_id', 'specimen_master_id', 'vacutainer_id', 'test_type_id', 'color_id']);
        $this->specimenSetups = SpecimenSetupModal::orderBy("id", "desc")->get();
        $this->dispatchBrowserEvent('close-modal');
    }



    public function delete(int $specimen_setup_id)
    {
        $this->specimen_setup_id = $specimen_setup_id;
    }

    public function destroy()
    {
        $specimenSetup = SpecimenSetupModal::find($this->specimen_setup_id)->delete();
        session()->flash('message', 'Deleted Successfully.');
        $this->resetExcept(['department_id', 'service_group_id', 'service_id', 'specimen_master_id', 'vacutainer_id', 'test_type_id', 'color_id']);
        $this->specimenSetups = SpecimenSetupModal::orderBy("id", "desc")->get();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function render()
    {
        return view('livewire.pathology.specimen-set-up.specimen-set-up')->extends('layouts.admin')->section('content');;
    }
}
