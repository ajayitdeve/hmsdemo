<?php

namespace App\Http\Livewire\Pathology\Parameter;

use Livewire\Component;
use App\Models\Department;
use App\Models\Service\Service;
use App\Services\ParameterCart;
use App\Models\Pathology\Symbol;
use Illuminate\Support\Facades\DB;
use App\Models\Pathology\Parameter;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;
use App\Models\Pathology\ParameterUnit;
use App\Models\Pathology\ParameterValue;

class EditParameter extends Component
{

    public $department_id, $service_group_id, $parameter_unit_id, $code, $name, $short_name, $method, $display_type = 'S', $text_size = 'S', $normal_range, $antibiotic_needed = 0, $is_active = 1, $uom_unit = 0, $multiple_values, $multiple_value_json;
    public $departments, $servicegroups, $services, $parameters;
    public $multiValuesArr = [], $counter = 0, $multipleName;
    //for parameter values
    public $parameterValuesArr = [], $parameterValuesCounter = 0, $symbols = [];
    public $symbol_id, $gender, $min_age, $min_age_uom, $max_age, $max_age_uom, $min_range, $max_range, $normal_range_value, $min_critical, $max_critical, $description;
    public $parameterunits = [];
    public $parameter_id;
    public $parameter_value_id;
    public $selectedParameter;
    public function mount($id)
    {
        $this->departments = Department::where('is_medical', 1)->get();
        $this->services = Service::get();
        $this->parameters = Parameter::get();
        $this->servicegroups = ServiceGroup::get();
        $this->parameterunits = ParameterUnit::get();
        $this->symbols = Symbol::get();

        $parameter = Parameter::find($id);
        $this->selectedParameter = $parameter;
        // dd($parameter);
        //dd($this->selectedParameter->multiple_value_json);

        if ($parameter->multiple_value_json != null) {
            $jsonArr = json_decode($parameter->multiple_value_json);
            foreach ($jsonArr as $arr) {
                $this->counter++;
                $temp = [];
                $temp['id'] = $arr->id;
                $temp['name'] = $arr->name;
                array_push($this->multiValuesArr, $temp);
            }
        }
        if ($parameter) {
            $this->department_id = $parameter->department_id;
            $this->service_group_id = $parameter->id;
            $this->code = $parameter->code;
            $this->name = $parameter->name;
            $this->short_name = $parameter->short_name;
            $this->method = $parameter->method;
            $this->display_type = $parameter->display_type;
            $this->text_size = $parameter->text_size;
            $this->normal_range = $parameter->normal_range;
            $this->antibiotic_needed = $parameter->antibiotic_needed;
            $this->is_active = $parameter->is_active;
            $this->uom_unit = $parameter->uom_unit;
            $this->parameter_unit_id = $parameter->parameter_unit;
            $this->multiple_values = $parameter->multiple_values;
            $this->multiple_value_json = $parameter->multiple_value_json;
        } else {
        }
    }

    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }

    public function addMultipleValues()
    {
        $this->counter++;
        $temp = [];
        $temp['id'] = $this->counter;
        $temp['name'] = $this->multipleName;
        array_push($this->multiValuesArr, $temp);
        $this->multiple_value_json = json_encode($this->multiValuesArr);
        $this->reset('multipleName');
    }
    public function deleteMultipleValues($id)
    {
        unset($this->multiValuesArr[$id - 1]);
        $this->render();
        session()->flash('message', ' Removed Successfully.');
    }

    public function addToCart()
    {

        $this->parameterValuesCounter++;
        $parameterCart = new ParameterCart(
            $this->parameterValuesCounter,
            $this->parameter_unit_id,
            $this->symbol_id,
            $this->gender,
            $this->min_age,
            $this->min_age_uom,
            $this->max_age,
            $this->max_age_uom,
            $this->min_range,
            $this->max_range,
            $this->normal_range_value,
            $this->min_critical,
            $this->max_critical,
            $this->description
        );
        $temp = [];
        $temp['id'] = $parameterCart->id;
        $temp['parameter_unit_id'] = $parameterCart->parameter_unit_id;
        $temp['symbol_id'] = $parameterCart->symbol_id;
        $temp['gender'] = $parameterCart->gender;
        $temp['gender'] = $parameterCart->gender;
        $temp['min_age'] = $parameterCart->min_age;
        $temp['min_age_uom'] = $parameterCart->min_age_uom;
        $temp['max_age'] = $parameterCart->max_age;
        $temp['max_age_uom'] = $parameterCart->max_age_uom;
        $temp['min_range'] = $parameterCart->min_range;
        $temp['max_range'] = $parameterCart->max_range;
        $temp['normal_range_value'] = $parameterCart->normal_range_value;
        $temp['min_critical'] = $parameterCart->min_critical;
        $temp['max_critical'] = $parameterCart->max_critical;
        $temp['description'] = $parameterCart->description;
        array_push($this->parameterValuesArr, $temp);
        //reseting form
        $this->reset('symbol_id', 'gender', 'min_age', 'min_age_uom', 'max_age', 'max_age_uom', 'min_range', 'max_range', 'normal_range_value', 'min_critical', 'max_critical', 'description');
    }
    public function deleteCart($id)
    {

        unset($this->parameterValuesArr[$id - 1]);
        $this->render();
        session()->flash('message', 'Removed Successfully.');
    }
    public function closeModal()
    {
        $this->resetExcept('departments', 'parameters', 'services', 'servicegroups', 'parameterunits', 'symbols');
    }

    public function save()
    {

        DB::transaction(function () {
            $status = true;
            //there are two main scenarios 1:$multiple_values  2: $normal_range
            $parameterMaxId = Parameter::max('id');
            $parameterCode = 'LPR' . $parameterMaxId + 1;
            $parameter = Parameter::create([
                'department_id' => $this->department_id,
                'service_group_id' => $this->service_group_id,
                'code' => $parameterCode,
                'name' => $this->name,
                'short_name' => $this->short_name,
                'method' => $this->method,
                'display_type' => $this->display_type,
                'text_size' => $this->text_size,
                'normal_range' => $this->normal_range,
                'antibiotic_needed' => $this->antibiotic_needed,
                'is_active' => true,
                'uom_unit' => $this->uom_unit,
                'parameter_unit_id' => $this->parameter_unit_id,
                'multiple_values' => $this->multiple_values,
                'multiple_value_json' => $this->multiple_values ? $this->multiple_value_json : null,
                'created_by_id' => Auth::user()?->id,
                'updated_by_id' => Auth::user()?->id,
            ]);
            $status = $status && $parameter;
            if ($this->normal_range) {

                $paramArr = [];
                foreach ($this->parameterValuesArr as $paramValue) {
                    $temp = [];
                    $temp['parameter_id'] = $parameter['id'];
                    $temp['parameter_unit_id'] = $paramValue['parameter_unit_id'];
                    $temp['symbol_id'] = $paramValue['symbol_id'];
                    $temp['gender'] = $paramValue['gender'];
                    $temp['gender'] = $paramValue['gender'];
                    $temp['min_age'] = $paramValue['min_age'];
                    $temp['min_age_uom'] = $paramValue['min_age_uom'];
                    $temp['max_age'] = $paramValue['max_age'];
                    $temp['max_age_uom'] = $paramValue['max_age_uom'];
                    $temp['min_range'] = $paramValue['min_range'];
                    $temp['max_range'] = $paramValue['max_range'];
                    $temp['normal_range'] = $paramValue['normal_range_value'];
                    $temp['min_critical'] = $paramValue['min_critical'];
                    $temp['max_critical'] = $paramValue['max_critical'];
                    $temp['description'] = $paramValue['description'];
                    array_push($paramArr, $temp);
                }
                $parameterValues = ParameterValue::insert($paramArr);
                $status = $status && $parameterValues;
                if ($status) {
                    DB::commit();
                } else {
                    DB::rollBack();
                }
            }
        }, 1);

        session()->flash('message', 'Service Group Created  Successfully.');
        $this->resetExcept(['parameters', 'departments', 'servicegroups', 'services']);
        $this->parameters = Parameter::orderBy('id', 'DESC')->get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $parameter_id)
    {
        //'department_id', 'service_group_id', 'code', 'name', 'short_name', 'method', 'display_type', 'text_size', 'normal_range', 'antibiotic_needed', 'is_active', 'uom_unit',
        // 'parameter_unit_id', 'multiple_values', 'multiple_value_json', 'created_by_id', 'updated_by_id'
        $parameter = Parameter::find($parameter_id);
        $this->selectedParameter = $parameter;
        //  dd($parameter);
        //dd($this->selectedParameter->multiple_value_json);

        if ($parameter->multiple_value_json != null) {
            $jsonArr = json_decode($parameter->multiple_value_json);
            foreach ($jsonArr as $arr) {
                $this->counter++;
                $temp = [];
                $temp['id'] = $arr->id;
                $temp['name'] = $arr->name;
                array_push($this->multiValuesArr, $temp);
            }
        }
        if ($parameter) {
            $this->department_id = $parameter->department_id;
            $this->service_group_id = $parameter->id;
            $this->code = $parameter->code;
            $this->name = $parameter->name;
            $this->short_name = $parameter->short_name;
            $this->method = $parameter->method;
            $this->display_type = $parameter->display_type;
            $this->text_size = $parameter->text_size;
            $this->normal_range = $parameter->normal_rage;
            $this->antibiotic_needed = $parameter->antibiotic_needed;
            $this->is_active = $parameter->is_active;
            $this->uom_unit = $parameter->uom_unit;
            $this->parameter_unit_id = $parameter->parameter_unit;
            $this->multiple_values = $parameter->multiple_values;
            $this->multiple_value_json = $parameter->multiple_value_json;
        } else {
        }
    }

    public function update()
    {
        //  dd($this->parameterValuesArr);
        DB::transaction(function () {
            $status = true;

            $parameter = Parameter::find($this->selectedParameter->id)->update([
                'department_id' => $this->department_id,
                'service_group_id' => $this->service_group_id,
                'code' => $this->selectedParameter->code,
                'name' => $this->name,
                'short_name' => $this->short_name,
                'method' => $this->method,
                'display_type' => $this->display_type,
                'text_size' => $this->text_size,
                'normal_range' => $this->normal_range,
                'antibiotic_needed' => $this->antibiotic_needed,
                'is_active' => true,
                'uom_unit' => $this->uom_unit,
                'parameter_unit_id' => $this->parameter_unit_id,
                'multiple_values' => $this->multiple_values,
                'multiple_value_json' => $this->multiple_values ? $this->multiple_value_json : null,
                'created_by_id' => Auth::user()?->id,
                'updated_by_id' => Auth::user()?->id,
            ]);
            // $status = $status && $parameter;
            if ($this->normal_range) {

                $paramArr = [];
                foreach ($this->parameterValuesArr as $paramValue) {
                    $temp = [];
                    $temp['parameter_id'] = $this->selectedParameter->id;
                    $temp['parameter_unit_id'] = $paramValue['parameter_unit_id'];
                    $temp['symbol_id'] = $paramValue['symbol_id'];
                    $temp['gender'] = $paramValue['gender'];
                    $temp['gender'] = $paramValue['gender'];
                    $temp['min_age'] = $paramValue['min_age'];
                    $temp['min_age_uom'] = $paramValue['min_age_uom'];
                    $temp['max_age'] = $paramValue['max_age'];
                    $temp['max_age_uom'] = $paramValue['max_age_uom'];
                    $temp['min_range'] = $paramValue['min_range'];
                    $temp['max_range'] = $paramValue['max_range'];
                    $temp['normal_range'] = $paramValue['normal_range_value'];
                    $temp['min_critical'] = $paramValue['min_critical'];
                    $temp['max_critical'] = $paramValue['max_critical'];
                    $temp['description'] = $paramValue['description'];
                    array_push($paramArr, $temp);
                }
                $parameterValues = ParameterValue::insert($paramArr);
                $status = $status && $parameterValues;
                if ($status) {
                    DB::commit();
                } else {
                    DB::rollBack();
                }
            }
        }, 1);

        // session()->flash('message', 'Parameter Updated Successfully.');
        // $this->resetExcept(['parameters', 'departments', 'servicegroups', 'services']);
        // $this->parameters = Parameter::orderBy('id', 'DESC')->get();
        // $this->dispatchBrowserEvent('close-modal');
        return redirect()->route('admin.parameter-master')->with('message', ' Parameter Updated Successfully.');
    }
    public function delete(int $parameter_value_id)
    {
        $this->parameter_value_id = $parameter_value_id;
    }

    public function destroy()
    {
        // dd(ParameterValue::find($this->parameter_value_id));
        ParameterValue::find($this->parameter_value_id)->delete();
        session()->flash('message', 'Parameter Value deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');
        return redirect()->route('admin.parameter-master.edit', $this->selectedParameter->id)->with('message', ' Parameter value Deleted Successfully.');
    }
    public function render()
    {
        return view('livewire.pathology.parameter.edit-parameter')->extends('layouts.admin')->section('content');;
    }
}
