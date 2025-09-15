<?php

namespace App\Http\Livewire\Report\IpAdmissionReport;

use App\Exports\IpAdmissionReport\AdmissionNoWiseReportExport;
use App\Exports\IpAdmissionReport\AdmissionPurposeWiseReportExport;
use App\Exports\IpAdmissionReport\AdmissionTypeWiseReportExport;
use App\Exports\IpAdmissionReport\ConsultantWiseReportExport;
use App\Exports\IpAdmissionReport\DepartmentWiseReportExport;
use App\Exports\IpAdmissionReport\PatientWiseReportExport;
use App\Exports\IpAdmissionReport\ReAdmissionWiseReportExport;
use App\Exports\IpAdmissionReport\UserWiseReportExport;
use App\Exports\IpAdmissionReport\WardWiseReportExport;
use App\Models\AdminType;
use App\Models\AdmissionPurpose;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\HealthCoordinator;
use App\Models\Hospital;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use App\Models\Ipd\Ward;
use App\Models\Other;
use App\Models\PatientType;
use App\Models\Staff;
use App\Models\User;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class IpAdmissionReport extends Component
{
    public $selection_type = 'user-wise', $from_date, $to_date, $area;
    public $referral_id, $referralmenu_id, $referrals = [], $referralmenus = [], $referrable_type, $referralmenuname;
    public $user_id, $ward_id, $patient_name, $consultant_id, $department_id, $admn_type_id, $ipd_code, $admission_purpose_id;
    public $organization_id, $patient_source, $patient_type_id, $gender_id, $sorting_order = 'desc', $cost_center_id;

    public $selection_types = [
        'user-wise' => 'User Wise',
        'ward-wise' => 'Ward Wise',
        'patient-wise' => 'Patient Wise',
        'consultant-wise' => 'Consultant Wise',
        'department-wise' => 'Department Wise',
        // 'referral-source-wise' => 'Referral Source Wise',
        'admission-type-wise' => 'Admission Type Wise',
        'admission-no-wise' => 'AdmissionNo Wise',
        'admission-purpose' => 'Admission Purpose',
        // 'consultant-wise-occupancy' => 'Consultant Wise Occupancy',
        // 'admission-and-advances' => 'Admission and Advances',
        // 'admission-cancellation' => 'Admission Cancellation',
        // 'doctor-transfer-details' => 'Doctor Transfer Details',
        // 'mlc-admission-details' => 'MLC Admission Details',
        // 'not-approval-admissions' => 'Not Approval Admissions',
        // 'patientwise-creditlimit' => 'PatientWise CreditLimit',
        // 'admissionno-wise-invst' => 'AdmissionNo Wise Invst',
        // 'delivery-entry-details' => 'Delivery Entry Details',
        // 'nutrition-assesment-details' => 'Nutrition Assesment Details',
        're-admissionno-wise' => 'Re AdmissionNo Wise',
        // 'vip-admission-details' => 'VIP Admission Details',
        // 'ip-corpreferl-entry' => 'IP CorpReferl Entry',
    ];

    public $users = [];
    public $wards = [];
    public $consultants = [];
    public $departments = [];
    public $patient_types = [];
    public $admn_types = [];
    public $admission_purposes = [];
    public $organizations = [];
    public $genders = [];
    public $cost_centers = [];

    public $export_fields = [
        "sr_no" => "Sr. No.",
        "ipd_code" => "IPD Code",
        "umr" => "UMR",
        "patient_name" => "Patient Name",
        "age" => "Age",
        "gender" => "Gender",
        "address" => "Address",
        "patient_type" => "Patient Type",
        "area" => "Area",
        "admission_date" => "Admission Date",
        "admn_type" => "Admn. Type",
        "patient_source" => "Patient Source",
        "doctor_name" => "Doctor Name",
        "department" => "Department",
        "unit" => "Unit",
        "ward" => "Ward",
        "organization_name" => "Organization",
        "purpose" => "Purpose",
        "created_by" => "Created By",
        "created_at" => "Created At",
    ];
    public $selected_export_fields = [
        "sr_no",
        "ipd_code",
        "umr",
        "patient_name",
        "age",
        "gender",
        "address",
        "patient_type",
        "area",
        "admission_date",
        "admn_type",
        "patient_source",
    ];

    public $ip_admission_reports = [];

    public function mount()
    {
        $this->referralmenus = [['id' => 1, 'name' => 'Self'], ['id' => 2, 'name' => 'Staff Doctor'], ['id' => 3, 'name' => 'Staff'], ['id' => 4, 'name' => 'Hospital'], ['id' => 5, 'name' => 'Walkin'], ['id' => 6, 'name' => 'Health Coordinator'], ['id' => 7, 'name' => 'Other']];
        $this->users = User::latest()->get();
        $this->wards = Ward::get();
        $this->consultants = Doctor::get();
        $this->departments = Department::get();
        $this->admn_types = AdminType::get();
        $this->admission_purposes = AdmissionPurpose::get();

        $this->patient_types = PatientType::get();
        $this->organizations = Organization::get();
        $this->genders = Gender::get();
        $this->cost_centers = CostCenter::get();

        $this->cost_center_id = CostCenter::value("id");
        $this->from_date = now()->format('Y-m-d');
        $this->to_date = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.report.ip-admission-report.ip-admission-report')->extends('layouts.admin')->section('content');
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'ip_admission_reports',
            'user_id',
            'ward_id',
            'patient_name',
            'consultant_id',
            'department_id',
            'organization_id',
            'admn_type_id',
            'ipd_code',
            'admission_purpose_id',
        ]);
    }

    public function referralmenuChanged()
    {
        if ($this->referralmenu_id == 1) {
            $this->referral_id = 1;
            $this->referrable_type = '\App\Models\ReferralSelf';
            $this->referralmenuname = 'Self';
        }
        if ($this->referralmenu_id == 2) {
            $this->referral_id = '';
            $this->referrals = Doctor::all();
            $this->referrable_type = '\App\Models\Doctor';
            $this->referralmenuname = 'Doctor';
        }
        if ($this->referralmenu_id == 3) {
            $this->referral_id = '';
            $this->referrals = Staff::all();
            $this->referrable_type = '\App\Models\Staff';
            $this->referralmenuname = 'Staff';
        }
        if ($this->referralmenu_id == 4) {
            $this->referral_id = '';
            $this->referrals = Hospital::all();
            $this->referrable_type = '\App\Models\Hospital';
            $this->referralmenuname = 'Hospital';
        }
        if ($this->referralmenu_id == 5) {
            $this->referral_id = 5;
            $this->referrable_type = '\App\Models\ReferralWalking';
            $this->referralmenuname = 'Walking';
        }
        if ($this->referralmenu_id == 6) {
            $this->referral_id = '';
            $this->referrals = HealthCoordinator::all();
            $this->referrable_type = '\App\Models\HealthCoordinator';
            $this->referralmenuname = 'HealthCoordinator';
        }
        if ($this->referralmenu_id == 7) {
            $this->referral_id = '';
            $this->referrals = Other::all();
            $this->referrable_type = '\App\Models\Other';
            $this->referralmenuname = 'Other';
        }
    }

    public function show()
    {
        $ipds = Ipd::query()
            ->with(['patient', 'corporate_registration.organization', 'admin_type', 'patient_visit.doctor', 'created_by'])
            ->whereHas('patient', function ($query) {
                $query
                    ->when($this->gender_id, function ($query) {
                        $query->where('gender_id', $this->gender_id);
                    })
                    ->when($this->patient_type_id, function ($query) {
                        $query->where('patient_type_id', $this->patient_type_id);
                    })
                    ->when($this->area, function ($query) {
                        $query->where('is_rural', $this->area);
                    })
                    ->when($this->patient_name, function ($query) {
                        $query->where('name', 'like', '%' . $this->patient_name . '%');
                    });
            })
            ->when($this->organization_id, function ($query) {
                $query->whereHas('corporate_registration', function ($q) {
                    $q->where('organization_id', $this->organization_id)
                        ->where('is_cancelled', 0);
                });
            })
            ->when($this->user_id, function ($query) {
                $query->where('created_by_id', $this->user_id);
            })
            ->when($this->ward_id, function ($query) {
                $query->where('ward_id', $this->ward_id);
            })
            ->when($this->consultant_id, function ($query) {
                $query
                    ->whereHas('patient_visit', function ($q) {
                        $q->where('doctor_id', $this->consultant_id);
                    });
            })
            ->when($this->department_id, function ($query) {
                $query->where('department_id', $this->department_id);
            })
            ->when($this->ipd_code, function ($query) {
                $query->where('ipdcode', 'like', "%$this->ipd_code%");
            })
            ->when($this->admission_purpose_id, function ($query) {
                $query->where('admission_purpose_id', $this->admission_purpose_id);
            })
            ->when($this->admn_type_id, function ($query) {
                $query->where('admin_type_id', $this->admn_type_id);
            })
            ->when($this->patient_source, function ($query) {
                $query->where('patient_source', $this->patient_source);
            })
            ->when($this->cost_center_id, function ($query) {
                $query->where('cost_center_id', $this->cost_center_id);
            })
            ->when($this->selection_type == 're-admissionno-wise', function ($query) {
                $query->whereIn('patient_id', function ($sub) {
                    $sub->select('patient_id')
                        ->from('ipds')
                        ->groupBy('patient_id')
                        ->havingRaw('COUNT(*) > 1');
                });
            })
            ->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->orderBy('created_at', $this->sorting_order)
            ->get();

        $this->ip_admission_reports = $ipds;
    }

    public function getGroupedData()
    {
        $ipds = $this->ip_admission_reports;

        return match ($this->selection_type) {
            'user-wise' => $ipds->filter(fn($item) => $item?->created_by?->name)->groupBy(fn($item) => $item?->created_by?->name),
            'ward-wise' => $ipds->filter(fn($item) => $item?->ward?->name)->groupBy(fn($item) => $item?->ward?->name),
            'consultant-wise' => $ipds->filter(fn($item) => $item?->patient_visit?->doctor?->name)->groupBy(fn($item) => $item?->patient_visit?->doctor?->name),
            'department-wise' => $ipds->filter(fn($item) => $item?->department?->name)->groupBy(fn($item) => $item?->department?->name),
            // 'referral-source-wise' => $ipds->filter(fn($item) => $item?->unit?->name)->groupBy(fn($item) => $item?->unit?->name),
            'admission-type-wise' => $ipds->filter(fn($item) => $item?->admin_type?->name)->groupBy(fn($item) => $item?->admin_type?->name),
            'admission-purpose' => $ipds->filter(fn($item) => $item?->admin_purpose?->name)->groupBy(fn($item) => $item?->admin_purpose?->name),
            're-admissionno-wise' => $ipds->filter(fn($item) => $item?->patient?->name)->groupBy(fn($item) => $item?->patient?->name),
            default => $ipds,
        };
    }

    public function exportPdf()
    {
        if (count($this->ip_admission_reports) > 0) {
            $groupedData = $this->getGroupedData();

            $pdf = Pdf::loadView("exports.ip-admission-report.$this->selection_type-report", [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'ip_admission_reports' => $this->ip_admission_reports,
                'groupedData' => $groupedData,
                'selection_types' => $this->selection_types,
                'selection_type' => $this->selection_type,
                'export_fields' => $this->export_fields,
                'selected_export_fields' => $this->selected_export_fields,
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "$this->selection_type-ip-admission-report.pdf");
        }

        session()->flash('error', 'No result found...');
    }

    public function exportExcel()
    {
        if (count($this->ip_admission_reports) > 0) {
            switch ($this->selection_type) {
                case 'user-wise':
                    return Excel::download(new UserWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'ward-wise':
                    return Excel::download(new WardWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'patient-wise':
                    return Excel::download(new PatientWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'consultant-wise':
                    return Excel::download(new ConsultantWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'department-wise':
                    return Excel::download(new DepartmentWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'admission-type-wise':
                    return Excel::download(new AdmissionTypeWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'admission-no-wise':
                    return Excel::download(new AdmissionNoWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 'admission-purpose':
                    return Excel::download(new AdmissionPurposeWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;

                case 're-admissionno-wise':
                    return Excel::download(new ReAdmissionWiseReportExport($this->ip_admission_reports, $this->export_fields, $this->selected_export_fields), "ip-admission-$this->selection_type-report.xlsx");
                    break;
            }
        }

        session()->flash('error', 'No result found...');
    }
}
