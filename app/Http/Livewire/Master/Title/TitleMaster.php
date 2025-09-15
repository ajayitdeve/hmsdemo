<?php

namespace App\Http\Livewire\Master\Title;

use App\Models\Gender;
use Livewire\WithPagination;

use App\Models\Title;
use Livewire\Component;
use Illuminate\Validation\Rule;


class TitleMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $title_id;
    public $gender_id;
    public $genders = [];


    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('titles')->ignore($this->title_id),
            ],
            'gender_id' => 'required',
        ];
    }

    public function mount()
    {
        $this->genders = Gender::get();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveTitle()
    {
        $validatedData = $this->validate();
        Title::create($validatedData);

        session()->flash('message', 'Title Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editTitle(int $title_id)
    {
        $title = Title::find($title_id);
        if ($title) {
            $this->title_id = $title_id;
            $this->name = $title->name;
            $this->gender_id = $title->gender_id;
        } else {
        }
    }

    public function updateTitle()
    {
        $validatedData = $this->validate();
        Title::where('id', $this->title_id)->update(['name' => $validatedData['name'], 'gender_id' => $validatedData['gender_id']]);
        session()->flash('message', 'Title Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function deleteTitle(int $title_id)
    {
        $this->title_id = $title_id;
    }

    public function destroyTitle()
    {
        Title::find($this->title_id)->delete();
        session()->flash('message', 'Title delete Successfully.');
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
        $this->gender_id = '';
    }

    public function render()
    {
        $titles = Title::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.title.title-master', ['titles' => $titles])->extends('layouts.admin')->section('content');
    }
}
