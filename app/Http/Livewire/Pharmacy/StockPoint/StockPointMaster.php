<?php

namespace App\Http\Livewire\Pharmacy\StockPoint;

use App\Models\CostCenter;
use App\Models\StockPoint;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class StockPointMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $code, $type_id = 1, $cost_center_id = 1, $stock_point_id, $types = [], $costcenters = [];

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
        StockPoint::create($validatedData);

        session()->flash('message', 'Stock Point Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $stock_point_id)
    {
        $stockpoint = StockPoint::find($stock_point_id);
        if ($stockpoint) {
            $this->name = $stockpoint->name;
            $this->code = $stockpoint->code;
            $this->type_id = $stockpoint->type_id;
            $this->cost_center_id = $stockpoint->cost_center_id;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        StockPoint::where('id', $this->stock_point_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Type Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $stock_point_id)
    {
        $this->stock_point_id = $stock_point_id;
    }

    public function destroy()
    {
        StockPoint::find($this->type_id)->delete();
        session()->flash('message', 'Stockpont  delete Successfully.');
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
        $stockpoints = StockPoint::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.pharmacy.stock-point.stock-point-master', ['stockpoints' => $stockpoints])->extends('layouts.admin')->section('content');
    }
}
