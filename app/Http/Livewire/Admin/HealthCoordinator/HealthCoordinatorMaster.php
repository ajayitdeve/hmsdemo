<?php

namespace App\Http\Livewire\Admin\HealthCoordinator;

use Livewire\Component;
use App\Models\HealthCoordinator;
use Illuminate\Support\Facades\Hash;

class HealthCoordinatorMaster extends Component
{
    public $name, $code, $father_name, $email, $dob, $address, $is_active = true, $mobile;
    public $health_coordinator_id, $healthCoordinators = [];

    public function mount()
    {
        $this->healthCoordinators = HealthCoordinator::get();
    }

    protected function rules()
    {

        return [
            "name" => "required",
            "father_name" => "required",
            "mobile" => "required",
            'email' => 'required|email',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $this->validate();

        $maxId = HealthCoordinator::max('id');
        HealthCoordinator::create([
            'code' => 'HC' . $maxId + 1,
            'name' => $this->name,
            'father_name' => $this->father_name,
            'email' => $this->email,
            'password' => Hash::make($this->mobile),
            'mobile' => $this->mobile,
            'address' => $this->address,
            'is_active' => $this->is_active,
            'dob' => $this->dob,
        ]);

        session()->flash('message', 'Health Coordinator Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $health_coordinator_id)
    {
        $healthCoordinator = HealthCoordinator::find($health_coordinator_id);

        if ($healthCoordinator) {
            $this->health_coordinator_id = $healthCoordinator->id;
            $this->code = $healthCoordinator->code;
            $this->name = $healthCoordinator->name;
            $this->father_name = $healthCoordinator->father_name;
            $this->email = $healthCoordinator->email;
            $this->mobile = $healthCoordinator->mobile;
            $this->address = $healthCoordinator->address;
            $this->dob = $healthCoordinator->dob;
            $this->is_active = $healthCoordinator->is_active;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        HealthCoordinator::where('id', $this->health_coordinator_id)->update([
            'code' => $this->code,
            'name' => $this->name,
            'father_name' => $this->father_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'dob' => $this->dob,
            'is_active' => $this->is_active
        ]);
        session()->flash('message', 'Health Coordinator  Edited Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $health_coordinator_id)
    {
        $this->health_coordinator_id = $health_coordinator_id;
    }

    public function destroy()
    {
        HealthCoordinator::find($this->health_coordinator_id)->delete();
        session()->flash('message', 'Health Coordinator  deleted Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.admin.health-coordinator.health-coordinator-master')->extends('layouts.admin')->section('content');
    }
}
