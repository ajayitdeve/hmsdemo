<?php

namespace App\Http\Livewire\Ipd\Bed;

use App\Models\Ipd\Bed;
use Livewire\Component;
use App\Models\Ipd\Room;
use Illuminate\Support\Facades\Auth;

class BedMaster extends Component
{
    public $bed_id, $ward_id, $room_id, $code, $bed_status = "vacant", $display_name, $is_dummy_room = 0, $is_oxygen = 0, $is_suction = 0, $is_window = 0, $created_by_id, $updated_by_id, $created_at, $updated_at;
    public $room, $beds = [], $wards = [];

    public function mount($room_id)
    {
        $this->room_id = $room_id;
        $this->room = Room::find($this->room_id);
        $this->ward_id = $this->room->ward_id;
        $this->beds = Bed::where('room_id', $this->room_id)->latest()->get();
    }

    public function rules()
    {
        return [
            'display_name' => 'required',
            'code' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        Bed::create([
            'ward_id' => $this->ward_id,
            'room_id' => $this->room_id,
            'code' => $this->code,
            'bed_status' => $this->bed_status,
            'display_name' => $this->display_name,
            'is_dummy_room' => $this->is_dummy_room,
            'is_oxygen' => $this->is_oxygen,
            'is_suction' => $this->is_suction,
            'is_window' => $this->is_window,
            'created_by_id' => Auth::user()?->id,
            'updated_by_id' => Auth::user()?->id
        ]);

        session()->flash('message', 'Bed  Added Successfully.');
        $this->reset('code', 'bed_status', 'display_name', 'is_dummy_room', 'is_oxygen', 'is_suction', 'is_window');
        $this->dispatchBrowserEvent('close-modal');
        $this->beds = Bed::where('room_id', $this->room_id)->latest()->get();
    }

    public function edit(int $bed_id)
    {
        $bed = Bed::find($bed_id);
        if ($bed) {
            $this->bed_id = $bed_id;

            $this->code = $bed->code;
            $this->bed_status = $bed->bed_status;
            $this->display_name = $bed->display_name;
            $this->is_dummy_room = $bed->is_dummy_room;
            $this->is_oxygen = $bed->is_oxygen;
            $this->is_suction = $bed->is_suction;
            $this->is_window = $bed->is_window;
        }
    }

    public function update()
    {
        $this->validate();

        Bed::where('id', $this->bed_id)->update(
            [
                'code' => $this->code,
                'bed_status' => $this->bed_status,
                'display_name' => $this->display_name,
                'is_dummy_room' => $this->is_dummy_room,
                'is_oxygen' => $this->is_oxygen,
                'is_suction' => $this->is_suction,
                'is_window' => $this->is_window,
                'updated_by_id' => Auth::user()?->id
            ]
        );

        session()->flash('message', 'Bed Edited Successfully.');
        $this->reset('code', 'bed_status', 'display_name', 'is_dummy_room', 'is_oxygen', 'is_suction', 'is_window');
        $this->dispatchBrowserEvent('close-modal');
        $this->beds = Bed::where('room_id', $this->room_id)->latest()->get();
    }


    public function delete(int $bed_id)
    {
        $this->bed_id = $bed_id;
    }

    public function destroy()
    {
        $bed = Bed::find($this->bed_id);

        if ($bed && $bed->bed_status == 'used') {
            session()->flash('error', 'Bed is in use. Cannot delete.');
            $this->dispatchBrowserEvent('close-modal');
            return;
        }

        $bed->delete();

        session()->flash('message', 'Bed deleted Successfully.');
        $this->reset('code', 'bed_status', 'display_name', 'is_dummy_room', 'is_oxygen', 'is_suction', 'is_window');
        $this->dispatchBrowserEvent('close-modal');
        $this->beds = Bed::where('room_id', $this->room_id)->latest()->get();
    }

    public function closeModal()
    {
        // $this->resetExcept('wards','wardTariffs','wardGroups');
        // $this->wards = ward::get();
    }
    public function resetInput() {}

    public function render()
    {
        return view('livewire.ipd.bed.bed-master')->extends('layouts.admin')->section('content');
    }
}
