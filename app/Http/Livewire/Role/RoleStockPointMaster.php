<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class RoleStockPointMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $role_stock_point_id, $role_id,  $stock_point_id;
    public $roles = [];
    public $stock_points = [];

    public function mount()
    {
        $this->roles = Role::get();
        $this->stock_points = StockPoint::all();
    }

    protected function rules()
    {
        return [
            'role_id' => [
                'required',
                Rule::unique('role_stock_points')->ignore($this->role_stock_point_id),
            ],
            'stock_point_id' => ['required']
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $stock_point = StockPoint::find($this->stock_point_id);

        RoleStockPoint::create([
            'name' => $stock_point->name,
            'role_id' => $this->role_id,
            'stock_point_id' => $this->stock_point_id,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Role Stock Point Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $role_stock_point = RoleStockPoint::find($id);
        if ($role_stock_point) {
            $this->role_stock_point_id = $role_stock_point->id;
            $this->role_id = $role_stock_point->role_id;
            $this->stock_point_id = $role_stock_point->stock_point_id;
        }
    }

    public function update()
    {
        $this->validate();

        $stock_point = StockPoint::find($this->stock_point_id);

        RoleStockPoint::where('id', $this->role_stock_point_id)->update([
            'name' => $stock_point->name,
            'role_id' => $this->role_id,
            'stock_point_id' => $this->stock_point_id,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Role Stock Point Updated Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->role_stock_point_id = $id;
    }

    public function destroy()
    {
        RoleStockPoint::where('id', $this->role_stock_point_id)->forceDelete();

        session()->flash('message', 'Category Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $role_stock_points = RoleStockPoint::latest()->paginate(10);
        return view('livewire.role.role-stock-point-master', compact('role_stock_points'))->extends('layouts.admin')->section('content');
    }
}
