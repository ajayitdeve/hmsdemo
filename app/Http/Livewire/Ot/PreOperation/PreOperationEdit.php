<?php

namespace App\Http\Livewire\Ot\PreOperation;

use App\Models\Ot;
use App\Models\OtBooking;
use App\Models\OtPreOperation;
use App\Models\OtPreOperationAnaesthesiaCheckFirstRecord;
use App\Models\OtPreOperationAnaesthesiaCheckSecondRecord;
use App\Models\OtPreOperationAttendant;
use App\Models\OtType;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Traits\OtAttendantUpdate;
use Carbon\Carbon;
use Livewire\Component;

class PreOperationEdit extends Component
{
    use OtAttendantUpdate;

    public $ot_pre_operation_id, $pre_operation_no, $pre_operation_date, $pre_operation_type = "scheduled-patients", $status = "Not Approved";
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $service_id, $service_code, $ot_booking_id, $ot_booking_no, $ot_booking_date, $surgery_type_id, $surgery_type_code, $surgery_date, $duration, $from_time, $to_time;
    public $ot_type_id, $ot_type_code, $ot_id, $ot_code, $ot_start_time, $estimated_time, $icd_code, $cpt_code, $op_diagnosis, $op_procedure;

    // Tab 1
    public $pacr1_date, $pacr1_height, $pacr1_weight, $pacr1_community, $pacr1_anaesthesia, $pacr1_bmi, $pacr1_dept, $pacr1_sx_plan, $pacr1_surgeon, $pacr1_risk_factors, $pacr1_allergy, $pacr1_current_drug_r;
    public $pacr1_sht, $pacr1_cad, $pacr1_post_cabg, $pacr1_post_ptca, $pacr1_post_dvt;
    public $pacr1_post_pre, $pacr1_dm, $pacr1_ba, $pacr1_copd, $pacr1_cva;
    public $pacr1_resp_infection, $pacr1_smoker, $pacr1_alcoholic, $pacr1_anticoagulant, $pacr1_osa, $pacr1_hyper_thyroid, $pacr1_hypothroid, $pacr1_obesity, $pacr1_fits, $pacr1_antiplatlet;
    public $pacr1_chronic_pain, $pacr1_long_term_steroid, $pacr1_antiepileptic;
    public $pacr1_ho_eventful_preoperative_period, $pacr1_ho_previous_sx, $pacr1_ho_eventful_anaesthesia, $pacr1_cough, $pacr1_wheezing, $pacr1_sputum, $pacr1_recent_lri_uri;
    public $pacr1_anaemia, $pacr1_jaundice, $pacr1_cyanosis, $pacr1_clubbing, $pacr1_pedal_edema;
    public $pacr1_airway_spine = '', $pacr1_ltd_mo, $pacr1_bucked_tooth, $pacr1_loose_tooth, $pacr1_denture, $pacr1_short_neck, $pacr1_receding_mandible, $pacr1_rnm;
    public $pacr1_hyphosis, $pacr1_adentulous, $pacr1_scoliosis, $pacr1_lordosis, $pacr1_others = '';

    // Tab 2
    public $pacr2_supine, $pacr2_supine_bp, $pacr2_supine_spo2, $pacr2_cvs, $pacr2_rs, $pacr2_pa, $pacr2_erect, $pacr2_erect_bp;
    public $pacr2_hb, $pacr2_tc, $pacr2_dc, $pacr2_esr, $pacr2_rbs, $pacr2_platlet, $pacr2_bt, $pacr2_pt, $pacr2_inr, $pacr2_aptt, $pacr2_lft, $pacr2_bi_urea, $pacr2_sr_creat;
    public $pacr2_ct, $pacr2_hiv, $pacr2_hbsag, $pacr2_hcv, $pacr2_s_electrolytes, $pacr2_blood_gr_rh_typing, $pacr2_ecg, $pacr2_echo, $pacr2_tft, $pacr2_pft, $pacr2_tmt;
    public $pacr2_abg, $pacr2_chest_xray, $pacr2_bill_venous_dopper_abg_for_both_ll, $pacr2_specialist_opinion_before_surgery, $pacr2_any_further_investigation_required_before_surgery;
    public $pacr2_blood_reserve, $pacr2_remarks, $pacr2_npo_for, $pacr2_pre_medication;

    public $activeTab = 'surgery-details';

    public $patients = [];
    public $services = [];
    public $surgery_types = [];
    public $ot_types = [];
    public $ot_list = [];

    public $arrCart = [];
    public $attendant_types = [];

    public function mount($id)
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();
        $this->ot_types = OtType::where("is_active", "1")->get();
        $this->ot_list = Ot::where("is_active", "1")->get();

        $ot_pre_operation = OtPreOperation::find($id);
        if ($ot_pre_operation) {
            $this->ot_pre_operation_id = $ot_pre_operation->id;
            $this->pre_operation_no = $ot_pre_operation->code;
            $this->pre_operation_date = date("Y-m-d H:i", strtotime($ot_pre_operation->created_at));

            $this->ipd_id = $ot_pre_operation->ipd_id;
            $this->patient_id = $ot_pre_operation->patient_id;
            $this->umr = $ot_pre_operation?->patient?->registration_no;

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

            $this->ot_booking_id = $ot_pre_operation->ot_booking_id;
            $this->ot_booking_no = $ot_pre_operation->ot_booking?->code;
            $this->ot_booking_date = date("Y-m-d H:i", strtotime($ot_pre_operation->ot_booking?->created_at));

            $this->pre_operation_type = $ot_pre_operation->type;
            $this->service_id = $ot_pre_operation->service_id;
            $this->serviceChanged();
            $this->surgery_type_id = $ot_pre_operation->surgery_type_id;
            $this->surgeryTypeChanged();
            $this->surgery_date = date("Y-m-d", strtotime($ot_pre_operation->surgery_date));
            $this->duration = $ot_pre_operation->duration;
            $this->from_time = date("H:i", strtotime($ot_pre_operation->from_time));
            $this->to_time = date("H:i", strtotime($ot_pre_operation->to_time));
            $this->ot_type_id = $ot_pre_operation->ot_type_id;
            $this->otTypeChanged();
            $this->ot_id = $ot_pre_operation->ot_id;
            $this->otChanged();
            $this->ot_start_time = date("Y-m-d H:i", strtotime($ot_pre_operation->ot_start_time));
            $this->estimated_time = date("Y-m-d H:i", strtotime($ot_pre_operation->estimated_time));
            $this->icd_code = $ot_pre_operation->icd_code;
            $this->cpt_code = $ot_pre_operation->cpt_code;
            $this->op_diagnosis = $ot_pre_operation->op_diagnosis;
            $this->op_procedure = $ot_pre_operation->op_procedure;

            $this->ot_pre_operation_attendant_init($ot_pre_operation);

            $anaesthesia_check_first_record = $ot_pre_operation?->anaesthesia_check_first_record;
            $this->pacr1_date = date("Y-m-d H:i", strtotime($anaesthesia_check_first_record?->date));
            $this->pacr1_height = $anaesthesia_check_first_record?->height;
            $this->pacr1_weight = $anaesthesia_check_first_record?->weight;
            $this->pacr1_bmi = $anaesthesia_check_first_record?->bmi;
            $this->pacr1_community = $anaesthesia_check_first_record?->community;
            $this->pacr1_anaesthesia = $anaesthesia_check_first_record?->anaesthesia;
            $this->pacr1_dept = $anaesthesia_check_first_record?->dept;
            $this->pacr1_sx_plan = $anaesthesia_check_first_record?->sx_plan;
            $this->pacr1_surgeon = $anaesthesia_check_first_record?->surgeon;
            $this->pacr1_risk_factors = $anaesthesia_check_first_record?->risk_factors;
            $this->pacr1_allergy = $anaesthesia_check_first_record?->allergy;
            $this->pacr1_current_drug_r = $anaesthesia_check_first_record?->current_drug_r;

            $this->pacr1_sht = $anaesthesia_check_first_record?->sht;
            $this->pacr1_cad = $anaesthesia_check_first_record?->cad;
            $this->pacr1_post_cabg = $anaesthesia_check_first_record?->post_cabg;
            $this->pacr1_post_ptca = $anaesthesia_check_first_record?->post_ptca;
            $this->pacr1_post_dvt = $anaesthesia_check_first_record?->post_dvt;
            $this->pacr1_post_pre = $anaesthesia_check_first_record?->post_pre;
            $this->pacr1_dm = $anaesthesia_check_first_record?->dm;
            $this->pacr1_ba = $anaesthesia_check_first_record?->ba;
            $this->pacr1_copd = $anaesthesia_check_first_record?->copd;
            $this->pacr1_cva = $anaesthesia_check_first_record?->cva;
            $this->pacr1_resp_infection = $anaesthesia_check_first_record?->resp_infection;
            $this->pacr1_smoker = $anaesthesia_check_first_record?->smoker;
            $this->pacr1_alcoholic = $anaesthesia_check_first_record?->alcoholic;
            $this->pacr1_anticoagulant = $anaesthesia_check_first_record?->anticoagulant;
            $this->pacr1_osa = $anaesthesia_check_first_record?->osa;
            $this->pacr1_hyper_thyroid = $anaesthesia_check_first_record?->hyper_thyroid;
            $this->pacr1_hypothroid = $anaesthesia_check_first_record?->hypothroid;
            $this->pacr1_obesity = $anaesthesia_check_first_record?->obesity;
            $this->pacr1_fits = $anaesthesia_check_first_record?->fits;
            $this->pacr1_antiplatlet = $anaesthesia_check_first_record?->antiplatlet;
            $this->pacr1_chronic_pain = $anaesthesia_check_first_record?->chronic_pain;
            $this->pacr1_long_term_steroid = $anaesthesia_check_first_record?->long_term_steroid;
            $this->pacr1_antiepileptic = $anaesthesia_check_first_record?->antiepileptic;

            $this->pacr1_ho_eventful_preoperative_period = $anaesthesia_check_first_record?->ho_eventful_preoperative_period;
            $this->pacr1_ho_previous_sx = $anaesthesia_check_first_record?->ho_previous_sx;
            $this->pacr1_ho_eventful_anaesthesia = $anaesthesia_check_first_record?->ho_eventful_anaesthesia;

            $this->pacr1_cough = $anaesthesia_check_first_record?->cough;
            $this->pacr1_wheezing = $anaesthesia_check_first_record?->wheezing;
            $this->pacr1_sputum = $anaesthesia_check_first_record?->sputum;
            $this->pacr1_recent_lri_uri = $anaesthesia_check_first_record?->recent_lri_uri;
            $this->pacr1_anaemia = $anaesthesia_check_first_record?->anaemia;
            $this->pacr1_jaundice = $anaesthesia_check_first_record?->jaundice;
            $this->pacr1_cyanosis = $anaesthesia_check_first_record?->cyanosis;
            $this->pacr1_clubbing = $anaesthesia_check_first_record?->clubbing;
            $this->pacr1_pedal_edema = $anaesthesia_check_first_record?->pedal_edema;

            $this->pacr1_airway_spine = $anaesthesia_check_first_record?->airway_spine;
            $this->pacr1_ltd_mo = $anaesthesia_check_first_record?->ltd_mo;
            $this->pacr1_bucked_tooth = $anaesthesia_check_first_record?->bucked_tooth;
            $this->pacr1_loose_tooth = $anaesthesia_check_first_record?->loose_tooth;
            $this->pacr1_denture = $anaesthesia_check_first_record?->denture;
            $this->pacr1_short_neck = $anaesthesia_check_first_record?->short_neck;
            $this->pacr1_receding_mandible = $anaesthesia_check_first_record?->receding_mandible;
            $this->pacr1_rnm = $anaesthesia_check_first_record?->rnm;
            $this->pacr1_hyphosis = $anaesthesia_check_first_record?->hyphosis;
            $this->pacr1_adentulous = $anaesthesia_check_first_record?->adentulous;
            $this->pacr1_scoliosis = $anaesthesia_check_first_record?->scoliosis;
            $this->pacr1_lordosis = $anaesthesia_check_first_record?->lordosis;
            $this->pacr1_others = $anaesthesia_check_first_record?->others;

            $anaesthesia_check_second_record = $ot_pre_operation?->anaesthesia_check_second_record;

            $this->pacr2_supine = $anaesthesia_check_second_record?->supine;
            $this->pacr2_supine_bp = $anaesthesia_check_second_record?->supine_bp;
            $this->pacr2_supine_spo2 = $anaesthesia_check_second_record?->supine_spo2;
            $this->pacr2_erect = $anaesthesia_check_second_record?->erect;
            $this->pacr2_erect_bp = $anaesthesia_check_second_record?->erect_bp;

            $this->pacr2_cvs = $anaesthesia_check_second_record?->cvs;
            $this->pacr2_rs = $anaesthesia_check_second_record?->rs;
            $this->pacr2_pa = $anaesthesia_check_second_record?->pa;

            $this->pacr2_hb = $anaesthesia_check_second_record?->hb;
            $this->pacr2_tc = $anaesthesia_check_second_record?->tc;
            $this->pacr2_dc = $anaesthesia_check_second_record?->dc;
            $this->pacr2_esr = $anaesthesia_check_second_record?->esr;
            $this->pacr2_rbs = $anaesthesia_check_second_record?->rbs;
            $this->pacr2_platlet = $anaesthesia_check_second_record?->platlet;
            $this->pacr2_bt = $anaesthesia_check_second_record?->bt;
            $this->pacr2_pt = $anaesthesia_check_second_record?->pt;
            $this->pacr2_inr = $anaesthesia_check_second_record?->inr;
            $this->pacr2_aptt = $anaesthesia_check_second_record?->aptt;
            $this->pacr2_lft = $anaesthesia_check_second_record?->lft;
            $this->pacr2_bi_urea = $anaesthesia_check_second_record?->bi_urea;
            $this->pacr2_sr_creat = $anaesthesia_check_second_record?->sr_creat;

            $this->pacr2_ct = $anaesthesia_check_second_record?->ct;
            $this->pacr2_hiv = $anaesthesia_check_second_record?->hiv;
            $this->pacr2_hbsag = $anaesthesia_check_second_record?->hbsag;
            $this->pacr2_hcv = $anaesthesia_check_second_record?->hcv;
            $this->pacr2_s_electrolytes = $anaesthesia_check_second_record?->s_electrolytes;
            $this->pacr2_blood_gr_rh_typing = $anaesthesia_check_second_record?->blood_gr_rh_typing;
            $this->pacr2_ecg = $anaesthesia_check_second_record?->ecg;
            $this->pacr2_echo = $anaesthesia_check_second_record?->echo;
            $this->pacr2_tft = $anaesthesia_check_second_record?->tft;
            $this->pacr2_pft = $anaesthesia_check_second_record?->pft;
            $this->pacr2_tmt = $anaesthesia_check_second_record?->tmt;
            $this->pacr2_abg = $anaesthesia_check_second_record?->abg;
            $this->pacr2_chest_xray = $anaesthesia_check_second_record?->chest_xray;
            $this->pacr2_bill_venous_dopper_abg_for_both_ll = $anaesthesia_check_second_record?->bill_venous_dopper_abg_for_both_ll;

            $this->pacr2_specialist_opinion_before_surgery = $anaesthesia_check_second_record?->specialist_opinion_before_surgery;
            $this->pacr2_any_further_investigation_required_before_surgery = $anaesthesia_check_second_record?->any_further_investigation_required_before_surgery;
            $this->pacr2_blood_reserve = $anaesthesia_check_second_record?->blood_reserve;
            $this->pacr2_remarks = $anaesthesia_check_second_record?->remarks;
            $this->pacr2_npo_for = $anaesthesia_check_second_record?->npo_for;
            $this->pacr2_pre_medication = $anaesthesia_check_second_record?->pre_medication;
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

            $ot_booking = OtBooking::where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->where("is_cancelled", 0)
                ->latest()
                ->first();

            if ($ot_booking) {
                $this->ot_booking_id = $ot_booking->id;
                $this->service_id = $ot_booking->service_id;
                $this->service_code = $ot_booking?->service?->code;
                $this->ot_booking_no = $ot_booking->code;
                $this->ot_booking_date = date("Y-m-d H:i", strtotime($ot_booking->created_at));
                $this->surgery_type_id = $ot_booking->surgery_type_id;
                $this->surgery_type_code = $ot_booking?->surgery_type?->code;
                $this->surgery_date = date("Y-m-d", strtotime($ot_booking->surgery_date));
                $this->duration = $ot_booking->duration;
                $this->from_time = date("H:i", strtotime($ot_booking->from_time));
                $this->to_time = date("H:i", strtotime($ot_booking->to_time));
                $this->ot_type_id = $ot_booking->ot_type_id;
                $this->ot_type_code = $ot_booking?->ot_type?->code;
                $this->ot_id = $ot_booking->ot_id;
                $this->ot_code = $ot_booking?->ot?->code;

                $this->ot_start_time = date("Y-m-d H:i", strtotime($ot_booking->surgery_date . " " . $ot_booking->from_time));
                $this->estimated_time = date("Y-m-d H:i", strtotime($ot_booking->surgery_date . " " . $ot_booking->to_time));

                $this->icd_code = $ot_booking->icd_code;
                $this->cpt_code = $ot_booking->cpt_code;

                $this->ot_booking_attendant_init($ot_booking);
            } else {
                $this->ot_booking_id = null;
                $this->service_id = null;
                $this->service_code = null;
                $this->ot_booking_no = null;
                $this->ot_booking_date = date("Y-m-d H:i");
                $this->surgery_type_id = null;
                $this->surgery_type_code = null;
                $this->surgery_date = date("Y-m-d");
                $this->duration = null;
                $this->from_time = null;
                $this->to_time = null;
                $this->ot_type_id = null;
                $this->ot_type_code = null;
                $this->ot_id = null;
                $this->ot_code = null;
                $this->ot_start_time = null;
                $this->estimated_time = null;
                $this->icd_code = null;
                $this->cpt_code = null;

                $this->arrCart = [];
                $this->addRow();
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

    public function surgeryTypeChanged()
    {
        $surgeryType = SurgeryType::find($this->surgery_type_id);
        if ($surgeryType) {
            $this->surgery_type_code = $surgeryType->code;
        }
    }

    public function otTypeChanged()
    {
        $otType = OtType::find($this->ot_type_id);
        if ($otType) {
            $this->ot_type_code = $otType->code;
        }
    }

    public function otChanged()
    {
        $ot = Ot::find($this->ot_id);
        if ($ot) {
            $this->ot_code = $ot->code;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    private function calculateBmi()
    {
        if ($this->pacr1_height && $this->pacr1_weight) {
            $heightInMeters = $this->pacr1_height / 100;
            $this->pacr1_bmi = round($this->pacr1_weight / ($heightInMeters * $heightInMeters), 2);
        } else {
            $this->pacr1_bmi = null;
        }
    }

    public function rules()
    {
        return [
            'ot_booking_no' => 'required',
            'umr' => 'required',
            'patient_id' => 'required',
            'admn_no' => 'required',
            'ipd_id' => 'required',
            'service_id' => 'required',
            'service_code' => 'required',
            'ot_type_id' => 'required',
            'ot_type_code' => 'required',
            'ot_id' => 'required',
            'ot_code' => 'required',
        ];
    }

    public function updated($fields)
    {
        if (in_array($fields, ['pacr1_height', 'pacr1_weight'])) {
            $this->calculateBmi();
        }

        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $ot_pre_operation = OtPreOperation::find($this->ot_pre_operation_id);
        if ($ot_pre_operation) {
            $ot_pre_operation->update([
                'ot_booking_id' => $this->ot_booking_id,
                'ipd_id' => $this->ipd_id,
                'patient_id' => $this->patient_id,
                'type' => $this->pre_operation_type,
                'service_id' => $this->service_id,
                'surgery_type_id' => $this->surgery_type_id,
                'surgery_date' => $this->surgery_date,
                'duration' => $this->duration,
                'from_time' => $this->from_time,
                'to_time' => $this->to_time,
                'ot_type_id' => $this->ot_type_id,
                'ot_id' => $this->ot_id,
                'ot_start_time' => $this->ot_start_time,
                'estimated_time' => $this->estimated_time,
                'icd_code' => $this->icd_code,
                'cpt_code' => $this->cpt_code,
                'op_diagnosis' => $this->op_diagnosis,
                'op_procedure' => $this->op_procedure,
            ]);

            OtPreOperationAttendant::where('ot_pre_operation_id', $this->ot_pre_operation_id)->delete();

            foreach ($this->arrCart as $attendant) {
                if (!empty($attendant['attendant_name']) && !empty($attendant['attendant_type']) && !empty($attendant['attendant_id'])) {
                    OtPreOperationAttendant::create([
                        'name' => $attendant['attendant_name'],
                        'attendant_type' => $attendant['attendant_type'],
                        'attendant_id' => $attendant['attendant_id'],
                        'ot_pre_operation_id' => $ot_pre_operation->id,
                    ]);
                }
            }

            OtPreOperationAnaesthesiaCheckFirstRecord::where('ot_pre_operation_id', $this->ot_pre_operation_id)->update([
                'date' => date("Y-m-d H:i:s", strtotime($this->pacr1_date)),
                'height' => $this->pacr1_height,
                'weight' => $this->pacr1_weight,
                'bmi' => $this->pacr1_bmi,
                'community' => $this->pacr1_community,
                'anaesthesia' => $this->pacr1_anaesthesia,
                'dept' => $this->pacr1_dept,
                'sx_plan' => $this->pacr1_sx_plan,
                'surgeon' => $this->pacr1_surgeon,
                'risk_factors' => $this->pacr1_risk_factors,
                'allergy' => $this->pacr1_allergy,
                'current_drug_r' => $this->pacr1_current_drug_r,

                'sht' => $this->pacr1_sht ?? 0,
                'cad' => $this->pacr1_cad ?? 0,
                'post_cabg' => $this->pacr1_post_cabg ?? 0,
                'post_ptca' => $this->pacr1_post_ptca ?? 0,
                'post_dvt' => $this->pacr1_post_dvt ?? 0,
                'post_pre' => $this->pacr1_post_pre ?? 0,
                'dm' => $this->pacr1_dm ?? 0,
                'ba' => $this->pacr1_ba ?? 0,
                'copd' => $this->pacr1_copd ?? 0,
                'cva' => $this->pacr1_cva ?? 0,
                'resp_infection' => $this->pacr1_resp_infection ?? 0,
                'smoker' => $this->pacr1_smoker ?? 0,
                'alcoholic' => $this->pacr1_alcoholic ?? 0,
                'anticoagulant' => $this->pacr1_anticoagulant ?? 0,
                'osa' => $this->pacr1_osa ?? 0,
                'hyper_thyroid' => $this->pacr1_hyper_thyroid ?? 0,
                'hypothroid' => $this->pacr1_hypothroid ?? 0,
                'obesity' => $this->pacr1_obesity ?? 0,
                'fits' => $this->pacr1_fits ?? 0,
                'antiplatlet' => $this->pacr1_antiplatlet ?? 0,
                'chronic_pain' => $this->pacr1_chronic_pain ?? 0,
                'long_term_steroid' => $this->pacr1_long_term_steroid ?? 0,
                'antiepileptic' => $this->pacr1_antiepileptic ?? 0,

                'ho_eventful_preoperative_period' => $this->pacr1_ho_eventful_preoperative_period ?? 0,
                'ho_previous_sx' => $this->pacr1_ho_previous_sx ?? 0,
                'ho_eventful_anaesthesia' => $this->pacr1_ho_eventful_anaesthesia ?? 0,

                'cough' => $this->pacr1_cough ?? 0,
                'wheezing' => $this->pacr1_wheezing ?? 0,
                'sputum' => $this->pacr1_sputum ?? 0,
                'recent_lri_uri' => $this->pacr1_recent_lri_uri ?? 0,
                'anaemia' => $this->pacr1_anaemia ?? 0,
                'jaundice' => $this->pacr1_jaundice ?? 0,
                'cyanosis' => $this->pacr1_cyanosis ?? 0,
                'clubbing' => $this->pacr1_clubbing ?? 0,
                'pedal_edema' => $this->pacr1_pedal_edema ?? 0,

                'airway_spine' => $this->pacr1_airway_spine,
                'ltd_mo' => $this->pacr1_ltd_mo ?? 0,
                'bucked_tooth' => $this->pacr1_bucked_tooth ?? 0,
                'loose_tooth' => $this->pacr1_loose_tooth ?? 0,
                'denture' => $this->pacr1_denture ?? 0,
                'short_neck' => $this->pacr1_short_neck ?? 0,
                'receding_mandible' => $this->pacr1_receding_mandible ?? 0,
                'rnm' => $this->pacr1_rnm ?? 0,
                'hyphosis' => $this->pacr1_hyphosis ?? 0,
                'adentulous' => $this->pacr1_adentulous ?? 0,
                'scoliosis' => $this->pacr1_scoliosis ?? 0,
                'lordosis' => $this->pacr1_lordosis ?? 0,
                'others' => $this->pacr1_others,
            ]);

            OtPreOperationAnaesthesiaCheckSecondRecord::where('ot_pre_operation_id', $this->ot_pre_operation_id)->update([
                'supine' => $this->pacr2_supine,
                'supine_bp' => $this->pacr2_supine_bp,
                'supine_spo2' => $this->pacr2_supine_spo2,
                'erect' => $this->pacr2_erect,
                'erect_bp' => $this->pacr2_erect_bp,

                'cvs' => $this->pacr2_cvs,
                'rs' => $this->pacr2_rs,
                'pa' => $this->pacr2_pa,

                'hb' => $this->pacr2_hb,
                'tc' => $this->pacr2_tc,
                'dc' => $this->pacr2_dc,
                'esr' => $this->pacr2_esr,
                'rbs' => $this->pacr2_rbs,
                'platlet' => $this->pacr2_platlet,
                'bt' => $this->pacr2_bt,
                'pt' => $this->pacr2_pt,
                'inr' => $this->pacr2_inr,
                'aptt' => $this->pacr2_aptt,
                'lft' => $this->pacr2_lft,
                'bi_urea' => $this->pacr2_bi_urea,
                'sr_creat' => $this->pacr2_sr_creat,

                'ct' => $this->pacr2_ct,
                'hiv' => $this->pacr2_hiv,
                'hbsag' => $this->pacr2_hbsag,
                'hcv' => $this->pacr2_hcv,
                's_electrolytes' => $this->pacr2_s_electrolytes,
                'blood_gr_rh_typing' => $this->pacr2_blood_gr_rh_typing,
                'ecg' => $this->pacr2_ecg,
                'echo' => $this->pacr2_echo,
                'tft' => $this->pacr2_tft,
                'pft' => $this->pacr2_pft,
                'tmt' => $this->pacr2_tmt,
                'abg' => $this->pacr2_abg,
                'chest_xray' => $this->pacr2_chest_xray,
                'bill_venous_dopper_abg_for_both_ll' => $this->pacr2_bill_venous_dopper_abg_for_both_ll,

                'specialist_opinion_before_surgery' => $this->pacr2_specialist_opinion_before_surgery,
                'any_further_investigation_required_before_surgery' => $this->pacr2_any_further_investigation_required_before_surgery,
                'blood_reserve' => $this->pacr2_blood_reserve,
                'remarks' => $this->pacr2_remarks,
                'npo_for' => $this->pacr2_npo_for,
                'pre_medication' => $this->pacr2_pre_medication,
            ]);

            session()->flash('message', 'Pre Operation Updated Successfully.');
            return redirect()->route('admin.ot.pre-operation');
        }
    }

    public function render()
    {
        return view('livewire.ot.pre-operation.pre-operation-edit')->extends('layouts.admin')->section('content');
    }
}
