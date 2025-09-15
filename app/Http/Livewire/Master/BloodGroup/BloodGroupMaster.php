<?php

namespace App\Http\Livewire\Master\BloodGroup;

use App\Models\Bloodgroup;
use Livewire\Component;
use Livewire\WithPagination;

class BloodGroupMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $blood_group_id;


    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required|unique:bloodgroups',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Bloodgroup::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Blood Group Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $blood_group_id)
    {
        $bloodgroup = Bloodgroup::find($blood_group_id);
        if ($bloodgroup) {
            $this->blood_group_id = $bloodgroup->id;
            $this->name = $bloodgroup->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Bloodgroup::where('id', $this->blood_group_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Blood Group Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $blood_group_id)
    {
        $this->blood_group_id = $blood_group_id;
    }

    public function destroy()
    {
        Bloodgroup::find($this->blood_group_id)->delete();
        session()->flash('message', 'Blood Group delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $bloodgroups = Bloodgroup::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.blood-group.blood-group-master', ['bloodgroups' => $bloodgroups])->extends('layouts.admin')->section('content');
    }
}
