<?php

namespace App\Http\Livewire\Pharmacy\Generic;

use App\Imports\GenericImport;
use App\Models\CostCenter;
use App\Models\Generic;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Maatwebsite\Excel\Facades\Excel;

class GenericMaster extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $name, $type_id = 1, $cost_center_id = 1, $generic_id, $types = [], $costcenters = [];
    public $file;

    public function mount()
    {
        $this->costcenters = CostCenter::get();
        $this->types = Type::get();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
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
        Generic::create($validatedData);

        session()->flash('message', 'Generic Added Successfully.');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $generic_id)
    {
        $this->generic_id = $generic_id;
        $generic = Generic::find($generic_id);
        if ($generic) {
            $this->name = $generic->name;
            $this->type_id = $generic->type_id;
            $this->cost_center_id = $generic->cost_center_id;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Generic::where('id', $this->generic_id)->update([
            'name' => $validatedData['name'],
            'type_id' => $validatedData['type_id'],
            'cost_center_id' => $validatedData['cost_center_id']
        ]);
        session()->flash('message', 'Generic Edited Successfully.');
        $this->resetExcept(['costcenters', 'types']);
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $generic_id)
    {
        $this->generic_id = $generic_id;
    }

    public function destroy()
    {
        $generic = Generic::find($this->generic_id)->delete();
        session()->flash('message', 'Generic delete Successfully.');
        $this->resetExcept(['costcenters', 'types']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function  closeModal()
    {
        $this->resetExcept(['costcenters', 'types']);
    }

    public function import_file()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx|max:20480', // 20MB Max
        ]);

        Excel::import(new GenericImport, $this->file);
        session()->flash('message', 'Generic Import Successfully.');
        $this->reset(['file']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $generics = Generic::orderBy('id', 'DESC')->get();

        return view('livewire.pharmacy.generic.generic-master', ['generics' => $generics])->extends('layouts.admin')->section('content');
    }
}
