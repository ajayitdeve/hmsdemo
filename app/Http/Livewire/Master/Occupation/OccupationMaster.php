<?php

namespace App\Http\Livewire\Master\Occupation;

use Livewire\Component;
use App\Models\Occupation;
use Livewire\WithPagination;

class OccupationMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $occupation_id;

    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Occupation::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Occupation Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $occupation_id)
    {
        $occupation = Occupation::find($occupation_id);

        if ($occupation) {
            $this->occupation_id = $occupation->id;
            $this->name = $occupation->name;
        } else {
        }
    }

    public function update()
    {
        $this->validate();

        Occupation::where('id', $this->occupation_id)->update(['name' => $this->name]);
        session()->flash('message', 'Occupation Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $occupation_id)
    {
        $this->occupation_id = $occupation_id;
    }

    public function destroy()
    {
        Occupation::find($this->occupation_id)->delete();
        session()->flash('message', 'Occupation delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $occupations = Occupation::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.occupation.occupation-master', ['occupations' => $occupations])->extends('layouts.admin')->section('content');
    }
}
