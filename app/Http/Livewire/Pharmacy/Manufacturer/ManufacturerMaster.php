<?php

namespace App\Http\Livewire\Pharmacy\Manufacturer;

use App\Models\CostCenter;
use App\Models\Manufacturer;
use App\Models\Type;
use Livewire\Component;

class ManufacturerMaster extends Component
{
    public $name, $type_id = 1, $cost_center_id = 1, $manufacturer_id, $types = [], $costcenters = [];

    public function mount()
    {
        $this->costcenters = CostCenter::get();
        $this->types = Type::get();
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:manufacturers,name,' . $this->manufacturer_id,
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
        Manufacturer::create($validatedData);

        session()->flash('message', 'Manufacturer Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $manufacturer_id)
    {
        $this->manufacturer_id = $manufacturer_id;
        $manufacturer = Manufacturer::find($manufacturer_id);
        if ($manufacturer) {
            $this->name = $manufacturer->name;
            $this->type_id = $manufacturer->type_id;
            $this->cost_center_id = $manufacturer->cost_center_id;
        } else {
        }
    }

    public function update()
    {

        $validatedData = $this->validate();
        Manufacturer::where('id', $this->manufacturer_id)->update([
            'name' => $validatedData['name'],
            'type_id' => $validatedData['type_id'],
            'cost_center_id' => $validatedData['cost_center_id'],
        ]);
        session()->flash('message', 'Manufacturer Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $manufacturer_id)
    {
        $this->manufacturer_id = $manufacturer_id;
    }

    public function destroy()
    {
        $itemspecialization = Manufacturer::find($this->manufacturer_id)->delete();
        session()->flash('message', 'Manufaturer   delete Successfully.');
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
    }

    public function render()
    {
        $manufacturers = Manufacturer::latest()->get();

        return view('livewire.pharmacy.manufacturer.manufacturer-master', ['manufacturers' => $manufacturers])->extends('layouts.admin')->section('content');
    }
}
