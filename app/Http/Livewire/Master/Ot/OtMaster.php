<?php

namespace App\Http\Livewire\Master\Ot;

use App\Models\CostCenter;
use App\Models\Ot;
use App\Models\OtType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class OtMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $ot_id, $name, $code, $ot_type_id, $cost_center_id;

    public $ot_types = [];
    public $cost_centers = [];

    public function mount()
    {
        $this->generate_code();
        $this->ot_types = OtType::get();
        $this->cost_centers = CostCenter::latest()->get();
        $this->cost_center_id = CostCenter::latest()->first()?->id;
    }

    public function generate_code()
    {
        $this->code = 'OPT' . Ot::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('ots')->ignore($this->ot_id),
            ],
            'code' => 'required',
            'ot_type_id' => 'required',
            'cost_center_id' => 'required',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        Ot::create([
            'name' => $this->name,
            'code' => $this->code,
            'ot_type_id' => $this->ot_type_id,
            'is_active' => '1',
            'cost_center_id' => $this->cost_center_id,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'OT Added Successfully.');
        $this->reset(['ot_id', 'name', 'code', 'ot_type_id', 'cost_center_id']);
        $this->generate_code();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $ot = Ot::find($id);
        if ($ot) {
            $this->ot_id = $ot->id;
            $this->name = $ot->name;
            $this->code = $ot->code;
            $this->ot_type_id = $ot->ot_type_id;
            $this->cost_center_id = $ot->cost_center_id;
        }
    }

    public function update()
    {
        $this->validate();

        Ot::where('id', $this->ot_id)->update([
            'name' => $this->name,
            'ot_type_id' => $this->ot_type_id,
            'cost_center_id' => $this->cost_center_id,
        ]);

        session()->flash('message', 'OT Updated Successfully.');
        $this->reset(['ot_id', 'name', 'code', 'ot_type_id', 'cost_center_id']);
        $this->generate_code();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->ot_id = $id;
    }

    public function destroy()
    {
        Ot::where('id', $this->ot_id)->delete();
        session()->flash('message', 'OT Deleted Successfully.');
        $this->reset(['ot_id', 'name', 'code', 'ot_type_id', 'cost_center_id']);
        $this->generate_code();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $ot_list = Ot::latest()->paginate(10);
        return view('livewire.master.ot.ot-master', compact('ot_list'))->extends('layouts.admin')->section('content');
    }
}
