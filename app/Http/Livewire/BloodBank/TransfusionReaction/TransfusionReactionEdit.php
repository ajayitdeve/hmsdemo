<?php

namespace App\Http\Livewire\BloodBank\TransfusionReaction;

use App\Models\Bloodgroup;
use App\Models\BloodRequisitionRequest;
use App\Models\CostCenter;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Title;
use App\Models\TransfusionReaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransfusionReactionEdit extends Component
{
    public $transfusion_reaction_id, $type = "in-patient", $patient_id, $umr, $title_id, $patient_name, $age, $gender_id, $ipd_id, $admn_no, $mobile, $address, $out_side_patient_id;
    public $ward, $room, $bed, $corporate_code, $corporate_name, $cost_center_id, $blood_requisition_request_id;
    public $transfusion_no, $date_of_issue, $name_of_uc, $bloodgroup_id, $compatible_with_unit_no, $date_of_collection, $date_of_expiry;
    public $date_of_supply, $time_of_supply, $remarks_for_blood_bank, $remarks_for_nurse;

    public $pre_se, $during_se, $post_se;
    public $pre_resp, $during_resp, $post_resp;
    public $pre_temp, $during_temp, $post_temp;
    public $pre_bp, $during_bp, $post_bp;
    public $pre_rigor, $during_rigor, $post_rigor;
    public $pre_chims, $during_chims, $post_chims;
    public $pre_myalgia, $during_myalgia, $post_myalgia;
    public $pre_untians, $during_untians, $post_untians;
    public $pre_other_observation, $during_other_observation, $post_other_observation;

    public $titles = [];
    public $genders = [];
    public $patients = [];
    public $ipds = [];
    public $cost_centers = [];
    public $blood_groups = [];
    public $blood_requisitions = [];

    public function mount($id)
    {
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->cost_centers = CostCenter::get();
        $this->blood_groups = Bloodgroup::get();
        $this->blood_requisitions = BloodRequisitionRequest::latest()->get();

        $transfusion_reaction = TransfusionReaction::find($id);
        if ($transfusion_reaction) {
            $this->transfusion_reaction_id = $transfusion_reaction->id;
            $this->ipd_id = $transfusion_reaction->ipd_id;
            $this->patient_id = $transfusion_reaction->patient_id;

            if ($this->ipd_id) {
                $this->umr = $transfusion_reaction?->ipd?->patient?->registration_no;
                $this->patient_name = $transfusion_reaction?->ipd?->patient?->name;
                $this->title_id = $transfusion_reaction?->ipd?->patient?->title_id;
                $this->gender_id = $transfusion_reaction?->ipd?->patient?->gender_id;
                $this->age = Carbon::parse($transfusion_reaction?->ipd?->patient?->dob)->diff(Carbon::now())->format('%y');
                $this->admn_no = $transfusion_reaction?->ipd?->ipdcode;
                $this->ward = $transfusion_reaction?->ipd?->ward?->name;
                $this->room = $transfusion_reaction?->ipd?->room?->name;
                $this->bed = $transfusion_reaction?->ipd?->bed?->display_name;

                $this->corporate_code = $transfusion_reaction?->ipd?->corporate_registration?->organization?->code;
                $this->corporate_name = $transfusion_reaction?->ipd?->corporate_registration?->organization?->name;
            }

            $this->blood_requisition_request_id = $transfusion_reaction?->blood_requisition_request_id;
            $this->cost_center_id = $transfusion_reaction->cost_center_id;
            $this->transfusion_no = $transfusion_reaction->code;
            $this->date_of_issue = $transfusion_reaction->date_of_issue ? date("Y-m-d H:i:s", strtotime($transfusion_reaction->date_of_issue)) : null;
            $this->name_of_uc = $transfusion_reaction->name_of_uc;
            $this->bloodgroup_id = $transfusion_reaction->bloodgroup_id;
            $this->compatible_with_unit_no = $transfusion_reaction->compatible_with_unit_no;
            $this->date_of_collection = $transfusion_reaction->date_of_collection ? date("Y-m-d", strtotime($transfusion_reaction->date_of_collection)) : null;
            $this->date_of_expiry = $transfusion_reaction->date_of_expiry ? date("Y-m-d", strtotime($transfusion_reaction->date_of_expiry)) : null;
            $this->date_of_supply = $transfusion_reaction->date_of_supply ? date("Y-m-d", strtotime($transfusion_reaction->date_of_supply)) : null;
            $this->time_of_supply = $transfusion_reaction->time_of_supply ? date("H:i", strtotime($transfusion_reaction->time_of_supply)) : null;
            $this->remarks_for_blood_bank = $transfusion_reaction->remarks_for_blood_bank;
            $this->remarks_for_nurse = $transfusion_reaction->remarks_for_nurse;

            $this->pre_se = $transfusion_reaction?->pre_se;
            $this->during_se = $transfusion_reaction?->during_se;
            $this->post_se = $transfusion_reaction?->post_se;
            $this->pre_resp = $transfusion_reaction?->pre_resp;
            $this->during_resp = $transfusion_reaction?->during_resp;
            $this->post_resp = $transfusion_reaction?->post_resp;
            $this->pre_temp = $transfusion_reaction?->pre_temp;
            $this->during_temp = $transfusion_reaction?->during_temp;
            $this->post_temp = $transfusion_reaction?->post_temp;
            $this->pre_bp = $transfusion_reaction?->pre_bp;
            $this->during_bp = $transfusion_reaction?->during_bp;
            $this->post_bp = $transfusion_reaction?->post_bp;
            $this->pre_rigor = $transfusion_reaction?->pre_rigor;
            $this->during_rigor = $transfusion_reaction?->during_rigor;
            $this->post_rigor = $transfusion_reaction?->post_rigor;
            $this->pre_chims = $transfusion_reaction?->pre_chims;
            $this->during_chims = $transfusion_reaction?->during_chims;
            $this->post_chims = $transfusion_reaction?->post_chims;
            $this->pre_myalgia = $transfusion_reaction?->pre_myalgia;
            $this->during_myalgia = $transfusion_reaction?->during_myalgia;
            $this->post_myalgia = $transfusion_reaction?->post_myalgia;
            $this->pre_untians = $transfusion_reaction?->pre_untians;
            $this->during_untians = $transfusion_reaction?->during_untians;
            $this->post_untians = $transfusion_reaction?->post_untians;
            $this->pre_other_observation = $transfusion_reaction?->pre_other_observation;
            $this->during_other_observation = $transfusion_reaction?->during_other_observation;
            $this->post_other_observation = $transfusion_reaction?->post_other_observation;
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_id = $ipd?->patient?->id;
            $this->patient_name = $ipd?->patient?->name;
            $this->title_id = $ipd?->patient?->title_id;
            $this->gender_id = $ipd?->patient?->gender_id;
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y');
            $this->admn_no = $ipd?->ipdcode;

            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient?->name;
            $this->title_id = $patient->title_id;
            $this->gender_id = $patient->gender_id;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y');

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->admn_no = $ipd->ipdcode;

            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;

            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
        }
    }

    public function bloodRequisitionRequestChanged()
    {
        $blood_requisition_request = BloodRequisitionRequest::find($this->blood_requisition_request_id);
        if ($blood_requisition_request) {
            $this->bloodgroup_id = $blood_requisition_request->bloodgroup_id;

            if ($blood_requisition_request->ipd_id) {
                $this->ipd_id = $blood_requisition_request->ipd_id;
                $this->ipdChanged();
            }
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function rules()
    {
        return [
            'umr' => 'required',
            'patient_id' => 'required',
            'ipd_id' => 'required|unique:transfusion_reactions,ipd_id,' . $this->transfusion_reaction_id,
            'cost_center_id' => 'required',
            'name_of_uc' => 'nullable|string|max:100',
            'transfusion_no' => 'required',
            'date_of_issue' => 'nullable|date',
            'compatible_with_unit_no' => 'nullable|string|max:100',
            'date_of_collection' => 'nullable|date',
            'date_of_expiry' => 'nullable|date',
            'date_of_supply' => 'nullable|date',
            'time_of_supply' => 'nullable|date_format:H:i',
            'bloodgroup_id' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->type == 'outside-patient') {
            $out_side_patient = OutSidePatient::find($this->out_side_patient_id);
            if ($out_side_patient) {
                $out_side_patient->update([
                    'name' => $this->patient_name,
                    'mobile' => $this->mobile,
                    'age' => $this->age,
                    'address' => $this->address,
                    'title_id' => $this->title_id,
                    'gender_id' => $this->gender_id,
                ]);
            }
        }

        $transfusion_reaction = TransfusionReaction::find($this->transfusion_reaction_id);
        if ($transfusion_reaction) {
            $transfusion_reaction->update([
                'ipd_id' => $this->ipd_id ?? null,
                'patient_id' => $this->patient_id ?? null,
                'type' => $this->type,
                'out_side_patient_id' => $this->out_side_patient_id,
                'blood_requisition_request_id' => $this->blood_requisition_request_id ?? null,
                'cost_center_id' => $this->cost_center_id ?? null,
                'date_of_issue' => $this->date_of_issue ? date("Y-m-d H:i:s", strtotime($this->date_of_issue)) : null,
                'name_of_uc' => $this->name_of_uc ?? null,
                'bloodgroup_id' => $this->bloodgroup_id ?? null,
                'compatible_with_unit_no' => $this->compatible_with_unit_no ?? null,
                'date_of_collection' => $this->date_of_collection ? date("Y-m-d", strtotime($this->date_of_collection)) : null,
                'date_of_expiry' => $this->date_of_expiry ? date("Y-m-d", strtotime($this->date_of_expiry)) : null,
                'date_of_supply' => $this->date_of_supply ? date("Y-m-d", strtotime($this->date_of_supply)) : null,
                'time_of_supply' => $this->time_of_supply ? date("H:i:s", strtotime($this->time_of_supply)) : null,
                'remarks_for_blood_bank' => $this->remarks_for_blood_bank ?? null,
            ]);

            $transfusion_reaction->update([
                'pre_se' => $this->pre_se ?? null,
                'during_se' => $this->during_se ?? null,
                'post_se' => $this->post_se ?? null,
                'pre_resp' => $this->pre_resp ?? null,
                'during_resp' => $this->during_resp ?? null,
                'post_resp' => $this->post_resp ?? null,
                'pre_temp' => $this->pre_temp ?? null,
                'during_temp' => $this->during_temp ?? null,
                'post_temp' => $this->post_temp ?? null,
                'pre_bp' => $this->pre_bp ?? null,
                'during_bp' => $this->during_bp ?? null,
                'post_bp' => $this->post_bp ?? null,
                'pre_rigor' => $this->pre_rigor ?? null,
                'during_rigor' => $this->during_rigor ?? null,
                'post_rigor' => $this->post_rigor ?? null,
                'pre_chims' => $this->pre_chims ?? null,
                'during_chims' => $this->during_chims ?? null,
                'post_chims' => $this->post_chims ?? null,
                'pre_myalgia' => $this->pre_myalgia ?? null,
                'during_myalgia' => $this->during_myalgia ?? null,
                'post_myalgia' => $this->post_myalgia ?? null,
                'pre_untians' => $this->pre_untians ?? null,
                'during_untians' => $this->during_untians ?? null,
                'post_untians' => $this->post_untians ?? null,
                'pre_other_observation' => $this->pre_other_observation ?? null,
                'during_other_observation' => $this->during_other_observation ?? null,
                'post_other_observation' => $this->post_other_observation ?? null,
                'remarks_for_nurse' => $this->remarks_for_nurse ?? null,
                'updated_by_id' => auth()->user()?->id,
            ]);

            session()->flash('message', 'Transfusion Reaction Updated Successfully.');
            return redirect()->route('admin.transfusion-reaction');
        }

        session()->flash('error', 'Soemthing went wrong, Please try again.');
    }
    public function render()
    {
        return view('livewire.blood-bank.transfusion-reaction.transfusion-reaction-edit')->extends('layouts.admin')->section('content');
    }
}
