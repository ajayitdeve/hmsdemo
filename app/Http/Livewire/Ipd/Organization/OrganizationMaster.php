<?php

namespace App\Http\Livewire\Ipd\Organization;

use App\Models\User;
use Livewire\Component;
use App\Models\CostCenter;
use App\Models\Pathology\Color;
use App\Models\Ipd\Organization;
use Illuminate\Support\Facades\Auth;

class OrganizationMaster extends Component
{
    public $cost_center_id, $code, $name, $gstcode, $pan, $tan, $color, $type = "I", $isactive = true, $isletterrequired = false, $effectedfrom, $effectedto, $clearancedays = 0, $contractdate;
    public $consultation_number, $consultation_days, $consultation_discount, $ip_org_percent = 100, $ip_emp_percent = 0, $op_org_percent = 100, $op_emp_percent = 0;
    public $remarks, $org_credit_limit, $contact_person_id, $created_by_id, $updated_by_id, $pharmacy = "Credit";
    public $address, $city, $state, $country, $pincode, $phone, $alt_phone, $email;

    public $colors = [], $users = [], $costCenters = [], $organizations = [];

    public function mount()
    {
        $this->code = $this->organizationCode();
        $this->colors = Color::get();
        $this->users = User::get();
        $this->costCenters = CostCenter::get();
        $this->organizations = Organization::get();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            // 'pan' => 'required',
            // 'tan' => 'required',
            'type' => 'required',
            'effectedfrom' => 'required',
            'effectedto' => 'required',
            'contractdate' => 'required',
            'contact_person_id' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function organizationCode()
    {
        $max_id = Organization::max("id");
        if ($max_id < 10) {
            return 'ORG00' . $max_id + 1;
        } else if ($max_id >= 10 && $max_id < 100) {
            return 'ORG0' . $max_id + 1;
        } else if ($max_id >= 100) {
            return 'ORG' . $max_id + 1;
        }
    }
    public function save()
    {
        $this->validate();

        $organization = new Organization([
            'cost_center_id' => $this->cost_center_id,
            'code' => $this->code,
            'name' => $this->name,
            'gstcode' => $this->gstcode,
            'pan' => $this->pan,
            'tan' => $this->tan,
            'color' => $this->color,
            'type' => $this->type,
            'isactive' => true,
            'isletterreqcoloruired' => $this->isletterrequired,
            'effectedfrom' => $this->effectedfrom,
            'effectedto' => $this->effectedto,
            'clearancedays' => $this->clearancedays ?? 0,
            'contractdate' => $this->contractdate,
            'consultation_number' => $this->consultation_number,
            'consultation_days' => $this->consultation_days,
            'consultation_discount' => $this->consultation_discount,
            'ip_org_percent' => $this->ip_org_percent,
            'ip_emp_percent' => $this->ip_emp_percent,
            'op_org_percent' => $this->op_org_percent,
            'op_emp_percent' => $this->op_emp_percent,
            'org_credit_limit' => $this->org_credit_limit,
            'contact_person_id' => $this->contact_person_id,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'pincode' => $this->pincode,
            'phone' => $this->phone,
            'alt_phobe' => $this->alt_phone,
            'remarks' => $this->remarks,
            'pharmacy' => $this->pharmacy,
            'created_by_id' => Auth::user()?->id,
            'updated_by_id' => Auth::user()?->id
        ]);

        $organization->save();

        return back()->with('success', 'Organization Created.');
    }
    public function render()
    {
        return view('livewire.ipd.organization.organization-master')->extends('layouts.admin')->section('content');
    }
}
