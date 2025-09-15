<?php

namespace App\Http\Livewire\Ipd\Ipd;

use App\Models\Ipd\Bed;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\PatientBed;
use App\Models\Patient;
use Livewire\Component;
use App\Models\CaseType;
use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;
use App\Models\Referral;
use App\Models\Relation;
use App\Models\AdminType;
use App\Models\Nationality;
use App\Models\PatientVisit;
use App\Models\Ipd\Attendent;
use App\Models\AdmissionPurpose;
use App\Models\Ipd\CorporateRegistration;
use App\Models\Ipd\Organization;
use Illuminate\Support\Facades\DB;

class IpdAdmission extends Component
{
    public $bg_color, $umr, $patient_name, $patient_age, $patient_gender, $patient_type, $patient_visit, $department, $unit, $doctor, $referral_name, $referrable_id;
    //ips table columns
    public $patient_id, $patient_visit_id, $cost_center_id, $department_id, $unit_id, $ward_id, $room_id, $bed_id, $referral_id;
    public $nationality_id = 1, $admin_type_id, $case_type_id, $admission_purpose_id, $ipdcode, $reason, $company, $policy_no, $payment = 0, $exp_app_amt = 0;
    public $diet, $admit_type = "Walking", $expected_stay_days, $mother_admission_no, $is_with_mother = false, $pan_no, $type_of_admin = "Non Package", $estimated_amt;
    public $patient_source = 'OP', $nationality, $passport_no;
    public $payment_by;
    //attendents table column id, ipd_id, relation_id, name, mobile, alt_mobile, address, deleted_at, created_at, updated_at
    public $ipd_id, $relation_id, $name, $mobile, $alt_mobile, $address, $corporate_registration_id, $organization_name;
    //others
    public $caseTypes = [], $adminTypes, $admissionPurposes, $nationalities, $relations, $wards = [], $rooms = [], $beds = [], $patient;
    public $patients = [];
    public $corporate_registration_list = [];

    //for bed chart
    public $roomBeds = [];

    public function mount()
    {
        $this->caseTypes = CaseType::get();
        $this->adminTypes = AdminType::get();
        $this->admissionPurposes = AdmissionPurpose::get();
        $this->nationalities = Nationality::get();
        $this->relations = Relation::get();
        $this->wards = Ward::get();
        //$this->rooms = Room::get();
        //$this->beds = Bed::get();
        $this->patients = Patient::latest()->get();
    }

    public function rules()
    {
        return [
            'umr' => 'required',
            'admin_type_id' => 'required',
            // 'referral_id' => 'required',
            'payment_by' => 'required',
            'diet' => 'required',
            'patient_source' => 'required',
            'nationality_id' => 'required',
            'ward_id' => 'required',
            'room_id' => 'required',
            'bed_id' => 'required',
            'name' => 'required',
            'relation_id' => 'required',
            'mobile' => 'required',
            'address' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function umrChanged()
    {
        $this->reset(["corporate_registration_id", "organization_name", "payment_by", "bg_color"]);

        $patient = Patient::where('registration_no', $this->umr)->first();
        if ($patient) {
            $this->patient_age = $patient->age != null ? $patient->age : null;
            $this->patient_gender = $patient->gender_id != null ? $patient->gender->name : null;
            $this->patient_name = $patient->name != null ? $patient->name : null;
            $this->patient_type = $patient->patient_type_id != null ? $patient->patienttype->name : null;
            if ($patient) {
                //set relation
                $this->relation_id = $patient->relation->id;
                //setting father name as attendent
                $this->name = $patient->father_name;
                //setting mobile no as attendent mobile no
                $this->mobile = $patient->mobile != null ? $patient->mobile : null;
                //set patient Address
                $this->address = $patient->address != null ? $patient->address : null;
                $this->patient = $patient;
                //get consultation details from patient_visits
                $this->patient_visit = PatientVisit::where('patient_id', $patient->id)->orderBy('id', 'DESC')->first();
                //getting referral details
                $patientReferral = Referral::where('patient_id', $this->patient->id)->first();
                $this->referral_name = $patientReferral->referrable->name;
                $this->referrable_id = $patientReferral->referrable_id;
                $this->referral_id = $patientReferral->id;

                $ipdCount = $this->countIpd($patient);
                if ($ipdCount > 0) {
                    session()->flash('error', 'IPD already exist for this patient');
                }

                //dd($patientReferral->id);
                if ($this->patient_visit) {
                    // dd($this->patient_visit);
                    $this->department = $this->patient_visit->department_id != null ? $this->patient_visit->department->name : null;
                    $this->unit = $this->patient_visit->unit_id != null ? $this->patient_visit->unit->name : null;
                    $this->doctor = $this->patient_visit->doctor_id != null ? 'Dr. ' . $this->patient_visit->doctor->name : null;

                    $this->department_id = $this->patient_visit?->department_id;
                    $this->unit_id = $this->patient_visit?->unit_id;
                } else {
                    session()->flash('error', 'Consulation not exist');
                }

                $this->corporate_registration_list = $patient?->corporate_registrations()->where("is_cancelled", 0)->latest()->get();

                $corporate_registration = $patient?->corporate_registrations()->where("is_cancelled", 0)->latest()->first();
                if ($corporate_registration) {
                    $this->corporate_registration_id = $corporate_registration?->id ?? NULL;
                    $this->department_id = $corporate_registration?->department_id;
                    $this->unit_id = $corporate_registration?->unit_id;

                    $corporate_consultation = $corporate_registration?->corporate_consultation;

                    if ($corporate_consultation) {
                        $this->payment_by = $corporate_consultation?->payment_by;
                        $this->organization_name = $corporate_consultation?->organization?->name;
                        $this->bg_color = "#" . $corporate_consultation?->organization?->color;
                    }
                }
            }
        } else {
            session()->flash('error', 'UMR not exist');
        }
    }

    public function corporateRegistrationChanged()
    {
        $corporate_registration = CorporateRegistration::find($this->corporate_registration_id);
        if ($corporate_registration) {
            $this->department_id = $corporate_registration?->department_id;
            $this->unit_id = $corporate_registration?->unit_id;

            $corporate_consultation = $corporate_registration?->corporate_consultation;

            if ($corporate_consultation) {
                $this->payment_by = $corporate_consultation?->payment_by;
                $this->organization_name = $corporate_consultation?->organization?->name;
                $this->bg_color = "#" . $corporate_consultation?->organization?->color;
            }
        } else {
            $this->organization_name = "";
            $this->bg_color = "#ffff";
        }
    }

    public function wardChanged()
    {
        //first reset Rooms And Beds
        $this->rooms = [];
        $this->beds = [];
        $this->rooms = Room::where('ward_id', $this->ward_id)->get();
    }
    public function roomChanged()
    {
        //first reset bess
        $this->beds = [];
        $this->beds = Bed::where('room_id', $this->room_id)->get();
        $this->getBedChart();
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $ipds = [
                'patient_id' => $this->patient->id,
                'patient_visit_id' => $this->patient_visit->id,
                'cost_center_id' => 1,
                'corporate_registration_id' => $this->corporate_registration_id ?: null,
                'department_id' => $this->department_id,
                'unit_id' => $this->unit_id,
                'ward_id' => $this->ward_id,
                'room_id' => $this->room_id,
                'bed_id' => $this->bed_id,
                'referral_id' => $this->referral_id,
                'nationality_id' => $this->nationality_id,
                'admin_type_id' => $this->admin_type_id,
                'case_type_id' => $this->case_type_id,
                'admission_purpose_id' => $this->admission_purpose_id,
                'ipdcode' => $this->getIpdCode(),
                'reason' => $this->reason,
                'company' => $this->company,
                'policy_no' => $this->policy_no,
                'payment_by' => $this->payment_by,
                'payment' => $this->payment,
                'exp_app_amt' => $this->exp_app_amt,
                'diet' => $this->diet,
                'admit_type' => $this->admit_type,
                'expected_stay_days' => $this->exp_app_amt,
                'mother_admission_no' => $this->mother_admission_no,
                'is_with_mother' => $this->is_with_mother,
                'pan_no' => $this->pan_no,
                'type_of_admin' => $this->type_of_admin,
                'estimated_amt' => $this->estimated_amt,
                'patient_source' => $this->patient_source,
                'passport_no' => $this->passport_no,
                'created_by_id' => auth()->user()?->id,
            ];

            $ipd = Ipd::create($ipds);

            //creating Attendent
            $attendent = Attendent::create([
                'ipd_id' => $ipd->id,
                'name' => $this->name,
                'relation_id' => $this->relation_id,
                'mobile' => $this->mobile,
                'alt_mobile' => $this->alt_mobile,
                'address' => $this->address,
            ]);

            //id, ipd_id, ward_id, room_id, bed_id, from, to, is_ipd_allocation, is_transfer, transfer_narration,
            $patientBed = PatientBed::create([
                'ipd_id' => $ipd->id,
                'ward_id' => $this->ward_id,
                'room_id' => $this->room_id,
                'bed_id' => $this->bed_id,
                'from' => now(),
                'to' => null,
                'is_ipd_allocation' => true,
                'is_transfer' => false,
                'transfer_narration' => "Allocated to UMR:" . $this->umr . " IPD:" . $ipd->ipdcode,
            ]);


            $bed = Bed::where('id', $this->bed_id)->update(['bed_status' => 'used']);

            // Create wallet by helper
            create_wallet($ipd->id, $this->patient->id);

            //checking status for above function i.e. aboove are successfull or not
            if ($ipd && $attendent && $patientBed && $bed) {
                DB::commit();
                session()->flash('ipd_id', $ipd->id);
                session()->flash('success', 'IPD Admission Successfully.');
                return redirect()->route('admin.ipd.ipd-list');
            } else {
                DB::rollBack();
                return back()->with('error', 'Something went wrong during admission.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'IPD Admission Failed: ' . $e->getMessage());
        }
    }

    public function getIpdCode()
    {
        $maxId = Ipd::max('id');
        $ipdNo = 'IP' . date('y') . date('m') . date('d') . ($maxId + 1);
        return $ipdNo;
    }

    public function countIpd(Patient $patient)
    {
        $count = Ipd::where('patient_id', $patient->id)->count();
        return $count;
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent("close-modal");
    }

    public function getBedChart()
    {
        if ($this->ward_id != null && $this->room_id != null) {
            $this->roomBeds = Bed::where('ward_id', $this->ward_id)->where('room_id', $this->room_id)->get();
            //dd($this->roomBeds);
        }
    }

    public function selectBed($id)
    {
        $this->bed_id = $id;
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.ipd.ipd.ipd-admission')->extends('layouts.admin')->section('content');
    }
}
