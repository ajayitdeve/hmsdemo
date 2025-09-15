<?php

namespace App\Http\Livewire\Master\AdminType;

use App\Models\AdminType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTypeMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $admin_type_id;


    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('admin_types')->ignore($this->admin_type_id),
            ],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        AdminType::create($validatedData);

        session()->flash('message', 'Admin Type Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $admin_type_id)
    {
        $admin_type = AdminType::find($admin_type_id);
        if ($admin_type) {
            $this->admin_type_id = $admin_type_id;
            $this->name = $admin_type->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        AdminType::where('id', $this->admin_type_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Admin Type Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $admin_type_id)
    {
        $this->admin_type_id = $admin_type_id;
    }

    public function destroy()
    {
        AdminType::find($this->admin_type_id)->delete();
        session()->flash('message', 'Admin type delete Successfully.');
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
        $admin_types = AdminType::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.admin-type.admin-type-master', compact('admin_types'))->extends('layouts.admin')->section('content');
    }
}
