<?php

namespace App\Http\Livewire\Pathology\Organism;


use Livewire\Component;
use App\Models\Department;
use App\Models\Pathology\AntibioticOrganism;
use App\Services\AntibioticCart;
use App\Models\Pathology\Organism;
use App\Models\Pathology\Antibiotic;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;

class EditOrganismMaster extends Component
{
    public $department_id, $service_group_id, $code, $name, $default_organism = false, $is_active = true, $created_by_id, $updated_by_id;
    public $organisms = [], $departments = [], $servicegroups = [];
    public $antibiotics, $antibioticValuesArr = [], $antibioticCounter = 0, $antibiotic_id, $antibiotic_code, $antibiotic_name, $antibiotic_senstive, $antibiotic_moderate, $antibiotic_resistance, $antibiotic_is_active;
    //for edit and delete
    public $curentOrganismId, $currentAntibioticId;
    public $currentOrganismMaster, $organism_id;
    public $exist_antibiotics = [];

    public function mount($id)
    {
        $this->organisms = Organism::get();
        $this->departments = Department::get();
        $this->servicegroups = ServiceGroup::get();
        $this->antibiotics = Antibiotic::get();
        //for editing
        $this->currentOrganismMaster = Organism::find($id);
        $this->organism_id = $this->currentOrganismMaster->id;
        $this->department_id = $this->currentOrganismMaster->department_id;
        $this->service_group_id = $this->currentOrganismMaster->service_group_id;
        $this->code = $this->currentOrganismMaster->code;
        $this->name = $this->currentOrganismMaster->name;
        $this->default_organism = $this->currentOrganismMaster->default_organism;
        $this->is_active = $this->currentOrganismMaster->is_active;
        $this->created_by_id = $this->currentOrganismMaster->created_by_id;
        $this->updated_by_id = $this->currentOrganismMaster->updated_by_id;
        $this->exist_antibiotics = $this->currentOrganismMaster->antibiotics;
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
        $validatedData = $this->validate();

        Organism::where('id', $this->organism_id)->update([
            'department_id' => $this->department_id,
            'service_group_id' => $this->service_group_id,
            'name' => $this->name,
            'default_organism' => $this->default_organism,
            'is_active' => $this->is_active,
            'updated_by_id' => Auth::user()?->id
        ]);

        $Arr = [];
        foreach ($this->antibioticValuesArr as $antibioticValue) {
            $temp = [];
            $temp['organism_id'] = $this->organism_id;
            $temp['antibiotic_id'] = $antibioticValue['antibiotic_id'];
            array_push($Arr, $temp);
        }
        AntibioticOrganism::insert($Arr);
        return redirect()->route('admin.organism-master')->with('message', ' Organism Master  Updated Successfully.');
    }
    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }
    public function closeModal()
    {
        $this->resetExcept(['organisms', 'services', 'templates', 'departments', 'servicegroups', 'formats', 'antibiotics']);
    }

    public function render()
    {
        return view('livewire.pathology.organism.edit-organism-master')->extends('layouts.admin')->section('content');;
    }

    public function edit(int $currentAntibioticId)
    {
        $this->currentAntibioticId = $currentAntibioticId;
    }
    public function delete(int $currentAntibioticId)
    {
        $this->currentAntibioticId = $currentAntibioticId;
    }

    public function destroy()
    {
        AntibioticOrganism::find($this->currentAntibioticId)->delete();
        session()->flash('message', ' Deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');

        $this->currentOrganismMaster = Organism::find($this->organism_id);
        $this->exist_antibiotics = $this->currentOrganismMaster->antibiotics;
    }
}
