<?php

namespace App\Http\Livewire\Ipd\IpdDischarge;

use App\Models\DischargeType;
use App\Models\Doctor;
use App\Models\Ipd\Organization;
use App\Models\IpDischarge;
use App\Models\IpFinalBilling;
use App\Models\IpPreRefund;
use App\Models\Patient;
use App\Models\Wallet;
use Carbon\Carbon;
use Livewire\Component;

class IpdDischargeMaster extends Component
{
    public $bg_color = "", $umr, $patient_name, $age, $status;
    public $admn_no, $admn_date, $admn_type, $gender;
    public $patient_type, $consultant, $ward, $room, $bed, $corporate_name;
    public $discharge_no, $discharge_date, $consultant_id, $consultant_code, $due_reference_id, $due_reference_code;
    public $discharge_type, $discharge_status, $diagnosis;
    public $bill_no, $bill_date, $gross_amount, $concession, $total_advance, $received_amount, $due_amount, $refund_amount;
    public $ipd_id, $patient_id;

    public $patients = [];
    public $doctors = [];
    public $discharge_types = [];
    public $due_references = [];

    public $discharge_statuses = [
        "All Formalities Completed",
        "Call Of Discharge",
    ];

    public function mount()
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->doctors = Doctor::latest()->get();
        $this->discharge_types = DischargeType::get();
        $this->due_references = Organization::get();

        $this->discharge_status = $this->discharge_statuses[0];
        $this->status = "Not Approved";

        $this->generateDischargeNo();
    }

    public function generateDischargeNo()
    {
        // $maxId = IpDischarge::max('id');
        $maxId = 0;
        $this->discharge_no = "DIS" . date('y') . date('m') . date('d') . $maxId + 1;
        $this->discharge_date = date('Y-m-d H:i');
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd?->id;

            $this->patient_id = $patient?->id;
            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->admn_no = $ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->admn_type = $ipd?->admin_type?->name;
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;
            $this->consultant = $ipd?->patient_visit?->doctor?->name;;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;
            $this->due_reference_id = $ipd?->corporate_registration?->organization?->id;
            $this->due_reference_code = $ipd?->corporate_registration?->organization?->code;

            $ip_final_bill = IpFinalBilling::where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->latest()
                ->first();

            if ($ip_final_bill) {
                $this->bill_no = $ip_final_bill?->bill_no;
                $this->bill_date = date("Y-m-d", strtotime($ip_final_bill?->bill_date));
                $this->gross_amount = $ip_final_bill?->gross_amount;
                $this->concession = $ip_final_bill?->concession;
                $this->total_advance = $ip_final_bill?->total_advance;
                $this->received_amount = $ip_final_bill?->amount;
                $this->due_amount = $ip_final_bill?->due_amount;
                $this->refund_amount = 0;
            }

            $ip_pre_refund = IpPreRefund::where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->latest()
                ->get();

            if ($ip_pre_refund && count($ip_pre_refund) > 0) {
                $this->bill_no = null;
                $this->bill_date = null;
                $this->gross_amount = $ip_pre_refund->sum("gross_amount");
                $this->concession = 0;
                $this->total_advance = $ip_pre_refund->sum("total_advance");
                $this->received_amount = 0;
                $this->due_amount = $ip_pre_refund->sum("due_amount");
                $this->refund_amount = $ip_pre_refund->sum("amount");
            }

            $ip_discharge_exists = IpDischarge::where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->exists();

            if ($ip_discharge_exists) {
                session()->flash('error', 'Patient Already Discharged !');
            }
        } else {
        }
    }

    public function consultantChanged()
    {
        $consultant = Doctor::where("id", $this->consultant_id)->first();
        if ($consultant) {
            $this->consultant_code = $consultant?->code;
        } else {
            $this->consultant_code = null;
        }
    }

    public function dueReferenceChanged()
    {
        $organization = Organization::find($this->due_reference_id);
        if ($organization) {
            $this->due_reference_code = $organization?->code;
        } else {
            $this->due_reference_code = null;
        }
    }

    public function save()
    {
        $this->validate([
            'ipd_id' => 'required',
            'patient_id' => 'required',
            'discharge_no' => 'required',
            'discharge_date' => 'required',
            'discharge_type' => 'required',
        ]);

        $ip_discharge_exists = IpDischarge::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->exists();

        if ($ip_discharge_exists) {
            session()->flash('error', 'Patient Already Discharged !');
            return;
        }

        $wallet = Wallet::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->first();

        if ($wallet) {
            if ($wallet->amount == 0 && $wallet->credit_limit == 0 && $wallet->total_credit_limit == 0) {
                $ip_discharge = IpDischarge::create([
                    "ipd_id" => $this->ipd_id,
                    "patient_id" => $this->patient_id,
                    "discharge_no" => $this->discharge_no,
                    "discharge_date" => date("Y-m-d H:i:s"),
                    "doctor_id" => $this->consultant_id ?: null,
                    "organization_id" => $this->due_reference_id ?: null,
                    "discharge_type_id" => $this->discharge_type,
                    "discharge_status" => $this->discharge_status,
                    "diagnosis" => $this->diagnosis ?: null,
                    "created_by_id" => auth()->user()?->id
                ]);

                session()->flash('success', 'Patient Discharged Successfully !');
                return redirect()->route('admin.ipd.ip-discharge.print', $ip_discharge?->id);
            }

            session()->flash('error', 'Please clear due or credit limit first !');
            return;
        }

        session()->flash('error', 'Something went wront ! Try Again');
    }

    public function render()
    {
        return view('livewire.ipd.ipd-discharge.ipd-discharge-master')->extends('layouts.admin')->section('content');
    }
}
