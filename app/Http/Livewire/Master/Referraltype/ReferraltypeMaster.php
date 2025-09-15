<?php

namespace App\Http\Livewire\Master\Referraltype;

use Livewire\WithPagination;
use App\Models\ReferralType;
use Livewire\Component;

class ReferraltypeMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $referraltype_id;



    protected function rules()
    {
        return [
            'name' => 'required|unique:referral_types',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $validatedData = $this->validate();
        ReferralType::create($validatedData);

        session()->flash('message', 'Title Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $referraltype_id)
    {
        $referraltype = ReferralType::find($referraltype_id);
        if ($referraltype) {
            $this->referraltype_id = $referraltype_id;
            $this->name = $referraltype->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        ReferralType::where('id', $this->referraltype_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Title Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function deleteTitle(int $student_id)
    {
        $this->referraltype_id = $student_id;
    }

    public function destroy()
    {
        $title = ReferralType::find($this->referraltype_id)->delete();
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
    }
    public function render()
    {
        $referraltypes = ReferralType::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.referraltype.referraltype-master', ['titles' => $referraltypes])->extends('layouts.admin')->section('content');
    }
}
