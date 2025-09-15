<?php

namespace App\Http\Livewire\Report\OpConsultationReport;

use App\Exports\OpConsultationReportExport;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\District;
use App\Models\Doctor;
use App\Models\HealthCoordinator;
use App\Models\Hospital;
use App\Models\Ipd\Organization;
use App\Models\Other;
use App\Models\PatientType;
use App\Models\PatientVisit;
use App\Models\Staff;
use App\Models\Unit;
use App\Models\User;
use App\Models\VisitType;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class OpConsultationReport extends Component
{
    public $selection_type = 'patient-wise', $from_date, $to_date, $patient_type_id, $visit_type = "both", $area = '', $visit_type_id, $cost_center_id;
    public $referral_id, $referralmenu_id, $referrals = [], $referralmenus = [], $referrable_type, $referralmenuname = '';
    public $patient_name, $consultant_id, $department_id, $unit_id, $user_id, $district_id, $consultation_no, $organization_id, $sorting_order = 'desc';

    public $selection_types = [
        'patient-wise' => 'Patient Wise',
        'consultant-wise' => 'Consultant Wise',
        'referral-wise' => 'Referral Wise',
        'department-wise' => 'Department Wise',
        'unit-wise' => 'Unit Wise',
        'user-wise' => 'User Wise',
        'city-wise' => 'City Wise',
        'consultation-no-wise' => 'Consultation No Wise',
        'organization-wise' => 'Organization Wise',
        'inpatient-register' => 'InPatient Register',
        // 'due-wise' => 'Due Wise',
    ];
    public $visit_types = [];
    public $patient_types = [];
    public $consultants = [];
    public $departments = [];
    public $units = [];
    public $users = [];
    public $districts = [];
    public $organizations = [];
    public $cost_centers = [];
    public $op_consultation_reports = [];
    public $export_fields = [
        "sr_no" => "Sr. No.",
        "umr" => "UMR",
        "patient_name" => "Patient Name",
        "age" => "Age",
        "gender" => "Gender",
        "address" => "Address",
        "department" => "Department",
        "unit" => "Unit",
        "consult_status" => "Cons Status",
        "patient_type" => "Patient Type",
        "area" => "Area",
        "ipd_code" => "IPD Code",
        "organization_name" => "Organization",
        "consult_no" => "Consult. No",
        "consult_date" => "Consult. Dt.",
        "doctor_name" => "Doctor Name",
        "visit_type" => "Visit Type",
        "consult_fee" => "Consult. Fee",
        "foc" => "FOC",
        "created_by" => "Created By",
        "created_at" => "Created At",
    ];
    public $selected_export_fields = [
        "sr_no",
        "umr",
        "patient_name",
        "age",
        "gender",
        "address",
        "department",
        "unit",
    ];

    public function mount()
    {
        $this->patient_types = PatientType::latest()->get();
        $this->visit_types = VisitType::latest()->get();
        $this->consultants = Doctor::latest()->get();
        $this->referralmenus = [['id' => 1, 'name' => 'Self'], ['id' => 2, 'name' => 'Staff Doctor'], ['id' => 3, 'name' => 'Staff'], ['id' => 4, 'name' => 'Hospital'], ['id' => 5, 'name' => 'Walkin'], ['id' => 6, 'name' => 'Health Coordinator'], ['id' => 7, 'name' => 'Other']];
        $this->departments = Department::get();
        $this->users = User::latest()->get();
        $this->districts = District::get();
        $this->organizations = Organization::get();
        $this->cost_centers = CostCenter::latest()->get();

        $this->cost_center_id = CostCenter::latest()->value("id");
        $this->from_date = now()->format('Y-m-d\T00:00');
        $this->to_date = now()->format('Y-m-d\T23:59');
    }

    public function render()
    {
        return view('livewire.report.op-consultation-report.op-consultation-report')->extends('layouts.admin')->section('content');
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'patient_name',
            'consultant_id',
            'referral_id',
            'referralmenu_id',
            'department_id',
            'unit_id',
            'user_id',
            'district_id',
            'consultation_no',
            'organization_id',
            'op_consultation_reports',
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

    public function departmentChanged()
    {
        $this->units = Unit::where('department_id', $this->department_id)->get();
    }

    public function show()
    {
        $this->op_consultation_reports = PatientVisit::query()
            ->with([
                'doctor',
                'department',
                'unit',
                'created_by',
                'patient.village.district',
                'patient.referral',
                'ipd.corporate_registration.organization',
            ])
            ->when($this->visit_type_id, function ($query) {
                $query->where("visit_type_id", $this->visit_type_id);
            })

            ->when($this->selection_type == 'consultant-wise', function ($query) {
                $query->whereNotNull("doctor_id");
            })
            ->when($this->consultant_id, function ($query) {
                $query->where("doctor_id", $this->consultant_id);
            })

            ->when($this->department_id && in_array($this->selection_type, ['department-wise', 'unit-wise']), function ($query) {
                $query->where("department_id", $this->department_id);
            })
            ->when($this->unit_id, function ($query) {
                $query->where("unit_id", $this->unit_id);
            })
            ->when($this->user_id, function ($query) {
                $query->where("created_by_id", $this->user_id);
            })
            ->when($this->consultation_no, function ($query) {
                $query->where("visit_no", "like", "%$this->consultation_no%");
            })
            ->when($this->from_date, function ($query) {
                $query->whereDate("created_at", ">=", $this->from_date);
            })
            ->when($this->to_date, function ($query) {
                $query->whereDate("created_at", "<=", $this->to_date);
            })
            ->whereHas('patient', function ($q) {
                $q
                    ->when($this->selection_type == 'referral-wise', function ($query) {
                        $query->whereHas('referral', function ($q2) {
                            $q2
                                ->when($this->referrable_type, fn($query) => $query->where('referrable_type', $this->referrable_type))
                                ->when($this->referral_id, fn($query) => $query->where('referrable_id', $this->referral_id));
                        });
                    })
                    ->when($this->selection_type == 'city-wise', function ($query) {
                        $query->whereHas('village', function ($q2) {
                            $q2->when($this->district_id, function ($q3) {
                                $q3->where('district_id', $this->district_id);
                            });
                        });
                    })
                    ->when($this->patient_type_id, function ($query) {
                        $query->where("patient_type_id", $this->patient_type_id);
                    })
                    ->when($this->area, function ($query) {
                        $query->where("is_rural", $this->area);
                    })
                    ->when($this->patient_name, function ($query) {
                        $query->where("name", 'like', "%$this->patient_name%");
                    });
            })
            ->when($this->visit_type, function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->withCount('patientvisits')
                        ->when($this->visit_type == 'new', function ($q2) {
                            $q2->having('patientvisits_count', '=', 1);
                        })
                        ->when($this->visit_type == 'old', function ($q2) {
                            $q2->having('patientvisits_count', '>', 1);
                        })
                        ->when($this->visit_type == 'both', function ($q2) {
                            $q2->having('patientvisits_count', '>=', 1);
                        });
                });
            })
            ->when($this->selection_type == "organization-wise", function ($query) {
                $query->whereHas('ipd.corporate_registration', function ($q2) {
                    $q2->when($this->organization_id, function ($q3) {
                        $q3->where('organization_id', $this->organization_id);
                    });
                });
            })
            ->when($this->selection_type == "inpatient-register", function ($query) {
                $query->whereHas('ipd', function ($q2) {
                    $q2->when($this->department_id, function ($q3) {
                        $q3->where('department_id', $this->department_id);
                    });
                });
            })
            ->orderBy('created_at', $this->sorting_order ?? 'desc')
            ->get();
    }

    public function getGroupedData()
    {
        $visits = $this->op_consultation_reports;

        // return match ($this->selection_type) {
        //     'consultant-wise' => $visits->groupBy(fn($item) => optional($item?->doctor)->name ?? 'Unknown Consultant'),
        //     'referral-wise' => $visits->groupBy(fn($item) => optional($item?->patient?->referral)->name ?? 'Unknown Referral'),
        //     'department-wise' => $visits->groupBy(fn($item) => optional($item?->department)->name ?? 'Unknown Department'),
        //     'unit-wise' => $visits->groupBy(fn($item) => optional($item?->unit)->name ?? 'Unknown Unit'),
        //     'user-wise' => $visits->groupBy(fn($item) => optional($item?->created_by)->name ?? 'Unknown User'),
        //     'city-wise' => $visits->groupBy(fn($item) => optional($item?->patient?->village)->district->name ?? 'Unknown City'),
        //     'organization-wise' => $visits->groupBy(fn($item) => optional($item?->ipd?->corporate_registration?->organization)->name ?? 'Unknown Organization'),
        //     'inpatient-register' => $visits->groupBy(fn($item) => optional($item?->ipd?->corporate_registration?->department)->name ?? 'Unknown Department'),
        //     default => $visits,
        // };

        return match ($this->selection_type) {
            'consultant-wise' => $visits->filter(fn($item) => $item?->doctor?->name)->groupBy(fn($item) => $item?->doctor?->name),
            'referral-wise' => $visits->filter(fn($item) => $item?->patient?->referral?->name)->groupBy(fn($item) => $item?->patient?->referral?->name),
            'department-wise' => $visits->filter(fn($item) => $item?->department?->name)->groupBy(fn($item) => $item?->department?->name),
            'unit-wise' => $visits->filter(fn($item) => $item?->unit?->name)->groupBy(fn($item) => $item?->unit?->name),
            'user-wise' => $visits->filter(fn($item) => $item?->created_by?->name)->groupBy(fn($item) => $item?->created_by?->name),
            'city-wise' => $visits->filter(fn($item) => $item?->patient?->village?->district?->name)->groupBy(fn($item) => $item?->patient?->village?->district?->name),
            'organization-wise' => $visits->filter(fn($item) => $item?->ipd?->corporate_registration?->organization?->name)->groupBy(fn($item) => $item?->ipd?->corporate_registration?->organization?->name),
            'inpatient-register' => $visits->filter(fn($item) => $item?->ipd?->department?->name)->groupBy(fn($item) => $item?->ipd?->department?->name),
            default => $visits,
        };
    }

    public function exportPdf()
    {
        if (count($this->op_consultation_reports) > 0) {
            $groupedData = $this->getGroupedData();

            $pdf = Pdf::loadView('exports.op-consultation-report', [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'opConsultationReports' => $this->op_consultation_reports,
                'groupedData' => $groupedData,
                'selection_types' => $this->selection_types,
                'selection_type' => $this->selection_type,
                'export_fields' => $this->export_fields,
                'selected_export_fields' => $this->selected_export_fields,
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'op-consultation-report.pdf');
        }

        session()->flash('error', 'No result found...');
    }

    public function exportExcel()
    {
        if (count($this->op_consultation_reports) > 0) {
            return Excel::download(new OpConsultationReportExport($this->op_consultation_reports, $this->export_fields, $this->selected_export_fields), 'op-consultation-report.xlsx');
        }

        session()->flash('error', 'No result found...');
    }
}
