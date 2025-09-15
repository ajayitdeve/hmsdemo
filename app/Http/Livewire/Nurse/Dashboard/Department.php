<?php

namespace App\Http\Livewire\Nurse\Dashboard;

use App\Models\Ipd\NurseStation;
use Livewire\Component;

class Department extends Component
{
    public $nurse_station;
    public $nurse_stations = [];

    public function rules()
    {
        return [
            'nurse_station' => 'required',
        ];
    }

    public function mount()
    {
        $this->nurse_stations = NurseStation::get();

        if (session()->has("nurse_station_id")) {
            $this->nurse_station = session()->get("nurse_station_id");
        }
    }

    public function save()
    {
        $this->validate();

        session(['nurse_station_id' => $this->nurse_station]);

        return redirect()->route('admin.nurse.patient-list');
    }

    public function render()
    {
        return view('livewire.nurse.dashboard.department');
    }
}
