<?php

namespace App\Http\Livewire\Ot\PreOperationCheckList;

use App\Models\Bloodgroup;
use App\Models\OtPreOperation;
use App\Models\OtPreOperationCheckList;
use App\Models\OtPreOperationPatientCheckList;
use App\Models\Patient;
use App\Models\Service\Service;
use Carbon\Carbon;
use Livewire\Component;

class PreOperationCheckListEdit extends Component
{
    public $ot_pre_operation_checklist_id;
    public $ot_pre_operation_id, $check_list_no, $check_list_date, $status = "Not Approved";
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $pre_operartion_no, $pre_operartion_date, $service_id, $service_code, $surgery_date, $blood_group_id, $weight, $height, $last_food_date, $last_fluid_date;
    public $escort_nurse, $theater_nurse;

    public $name_and_hospital_number_on_wrist_band, $surgery_consent_form_completed_and_signed_by_patient_and_wintess, $pre_medication_given_as_ordered_and_time_given;
    public $correct_area_shaved_and_prepared, $weight_trp_bp_recorded_and_allergies_listed, $dentures_removed_or_accompanying_the_patient, $xrays_ct_scan_and_mri_films_other_reports_sent_including_hiv_hbsag_hsv_and_hcv;
    public $total_no_of_films_sent_to_ot, $x_rays, $ct, $mri, $bath_given, $nail_polish_removed, $hair_clips_removed, $jewellery_removed, $contact_lens_removed, $hearing_aid_must_goto_theatre;
    public $rings_nose_and_ear_studs_taped, $false_eye_mention_which_side, $eye_mention_side;
    public $is_old_notes, $old_notes, $is_other_prostheses_specify_if_any, $other_prostheses_specify_if_any, $is_urine_passed_time_and_volume, $urine_passed_time, $urine_passed_volume;

    public $activeTab = 'surgery-details';

    public $patients = [];
    public $services = [];
    public $blood_groups = [];

    public function mount($id)
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->blood_groups = Bloodgroup::get();

        $ot_pre_operation_checklist = OtPreOperationCheckList::find($id);
        if ($ot_pre_operation_checklist) {
            $this->ot_pre_operation_checklist_id = $ot_pre_operation_checklist->id;
            $this->check_list_no = $ot_pre_operation_checklist->code;
            $this->check_list_date = date("Y-m-d H:i", strtotime($ot_pre_operation_checklist->created_at));
            $this->status = "Approved";

            $this->ipd_id = $ot_pre_operation_checklist->ipd_id;
            $this->patient_id = $ot_pre_operation_checklist->patient_id;
            $this->umr = $ot_pre_operation_checklist?->patient?->registration_no;

            $patient = Patient::where("registration_no", $this->umr)->first();
            if ($patient) {
                $this->patient_name = $patient?->name;
                $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
                $this->gender = $patient?->gender?->name;
                $this->patient_type = $patient?->patienttype?->name;

                $ipd = $patient->ipds()->where("id", $this->ipd_id)->latest()->first();
                $this->ipd_id = $ipd->id;
                $this->admn_no = $ipd->ipdcode;
                $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
                $this->ward = $ipd->ward?->name;
                $this->room = $ipd->room?->name;
                $this->bed = $ipd->bed?->display_name;

                $this->consultant_name = $ipd->patient_visit?->doctor?->name;
                $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
                $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            }

            $this->ot_pre_operation_id = $ot_pre_operation_checklist->ot_pre_operation_id;
            $this->pre_operartion_no = $ot_pre_operation_checklist?->ot_pre_operation?->code;
            $this->pre_operartion_date = date("Y-m-d H:i", strtotime($ot_pre_operation_checklist?->ot_pre_operation?->created_at));
            $this->service_id = $ot_pre_operation_checklist->service_id;
            $this->serviceChanged();
            $this->surgery_date = date("Y-m-d", strtotime($ot_pre_operation_checklist->surgery_date));
            $this->blood_group_id = $ot_pre_operation_checklist->bloodgroup_id;
            $this->weight = $ot_pre_operation_checklist->weight;
            $this->height = $ot_pre_operation_checklist->height;
            $this->last_food_date = date("Y-m-d H:i", strtotime($ot_pre_operation_checklist->last_food_date));
            $this->last_fluid_date = date("Y-m-d H:i", strtotime($ot_pre_operation_checklist->last_fluid_date));
            $this->escort_nurse = $ot_pre_operation_checklist->escort_nurse;
            $this->theater_nurse = $ot_pre_operation_checklist->theater_nurse;

            // Patient CheckList Details
            $this->name_and_hospital_number_on_wrist_band = $ot_pre_operation_checklist?->patient_checklist?->name_and_hospital_number_on_wrist_band;
            $this->surgery_consent_form_completed_and_signed_by_patient_and_wintess = $ot_pre_operation_checklist?->patient_checklist?->surgery_consent_form_completed_and_signed_by_patient_and_wintess;
            $this->pre_medication_given_as_ordered_and_time_given = $ot_pre_operation_checklist?->patient_checklist?->pre_medication_given_as_ordered_and_time_given;
            $this->correct_area_shaved_and_prepared = $ot_pre_operation_checklist?->patient_checklist?->correct_area_shaved_and_prepared;
            $this->weight_trp_bp_recorded_and_allergies_listed = $ot_pre_operation_checklist?->patient_checklist?->weight_trp_bp_recorded_and_allergies_listed;
            $this->dentures_removed_or_accompanying_the_patient = $ot_pre_operation_checklist?->patient_checklist?->dentures_removed_or_accompanying_the_patient;
            $this->xrays_ct_scan_and_mri_films_other_reports_sent_including_hiv_hbsag_hsv_and_hcv = $ot_pre_operation_checklist?->patient_checklist?->xrays_ct_scan_and_mri_films_other_report;
            $this->total_no_of_films_sent_to_ot = $ot_pre_operation_checklist?->patient_checklist?->total_no_of_films_sent_to_ot;

            $this->x_rays = $ot_pre_operation_checklist?->patient_checklist?->x_rays;
            $this->ct = $ot_pre_operation_checklist?->patient_checklist?->ct;
            $this->mri = $ot_pre_operation_checklist?->patient_checklist?->mri;

            $this->bath_given = $ot_pre_operation_checklist?->patient_checklist?->bath_given;
            $this->nail_polish_removed = $ot_pre_operation_checklist?->patient_checklist?->nail_polish_removed;
            $this->hair_clips_removed = $ot_pre_operation_checklist?->patient_checklist?->hair_clips_removed;
            $this->jewellery_removed = $ot_pre_operation_checklist?->patient_checklist?->jewellery_removed;
            $this->contact_lens_removed = $ot_pre_operation_checklist?->patient_checklist?->contact_lens_removed;
            $this->hearing_aid_must_goto_theatre = $ot_pre_operation_checklist?->patient_checklist?->hearing_aid_must_goto_theatre;
            $this->rings_nose_and_ear_studs_taped = $ot_pre_operation_checklist?->patient_checklist?->rings_nose_and_ear_studs_taped;
            $this->false_eye_mention_which_side = $ot_pre_operation_checklist?->patient_checklist?->false_eye_mention_which_side;
            $this->eye_mention_side = $ot_pre_operation_checklist?->patient_checklist?->eye_mention_side;
            $this->is_old_notes = $ot_pre_operation_checklist?->patient_checklist?->is_old_notes;
            $this->old_notes = $ot_pre_operation_checklist?->patient_checklist?->old_notes;
            $this->is_other_prostheses_specify_if_any = $ot_pre_operation_checklist?->patient_checklist?->is_other_prostheses_specify_if_any;
            $this->other_prostheses_specify_if_any = $ot_pre_operation_checklist?->patient_checklist?->other_prostheses_specify_if_any;
            $this->is_urine_passed_time_and_volume = $ot_pre_operation_checklist?->patient_checklist?->is_urine_passed_time_and_volume;
            $this->urine_passed_time = $ot_pre_operation_checklist?->patient_checklist?->urine_passed_time;
            $this->urine_passed_volume = $ot_pre_operation_checklist?->patient_checklist?->urine_passed_volume;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;

            $this->consultant_name = $ipd->patient_visit?->doctor?->name;
            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;

            $pre_operartion = OtPreOperation::where("ipd_id", $this->ipd_id)->where("patient_id", $this->patient_id)->latest()->first();
            if ($pre_operartion) {
                $this->ot_pre_operation_id = $pre_operartion->id;
                $this->pre_operartion_no = $pre_operartion->code;
                $this->pre_operartion_date = date("Y-m-d H:i", strtotime($pre_operartion->created_at));
                $this->service_id = $pre_operartion->service_id;
                $this->service_code = $pre_operartion?->service?->code;
                $this->surgery_date = date("Y-m-d", strtotime($pre_operartion->surgery_date));
            } else {
                $this->ot_pre_operation_id = null;
                $this->pre_operartion_no = null;
                $this->pre_operartion_date = null;
                $this->service_id = null;
                $this->service_code = null;
                $this->surgery_date = null;
            }
        }
    }

    public function serviceChanged()
    {
        $service = Service::find($this->service_id);
        if ($service) {
            $this->service_code = $service->code;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function rules()
    {
        return [
            "ot_pre_operation_id" => "required",
            'umr' => 'required',
            'patient_id' => 'required',
            'admn_no' => 'required',
            'ipd_id' => 'required',
            'service_id' => 'required',
            'service_code' => 'required',
            'blood_group_id' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'escort_nurse' => 'required',
            'theater_nurse' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $ot_pre_operation_checklist = OtPreOperationCheckList::find($this->ot_pre_operation_checklist_id);

        if ($ot_pre_operation_checklist) {
            $ot_pre_operation_checklist->update([
                "ot_pre_operation_id" => $this->ot_pre_operation_id,
                "ipd_id" => $this->ipd_id,
                "patient_id" => $this->patient_id,
                "service_id" => $this->service_id,
                "surgery_date" => $this->surgery_date,
                "bloodgroup_id" => $this->blood_group_id,
                "weight" => $this->weight,
                "height" => $this->height,
                "last_food_date" => $this->last_food_date,
                "last_fluid_date" => $this->last_fluid_date,
                "escort_nurse" => $this->escort_nurse,
                "theater_nurse" => $this->theater_nurse,
            ]);

            OtPreOperationPatientCheckList::where("ot_pre_operation_check_list_id", $this->ot_pre_operation_checklist_id)->update([
                'name_and_hospital_number_on_wrist_band' => $this->name_and_hospital_number_on_wrist_band ?? false,
                'surgery_consent_form_completed_and_signed_by_patient_and_wintess' => $this->surgery_consent_form_completed_and_signed_by_patient_and_wintess ?? false,
                'pre_medication_given_as_ordered_and_time_given' => $this->pre_medication_given_as_ordered_and_time_given ?? false,
                'correct_area_shaved_and_prepared' => $this->correct_area_shaved_and_prepared ?? false,
                'weight_trp_bp_recorded_and_allergies_listed' => $this->weight_trp_bp_recorded_and_allergies_listed ?? false,
                'dentures_removed_or_accompanying_the_patient' => $this->dentures_removed_or_accompanying_the_patient ?? false,
                'xrays_ct_scan_and_mri_films_other_report' => $this->xrays_ct_scan_and_mri_films_other_reports_sent_including_hiv_hbsag_hsv_and_hcv ?? false,
                'total_no_of_films_sent_to_ot' => $this->total_no_of_films_sent_to_ot ?? false,
                'x_rays' => $this->x_rays,
                'ct' => $this->ct,
                'mri' => $this->mri,

                'bath_given' => $this->bath_given ?? false,
                'nail_polish_removed' => $this->nail_polish_removed ?? false,
                'hair_clips_removed' => $this->hair_clips_removed ?? false,
                'jewellery_removed' => $this->jewellery_removed ?? false,
                'contact_lens_removed' => $this->contact_lens_removed ?? false,
                'hearing_aid_must_goto_theatre' => $this->hearing_aid_must_goto_theatre ?? false,
                'rings_nose_and_ear_studs_taped' => $this->rings_nose_and_ear_studs_taped ?? false,
                'false_eye_mention_which_side' => $this->false_eye_mention_which_side ?? false,
                'eye_mention_side' => $this->eye_mention_side,

                'is_old_notes' => $this->is_old_notes ?? false,
                'old_notes' => $this->old_notes,

                'is_other_prostheses_specify_if_any' => $this->is_other_prostheses_specify_if_any ?? false,
                'other_prostheses_specify_if_any' => $this->other_prostheses_specify_if_any,

                'is_urine_passed_time_and_volume' => $this->is_urine_passed_time_and_volume ?? false,
                'urine_passed_time' => $this->urine_passed_time,
                'urine_passed_volume' => $this->urine_passed_volume,
            ]);

            session()->flash('message', 'Pre Operation CheckList Updated Successfully.');
            return redirect()->route('admin.ot.pre-operation-checklist');
        }
    }

    public function render()
    {
        return view('livewire.ot.pre-operation-check-list.pre-operation-check-list-edit')->extends('layouts.admin')->section('content');
    }
}
