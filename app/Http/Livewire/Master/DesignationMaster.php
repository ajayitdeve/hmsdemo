<?php

namespace App\Http\Livewire\Master;

use App\Models\Designation;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class DesignationMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $designation_id, $name, $code;

    public function mount()
    {
        $this->code = 'DES' . Designation::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('designations')->ignore($this->designation_id),
            ],
            'code' => ['required']
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        Designation::create([
            'name' => $this->name,
            'code' => $this->code,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Designation Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $designation = Designation::find($id);
        if ($designation) {
            $this->designation_id = $designation->id;
            $this->name = $designation->name;
            $this->code = $designation->code;
        }
    }

    public function update()
    {
        $this->validate();

        Designation::where('id', $this->designation_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Designation Updated Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->designation_id = $id;
    }

    public function destroy()
    {
        Designation::where('id', $this->designation_id)->delete();
        session()->flash('message', 'Designation Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $designations = Designation::latest()->paginate(10);
        return view('livewire.master.designation-master', compact('designations'))->extends('layouts.admin')->section('content');
    }
}
