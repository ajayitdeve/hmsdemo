<?php

namespace App\Http\Livewire\Ipd\NurseStation;

use App\Models\CostCenter;
use Livewire\Component;
use App\Models\Ipd\NurseStation;
use Illuminate\Support\Facades\Auth;

class NurseStationMaster extends Component
{
    public $nurse_station_id, $cost_center_id, $code, $name, $created_by_id, $updated_by_id;
    public $nurseStations = [], $cost_centers = [];

    public function mount()
    {
        $this->nurseStations = NurseStation::get();
        $this->cost_centers = CostCenter::get();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'cost_center_id' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        $lastNurseStation = NurseStation::max('id');
        $nurseStation = new NurseStation;
        $nurseStation->cost_center_id = $this->cost_center_id;
        $nurseStation->name = $this->name;
        $nurseStation->code = 'NST' . $lastNurseStation + 1;
        $nurseStation->created_by_id = Auth::user()?->id;
        $nurseStation->updated_by_id = Auth::user()?->id;
        $nurseStation->save();

        session()->flash('success', 'Nurse Station  Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->nurseStations = NurseStation::get();
    }

    public function edit(int $nurse_station_id)
    {
        $nurseStation = NurseStation::find($nurse_station_id);
        if ($nurseStation) {
            $this->nurse_station_id = $nurseStation->id;
            $this->cost_center_id = $nurseStation->cost_center_id;
            $this->name = $nurseStation->name;
            $this->code = $nurseStation->code;
            $this->created_by_id = $nurseStation->created_by_id;
            $this->updated_by_id = $nurseStation->updated_by_id;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        NurseStation::where('id', $this->nurse_station_id)->update(
            [
                'name' => $this->name,
                'cost_center_id' => $this->cost_center_id,
                'updated_by_id' => Auth::user()?->id,
            ]
        );
        session()->flash('success', 'Nurse Station Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->nurseStations = NurseStation::get();
    }


    public function delete(int $nurse_station_id)
    {
        $this->nurse_station_id = $nurse_station_id;
    }

    public function destroy()
    {
        NurseStation::find($this->nurse_station_id)->delete();
        session()->flash('success', 'Nurse Station  deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
        $this->nurseStations = NurseStation::get();
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInput()
    {
        $this->nurse_station_id = '';
        $this->cost_center_id = '';
        $this->code = '';
        $this->name = '';
        $this->created_by_id = '';
        $this->updated_by_id = '';
    }

    public function render()
    {
        return view('livewire.ipd.nurse-station.nurse-station-master')->extends('layouts.admin')->section('content');
    }
}
