<?php

namespace App\Http\Livewire\Master\BagType;

use App\Models\BagType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class BagTypeMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $bag_type_id, $name, $code;

    public function mount()
    {
        $this->code = 'BT' . BagType::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('bag_types')->ignore($this->bag_type_id),
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

        BagType::create([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => '1',
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Bag Type Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $bag_type = BagType::find($id);
        if ($bag_type) {
            $this->bag_type_id = $bag_type->id;
            $this->name = $bag_type->name;
            $this->code = $bag_type->code;
        }
    }

    public function update()
    {
        $this->validate();

        BagType::where('id', $this->bag_type_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Bag Type Updated Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->bag_type_id = $id;
    }

    public function destroy()
    {
        BagType::where('id', $this->bag_type_id)->delete();
        session()->flash('message', 'Bag Type Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $bag_types = BagType::latest()->paginate(10);

        return view('livewire.master.bag-type.bag-type-master', compact('bag_types'))->extends('layouts.admin')->section('content');
    }
}
