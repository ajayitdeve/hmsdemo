<?php

namespace App\Http\Livewire\FrontDesk\InPatientEnquiry;

use App\Exports\InPatientEnquiryExport;
use App\Models\AdminType;
use App\Models\CostCenter;
use App\Models\District;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Ipd\Bed;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Ward;
use App\Models\Patient;
use App\Models\PatientType;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class InPatientEnquiry extends Component
{
    public $patient_name, $consultant_id, $district_id, $patient_type_id, $father_name, $gender_id, $ward_id, $bed_id, $umr, $ipd_id;
    public $address, $mobile, $admn_type_id, $area = '', $cost_center_id;

    public $patient_types = [];
    public $consultants = [];
    public $districts = [];
    public $genders = [];
    public $wards = [];
    public $beds = [];
    public $patients = [];
    public $ipds = [];
    public $admission_types = [];
    public $cost_centers = [];

    public $in_patient_enquiries = [];

    public $export_fields = [
        "sr_no" => "Sr. No.",
        "patient_name" => "Patient Name",
        "umr" => "UMR No.",
        "age" => "Age",
        "gender" => "Gender",
        "ipd_code" => "IPD Code",
        "ipd_date" => "IPD Date",
        "ward" => "Ward",
        "room" => "Room",
        "bed" => "Bed",
        "doctor" => "Doctor",
        "patient_type" => "Patient Type",
        "marital_status" => "Marital Status",
        "city" => "City",
        "father_name" => "Father Name",
        "address" => "Address",
        "mobile" => "Mobile",
        "admn_type" => "Admn Type",
        "department" => "Department",
        "cost_center" => "Cost Center",
    ];
    public $selected_export_fields = [
        "sr_no",
        "patient_name",
        "umr",
        "age",
        "gender",
        "ipd_code",
        "ipd_date",
        "ward",
        "room",
        "bed",
        "doctor",
        "patient_type"
    ];

    public function mount()
    {
        $this->patient_types = PatientType::latest()->get();
        $this->consultants = Doctor::latest()->get();
        $this->districts = District::get();
        $this->genders = Gender::get();
        $this->wards = Ward::get();
        $this->beds = Bed::get();
        $this->patients = Patient::query()->whereHas("ipds")->get();
        $this->ipds = Ipd::get();
        $this->admission_types = AdminType::get();
        $this->cost_centers = CostCenter::latest()->get();

        $this->cost_center_id = CostCenter::latest()->value("id");
    }

    public function umrChanged()
    {
        $patient = Patient::find($this->umr);
        if ($patient) {
            $ipd = Ipd::where('patient_id', $patient->id)->latest()->first();
            if ($ipd) {
                $this->ipd_id = $ipd->id;
            } else {
                $this->ipd_id = null;
            }
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->umr = $ipd->patient_id;
        } else {
            $this->umr = null;
        }
    }

    public function show()
    {
        $patients = Ipd::query()
            ->with(['patient', 'admin_type', 'ward', 'room', 'bed', 'patient_visit', 'cost_center'])

            ->when($this->patient_name, function ($q) {
                $q->whereHas('patient', function ($qq) {
                    $qq->where('name', 'like', "%$this->patient_name%");
                });
            })
            ->when($this->consultant_id, function ($q) {
                $q->whereHas('patient_visit', function ($qq) {
                    $qq->where('doctor_id', $this->consultant_id);
                });
            })
            ->when($this->district_id, function ($query) {
                $query->whereHas('patient.village', function ($q2) {
                    $q2->when($this->district_id, function ($q3) {
                        $q3->where('district_id', $this->district_id);
                    });
                });
            })
            ->when($this->patient_type_id, function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->where("patient_type_id", $this->patient_type_id);
                });
            })
            ->when($this->father_name, function ($q) {
                $q->whereHas('patient', function ($qq) {
                    $qq->where('father_name', 'like', "%$this->father_name%");
                });
            })
            ->when($this->gender_id, function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->where('gender_id', $this->gender_id);
                });
            })
            ->when($this->ward_id, function ($q) {
                $q->where('ward_id', $this->ward_id);
            })
            ->when($this->bed_id, function ($q) {
                $q->where('bed_id', $this->bed_id);
            })
            ->when($this->umr, function ($q) {
                $q->whereHas('patient', function ($q) {
                    $q->where('id', $this->umr);
                });
            })
            ->when($this->ipd_id, function ($q) {
                $q->where('id', $this->ipd_id);
            })
            ->when($this->address, function ($q) {
                $q->whereHas('patient', function ($qq) {
                    $qq->where('address', 'like', "%$this->address%");
                });
            })
            ->when($this->mobile, function ($q) {
                $q->whereHas('patient', function ($qq) {
                    $qq->where('mobile', 'like', "%$this->mobile%");
                });
            })
            ->when($this->admn_type_id, function ($q) {
                $q->where('admin_type_id', $this->admn_type_id);
            })
            ->when($this->area, function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->where("is_rural", $this->area);
                });
            })
            ->when($this->cost_center_id, function ($q) {
                $q->where('cost_center_id', $this->cost_center_id);
            })
            ->latest()
            ->get();

        $this->in_patient_enquiries = $patients;
    }

    public function exportPdf()
    {
        if (count($this->in_patient_enquiries) > 0) {

            $pdf = Pdf::loadView('exports.in-patient-enquiry', [
                'in_patient_enquiries' => $this->in_patient_enquiries,
                'export_fields' => $this->export_fields,
                'selected_export_fields' => $this->selected_export_fields,
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'in-patient-enquiry.pdf');
        }

        session()->flash('error', 'No result found...');
    }

    public function exportExcel()
    {
        if (count($this->in_patient_enquiries) > 0) {
            return Excel::download(new InPatientEnquiryExport($this->in_patient_enquiries, $this->export_fields, $this->selected_export_fields), 'in-patient-enquiry.xlsx');
        }

        session()->flash('error', 'No result found...');
    }

    public function render()
    {
        return view('livewire.front-desk.in-patient-enquiry.in-patient-enquiry')->extends('layouts.admin')->section('content');
    }
}
