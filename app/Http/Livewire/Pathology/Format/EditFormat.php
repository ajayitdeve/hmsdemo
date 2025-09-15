<?php

namespace App\Http\Livewire\Pathology\Format;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Pathology\FormatParameter;
use App\Models\Pathology\Parameter;

class EditFormat extends Component
{
    public $format_id = null, $format;
    public $parameterValuesArr = [], $parameterValuesCounter = 0, $sub_title, $parameter_id, $parameters;
    public function mount($id)
    {
        $this->format_id = $id;
        $this->format = \App\Models\Pathology\Format::find($this->format_id);
        $this->parameters = \App\Models\Pathology\Parameter::get();
    }
    public function addToCart()
    {
        $this->validate([
            "sub_title" => "required",
            "parameter_id" => "required",
        ]);

        $this->parameterValuesCounter++;
        $parameterCart = new \App\Services\FormatParameterCart($this->parameterValuesCounter, $this->parameter_id, $this->sub_title);

        $parameter = Parameter::find($this->parameter_id);
        if ($parameter) {
            $temp = [];
            $temp['id'] = $parameterCart->id;
            $temp['sub_title'] = $parameterCart->sub_title;
            $temp['parameter_id'] = $parameterCart->parameter_id;
            $temp['parameter_name'] = $parameter->name;
            $temp['parameter_code'] = $parameter->code;

            array_push($this->parameterValuesArr, $temp);
            $this->reset('parameter_id', 'sub_title');
        }
    }
    public function deleteCart($id)
    {

        unset($this->parameterValuesArr[$id - 1]);
        $this->render();
        session()->flash('message', 'Removed Successfully.');
    }
    public function buttonClicked()
    {
        dd('hello');
    }
    public function save()
    {
        $paramArr = [];
        foreach ($this->parameterValuesArr as $paramValue) {
            $temp = [];
            $temp['format_id'] = $this->format_id;
            $temp['parameter_id'] = $paramValue['parameter_id'];
            $temp['sub_title'] = $paramValue['sub_title'];

            array_push($paramArr, $temp);
        }
        FormatParameter::insert($paramArr);

        return redirect()->route('admin.format-setup')->with('message', ' Parameter Added Successfully.');
    }

    public function delete(int $parameter_id)
    {
        $this->parameter_id = $parameter_id;
    }

    public function destroy()
    {
        $formatParameter = FormatParameter::where('format_id', $this->format_id)->where('parameter_id', $this->parameter_id)->delete();
        // session()->flash('message', 'Gender delete Successfully.');
        return redirect()->route('admin.format-setup.edit', $this->format_id)->with('message', ' Parameter Deleted Successfully.');
    }
    public function render()
    {
        return view('livewire.pathology.format.edit-format')->extends('layouts.admin')->section('content');
    }
}
