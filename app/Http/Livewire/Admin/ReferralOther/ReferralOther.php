<?php

namespace App\Http\Livewire\Admin\ReferralOther;

use App\Models\Other;
use Livewire\Component;
use Livewire\WithPagination;

class ReferralOther extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $other_id;

    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required|unique:others',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Other::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Referral-Other Added Successfully.');
        $this->reset(["name", "other_id"]);
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $other_id)
    {
        $other = Other::find($other_id);
        if ($other) {
            $this->other_id = $other->id;
            $this->name = $other->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Other::where('id', $this->other_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Referral-Other Edited Successfully.');
        $this->reset(["name", "other_id"]);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $other_id)
    {
        $this->other_id = $other_id;
    }

    public function destroy()
    {
        Other::find($this->other_id)->delete();
        session()->flash('message', 'Referral-Other delete Successfully.');
        $this->reset(["name", "other_id"]);
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $others = Other::latest()->paginate(10);
        return view('livewire.admin.referral-other.referral-other', ['others' => $others])->extends('layouts.admin')->section('content');;
    }
}
