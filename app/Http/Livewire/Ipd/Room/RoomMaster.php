<?php

namespace App\Http\Livewire\Ipd\Room;

use App\Models\Ipd\Bed;
use Livewire\Component;
use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;
use App\Models\Ipd\NurseStation;
use Illuminate\Support\Facades\Auth;

class RoomMaster extends Component
{
    public  $ward_id, $nurse_station_id, $cost_center_id = 1, $name, $beds, $code, $bed_prefix, $block, $wing, $created_by_id, $updated_by_id;
    public $room_id, $wards = [], $nurseStations = [], $rooms = [];
    public $status, $is_casuality, $priority, $ward_tariff_id, $ward_group_id;

    public function mount()
    {
        $this->rooms = Room::latest()->get();
        $this->wards = Ward::get();
        $this->nurseStations = NurseStation::get();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'beds' => 'required',
            'ward_id' => 'required',
            'nurse_station_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $room = Room::create([
            'ward_id' => $this->ward_id,
            'nurse_station_id' => $this->nurse_station_id,
            'cost_center_id' => $this->cost_center_id,
            'name' => $this->name,
            'code' => $this->code,
            'display_name' => $this->name,
            'block' => $this->block,
            'wing' => $this->wing,
            'beds' => $this->beds,
            'status' => 1,
            'created_by_id' => Auth::user()?->id,
            'updated_by_id' => Auth::user()?->id
        ]);

        if ($room) {
            for ($i = 1; $i <= $this->beds; $i++) {
                Bed::create([
                    'ward_id' => $this->ward_id,
                    'room_id' => $room->id,
                    'code' => $room->code . '-' . $i,
                    'bed_status' => "vacant",
                    'display_name' => $this->bed_prefix ? $this->bed_prefix . "-" . $i : $room->code . "-" . $i,
                    'is_dummy_room' => 0,
                    'is_oxygen' => 0,
                    'is_suction' => 0,
                    'is_window' => 0,
                    'created_by_id' => Auth::user()?->id,
                    'updated_by_id' => Auth::user()?->id
                ]);
            }
        }

        session()->flash('message', 'Room Added Successfully.');
        $this->resetExcept('rooms', 'wards', 'nurseStations');
        $this->rooms = Room::latest()->get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $room_id)
    {
        $room = Room::find($room_id);
        if ($room) {
            $this->room_id = $room->id;
            $this->ward_id = $room->ward_id;
            $this->nurse_station_id = $room->nurse_station_id;
            $this->cost_center_id = $room->cost_center_id;
            $this->name = $room->name;
            $this->code = $room->code;
            $this->block = $room->block;
            $this->wing = $room->wing;
            $this->beds = $room->beds;
            $this->status = $room->status;
        }
    }

    public function update()
    {
        $this->validate();

        $room = Room::where('id', $this->room_id)->first();

        if ($room) {
            $room->ward_id = $this->ward_id;
            $room->nurse_station_id = $this->nurse_station_id;
            $room->cost_center_id = $this->cost_center_id;
            $room->name = $this->name;
            $room->code = $this->code;
            $room->display_name = $this->name;
            $room->block = $this->block;
            $room->wing = $this->wing;
            $room->beds = $this->beds;
            $room->status = 1;
            $room->updated_by_id = Auth::user()?->id;
            $room->save();

            session()->flash('message', 'Room Edited Successfully.');
            $this->resetExcept('rooms', 'wards', 'nurseStations');
            $this->dispatchBrowserEvent('close-modal');
            $this->rooms = Room::latest()->get();
        }
    }


    public function delete(int $room_id)
    {
        $this->room_id = $room_id;
    }

    public function destroy()
    {
        $room = Room::find($this->room_id);

        if ($room) {
            if ($room->beds()->count()) {
                session()->flash('error', 'Cannot delete room. Please remove all beds first.');
                $this->dispatchBrowserEvent('close-modal');
                return;
            }

            $room->delete();

            session()->flash('message', 'Room deleted Successfully.');
            $this->resetExcept('rooms', 'wards', 'nurseStations');
            $this->dispatchBrowserEvent('close-modal');
            $this->rooms = Room::latest()->get();
        }
    }

    public function closeModal()
    {
        $this->resetExcept('rooms', 'wards', 'nurseStations');
        $this->rooms = Room::latest()->get();
    }

    public function resetInput() {}

    public function render()
    {
        return view('livewire.ipd.room.room-master')->extends('layouts.admin')->section('content');
    }
}
