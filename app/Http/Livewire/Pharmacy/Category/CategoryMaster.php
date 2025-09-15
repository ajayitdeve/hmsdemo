<?php

namespace App\Http\Livewire\Pharmacy\Category;

use App\Models\Category;
use App\Models\CostCenter;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $type_id = 1, $cost_center_id = 1, $category_id, $types = [], $costcenters = [];

    public function mount()
    {
        $this->costcenters = CostCenter::get();
        $this->types = Type::get();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'type_id' => 'required',
            'cost_center_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        // dd($validatedData);
        Category::create($validatedData);

        session()->flash('message', 'Category Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $category_id)
    {
        $this->category_id = $category_id;
        $category = Category::find($category_id);
        if ($category) {
            $this->name = $category->name;
            $this->type_id = $category->type_id;
            $this->cost_center_id = $category->cost_center_id;
        } else {
        }
    }

    public function update()
    {

        $validatedData = $this->validate();
        category::where('id', $this->category_id)->update([
            'name' => $validatedData['name'],
            'type_id' => $validatedData['type_id'],
            'cost_center_id' => $validatedData['cost_center_id']
        ]);
        session()->flash('message', ' Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroy()
    {
        $category = Category::find($this->category_id)->delete();
        session()->flash('message', 'category delete Successfully.');
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
        $categories = Category::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.pharmacy.category.category-master', ['categories' => $categories])->extends('layouts.admin')->section('content');
    }
}
