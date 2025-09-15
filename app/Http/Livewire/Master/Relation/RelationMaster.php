<?php

namespace App\Http\Livewire\Master\Relation;

use App\Models\Relation;
use Livewire\Component;
use Livewire\WithPagination;

class RelationMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $relation_id;


    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required|unique:relations',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $this->validate();
        Relation::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Relation Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $relation_id)
    {
        $relation = Relation::find($relation_id);
        if ($relation) {
            $this->relation_id = $relation->id;
            $this->name = $relation->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Relation::where('id', $this->relation_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Relation Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $relation_id)
    {
        $this->relation_id = $relation_id;
    }

    public function destroy()
    {
        Relation::find($this->relation_id)->delete();
        session()->flash('message', 'Relation delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $relations = Relation::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.relation.relation-master', ['relations' => $relations])->extends('layouts.admin')->section('content');
    }
}
