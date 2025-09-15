<?php

namespace App\Http\Livewire\Master\Ot;

use App\Models\OtType;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class OtTypeMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $ot_type_id, $name, $code;

    public function mount()
    {
        $this->code = 'OTT' . OtType::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('ot_types')->ignore($this->ot_type_id),
            ],
            'code' => ['required']
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        OtType::create([
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
        $ot_type = OtType::find($id);
        if ($ot_type) {
            $this->ot_type_id = $ot_type->id;
            $this->name = $ot_type->name;
            $this->code = $ot_type->code;
        }
    }

    public function update()
    {
        $this->validate();

        OtType::where('id', $this->ot_type_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'OT Type Updated Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->ot_type_id = $id;
    }

    public function destroy()
    {
        OtType::where('id', $this->ot_type_id)->delete();
        session()->flash('message', 'OT Type Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $ot_types = OtType::latest()->paginate(10);
        return view('livewire.master.ot.ot-type-master', compact('ot_types'))->extends('layouts.admin')->section('content');
    }
}
