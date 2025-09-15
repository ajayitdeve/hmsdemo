<?php

namespace App\Http\Livewire\Master;

use App\Models\EmployeeCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id, $name, $code;

    public function mount()
    {
        $this->code = 'DRG' . EmployeeCategory::max('id') + 1;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('employee_categories')->ignore($this->category_id),
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

        EmployeeCategory::create([
            'name' => $this->name,
            'code' => $this->code,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Category Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $category = EmployeeCategory::find($id);
        if ($category) {
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->code = $category->code;
        }
    }

    public function update()
    {
        $this->validate();

        EmployeeCategory::where('id', $this->category_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Category Updated Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->category_id = $id;
    }

    public function destroy()
    {
        EmployeeCategory::where('id', $this->category_id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories = EmployeeCategory::latest()->paginate(10);
        return view('livewire.master.category-master', compact('categories'))->extends('layouts.admin')->section('content');
    }
}
