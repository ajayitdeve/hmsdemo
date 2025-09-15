<?php

namespace App\Http\Livewire\Pharmacy\Form;

use App\Models\CostCenter;
use App\Models\Form;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class FormMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $code, $type_id = 1, $cost_center_id = 1, $form_id, $types = [], $costcenters = [];

    public function mount()
    {
        $this->costcenters = CostCenter::get();
        $this->types = Type::get();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'type_id' => 'required',
            'cost_center_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        // dd($validatedData);
        Form::create($validatedData);

        session()->flash('message', 'Form (UOM) Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $form_id)
    {
        //'name','code','type_id','cost_center_id'
        $this->form_id = $form_id;
        $form = Form::find($form_id);
        if ($form) {
            $this->name = $form->name;
            $this->code = $form->code;
            $this->type_id = $form->type_id;
            $this->cost_center_id = $form->cost_center_id;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Form::where('id', $this->form_id)->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'type_id' => $validatedData['type_id'],
            'cost_center_id' => $validatedData['cost_center_id'],
        ]);
        session()->flash('message', 'Type Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $form_id)
    {
        $this->form_id = $form_id;
    }

    public function destroy()
    {
        Form::find($this->form_id)->delete();
        session()->flash('message', 'Form (UOM)  delete Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->code = '';
        $this->type_id = '';
        $this->cost_center_id = '';
    }

    public function render()
    {
        $forms = Form::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.pharmacy.form.form-master', ['forms' => $forms])->extends('layouts.admin')->section('content');
    }
}
