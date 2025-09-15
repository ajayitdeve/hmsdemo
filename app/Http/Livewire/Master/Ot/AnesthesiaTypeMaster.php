<?php

namespace App\Http\Livewire\Master\Ot;

use App\Models\AnesthesiaType;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class AnesthesiaTypeMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $anesthesia_type_id, $name, $code;

    public function mount()
    {
        $this->code = 'ACD' . AnesthesiaType::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('anesthesia_types')->ignore($this->anesthesia_type_id),
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

        AnesthesiaType::create([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => '1',
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Anesthesia Type Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $anesthesia_type = AnesthesiaType::find($id);
        if ($anesthesia_type) {
            $this->anesthesia_type_id = $anesthesia_type->id;
            $this->name = $anesthesia_type->name;
            $this->code = $anesthesia_type->code;
        }
    }

    public function update()
    {
        $this->validate();

        AnesthesiaType::where('id', $this->anesthesia_type_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Anesthesia Type Updated Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->anesthesia_type_id = $id;
    }

    public function destroy()
    {
        AnesthesiaType::where('id', $this->anesthesia_type_id)->delete();
        session()->flash('message', 'Anesthesia Type Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $anesthesia_types = AnesthesiaType::latest()->paginate(10);
        return view('livewire.master.ot.anesthesia-type-master', compact('anesthesia_types'))->extends('layouts.admin')->section('content');
    }
}
