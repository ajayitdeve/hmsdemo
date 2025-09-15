<?php

namespace App\Http\Livewire\Ipd\CorporateRelation;

use App\Models\Ipd\CorporateRelation;
use Livewire\Component;
use Livewire\WithPagination;

class CorporateRelationMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $corporate_relation_id;

    protected function rules()
    {
        return [
            'name' => 'required|unique:corporate_relations',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        CorporateRelation::create($validatedData);

        session()->flash('message', 'Corporate Relation Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $corporate_relation_id)
    {
        $corporate_relation = CorporateRelation::find($corporate_relation_id);
        if ($corporate_relation) {
            $this->corporate_relation_id = $corporate_relation_id;
            $this->name = $corporate_relation->name;
        } else {

        }

    }

    public function update()
    {
        $validatedData = $this->validate();
        CorporateRelation::where('id', $this->corporate_relation_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Corporate Relation Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $corporate_relation_id)
    {
        $this->corporate_relation_id = $corporate_relation_id;
    }

    public function destroy()
    {
        CorporateRelation::find($this->corporate_relation_id)->delete();

        session()->flash('message', 'Corporate relation delete Successfully.');
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
        $corporate_relations = CorporateRelation::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.ipd.corporate-relation.corporate-relation-master', ['corporate_relations' => $corporate_relations])->extends('layouts.admin')->section('content');
    }
}
