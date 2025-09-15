<?php

namespace App\Http\Livewire\User;

use App\Models\StockPoint;
use App\Models\Team;
use App\Models\TeamStockPoint;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserProfileStockPointMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $team_stock_point_id, $team_id, $stock_points = [];
    public $teams = [];
    public $stock_point_list = [];

    public function mount()
    {
        $this->teams = Team::all();
        $this->stock_point_list = StockPoint::all();
    }

    protected function rules()
    {
        return [
            'team_id' => [
                'required',
                Rule::unique('team_stock_points')->ignore($this->team_stock_point_id),
            ],
            'stock_points' => ['required', 'array'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        TeamStockPoint::create([
            'team_id' => $this->team_id,
            'stock_points' => $this->stock_points,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'User Profile Stock Point Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $team = TeamStockPoint::find($id);
        if ($team) {
            $this->team_stock_point_id = $team->id;
            $this->team_id = $team->team_id;
            $this->stock_points = $team->stock_points;
        }
    }

    public function update()
    {
        $this->validate();

        $team = TeamStockPoint::find($this->team_stock_point_id);
        if ($team) {
            $team->update([
                'team_id' => $this->team_id,
                'stock_points' => $this->stock_points,
            ]);
        }

        session()->flash('message', 'User Profile Stock Point Updated Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->team_stock_point_id = $id;
    }

    public function destroy()
    {
        TeamStockPoint::where('id', $this->team_stock_point_id)->delete();

        session()->flash('message', 'User Profile Stock Point Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $team_stock_points = TeamStockPoint::latest()->paginate(10);

        return view('livewire.user.user-profile-stock-point-master', compact('team_stock_points'))->extends('layouts.admin')->section('content');
    }
}
