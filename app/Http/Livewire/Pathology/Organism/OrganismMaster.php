<?php

namespace App\Http\Livewire\Pathology\Organism;

use App\Models\Pathology\AntibioticOrganism;
use Livewire\Component;
use App\Models\Department;

use App\Services\AntibioticCart;
use App\Models\Pathology\Organism;
use App\Models\Pathology\Antibiotic;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;

class OrganismMaster extends Component
{

    public $organism_id, $department_id, $service_group_id, $code, $name, $default_organism = false, $is_active = true, $created_by_id, $updated_by_id;
    public $organisms = [], $departments = [], $servicegroups = [];
    public $antibiotics, $antibioticValuesArr = [], $antibioticCounter = 0, $antibiotic_id, $antibiotic_code, $antibiotic_name, $antibiotic_senstive, $antibiotic_moderate, $antibiotic_resistance, $antibiotic_is_active;

    public function mount()
    {
        $this->organisms = Organism::latest()->get();
        $this->departments = Department::get();
        $this->servicegroups = ServiceGroup::get();
        $this->antibiotics = Antibiotic::get();
    }

    protected function rules()
    {
        return [
            'department_id' => 'required',
            'service_group_id' => 'required',
            'name' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addToCart()
    {
        $this->antibioticCounter++;
        $antibioticCart = new AntibioticCart($this->antibioticCounter, $this->antibiotic_id, $this->antibiotic_code, $this->antibiotic_name, $this->antibiotic_senstive, $this->antibiotic_moderate, $this->antibiotic_resistance, $this->antibiotic_is_active);
        $temp = [];
        $temp['id'] = $antibioticCart->id;
        $temp['antibiotic_id'] = $antibioticCart->antibiotic_id;
        $temp['code'] = $antibioticCart->code;
        $temp['name'] = $antibioticCart->name;
        $temp['senstive'] = $antibioticCart->senstive;
        $temp['moderate'] = $antibioticCart->moderate;
        $temp['resistance'] = $antibioticCart->resistance;
        $temp['is_active'] = $antibioticCart->is_active;


        array_push($this->antibioticValuesArr, $temp);
        //reseting form
        $this->reset('antibiotic_id', 'antibiotic_code', 'antibiotic_name', 'antibiotic_senstive', 'antibiotic_moderate', 'antibiotic_resistance', 'antibiotic_is_active');
    }

    public function deleteCart($id)
    {
        unset($this->antibioticValuesArr[$id - 1]);
        $this->render();
        session()->flash('message', 'Removed Successfully.');
    }

    public function antibioticChanged()
    {
        $antibiotic = Antibiotic::find((int) $this->antibiotic_id);
        $this->antibiotic_id = $antibiotic->id;
        $this->antibiotic_code = $antibiotic->code;
        $this->antibiotic_name = $antibiotic->name;
        $this->antibiotic_senstive = $antibiotic->senstive;
        $this->antibiotic_moderate = $antibiotic->moderate;
        $this->antibiotic_resistance = $antibiotic->resistance;
        $this->antibiotic_is_active = $this->is_active;
    }

    public function save()
    {
        $this->validate();
        $organismMaxId = Organism::max('id');
        $organismCode = 'TEM' . $organismMaxId + 1;
        // `department_id`, `service_group_id`, `code`, `name`, `default_organism`, `is_active`, `created_by_id`, `updated_by_id`
        $organism = Organism::create([
            'department_id' => $this->department_id,
            'service_group_id' => $this->service_group_id,
            'code' => $organismCode,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'default_organism' => $this->default_organism,
            'created_by_id' => Auth::user()?->id,
            'updatedby_id' => Auth::user()?->id,
        ]);
        if ($organism) {
            $Arr = [];
            foreach ($this->antibioticValuesArr as $antibioticValue) {
                $temp = [];
                $temp['organism_id'] = $organism->id;
                $temp['antibiotic_id'] = $antibioticValue['antibiotic_id'];
                array_push($Arr, $temp);
            }
            AntibioticOrganism::insert($Arr);
            session()->flash('message', 'Organism Added Successfully.');
            $this->resetExcept(['organisms', 'services', 'organisms', 'departments', 'servicegroups', 'antibiotics']);
            $this->dispatchBrowserEvent('close-modal');
            $this->organisms = Organism::latest()->get();
        }
    }

    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }

    public function closeModal()
    {
        $this->resetExcept(['organisms', 'services', 'templates', 'departments', 'servicegroups', 'formats', 'antibiotics']);
    }

    public function delete($id)
    {
        $this->organism_id = $id;
    }

    public function destroy()
    {
        AntibioticOrganism::where("organism_id", $this->organism_id)->delete();
        Organism::find($this->organism_id)->delete();
        session()->flash('message', 'Organism deleted Successfully.');
        $this->resetExcept(['organisms', 'services', 'organisms', 'departments', 'servicegroups', 'antibiotics']);
        $this->dispatchBrowserEvent('close-modal');
        $this->organisms = Organism::latest()->get();
    }

    public function render()
    {
        return view('livewire.pathology.organism.organism-master')->extends('layouts.admin')->section('content');
    }
}
