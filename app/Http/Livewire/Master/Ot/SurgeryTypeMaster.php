<?php

namespace App\Http\Livewire\Master\Ot;

use App\Models\SurgeryType;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class SurgeryTypeMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $surgery_type_id, $name, $code;

    public function mount()
    {
        $this->code = 'SGT' . SurgeryType::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('surgery_types')->ignore($this->surgery_type_id),
            ],
            'code' => 'required',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        SurgeryType::create([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => '1',
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'OT Type Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $ot_type = SurgeryType::find($id);
        if ($ot_type) {
            $this->surgery_type_id = $ot_type->id;
            $this->name = $ot_type->name;
            $this->code = $ot_type->code;
        }
    }

    public function update()
    {
        $this->validate();

        SurgeryType::where('id', $this->surgery_type_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'OT Type Updated Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->surgery_type_id = $id;
    }

    public function destroy()
    {
        SurgeryType::where('id', $this->surgery_type_id)->delete();
        session()->flash('message', 'OT Type Deleted Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $surgery_types = SurgeryType::latest()->paginate(10);
        return view('livewire.master.ot.surgery-type-master', compact('surgery_types'))->extends('layouts.admin')->section('content');
    }
}
