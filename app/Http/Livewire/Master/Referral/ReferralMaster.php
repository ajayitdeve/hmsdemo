<?php

namespace App\Http\Livewire\Master\Referral;

use App\Models\Referral;
use App\Models\ReferralType;
use Livewire\Component;
use Livewire\WithPagination;

class ReferralMaster extends Component
{
    use WithPagination;
    public $referraltypes;
    public $referral_type_id, $name, $code, $alias, $ipdpercent, $opdpercent, $investigationpercent, $pan, $accountnumber;
    public $selectedrReferralTypeId;
    public function mount()
    {
        $this->referraltypes = ReferralType::get();
    }
    protected function rules()
    {
        return [
            'code' => 'required|unique:referrals',
            'alias' => 'required|unique:referrals',
            'name' => 'required',
            'referral_type_id' => 'required'
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $validatedData = $this->validate();
        $referral = new Referral;
        $referral->referral_type_id = $this->referral_type_id;
        $referral->name = $this->name;
        $referral->code = $this->code;
        $referral->alias = $this->alias;
        $referral->ipdpercent = $this->ipdpercent;
        $referral->opdpercent = $this->opdpercent;
        $referral->investigationpercent = $this->investigationpercent;
        $referral->pan = $this->pan;
        $referral->accountnumber = $this->accountnumber;
        $referral->save();



        session()->flash('message', 'Referral Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function resetInput()
    {
        $this->name = '';
        $this->referral_type_id = '';
        $this->code = '';
        $this->ipdpercent = '';
        $this->opdpercent = '';
        $this->investigationpercent = '';
        $this->pan = '';
        $this->accountnumber = '';
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function render()
    {
        $referrals = Referral::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.referral.referral-master', ['referrals' => $referrals])->extends('layouts.admin')->section('content');
    }
}
