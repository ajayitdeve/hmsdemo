<?php

namespace App\Http\Livewire\Report\MonthDayWiseReport;

use App\Exports\MonthDayWise\ConsultantWiseAllTransactionReportExport;
use App\Exports\MonthDayWise\ConsultantWiseReportExport;
use App\Exports\MonthDayWise\DepartmentWiseAllTransactionReportExport;
use App\Exports\MonthDayWise\DepartmentWiseReportExport;
use App\Exports\MonthDayWise\UserWiseReportExport;
use App\Models\AdminType;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\Patient;
use App\Models\PatientType;
use App\Models\PatientVisit;
use App\Models\User;
use App\Models\VisitType;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class MonthDayWiseReport extends Component
{
    public $report_type = 'day-wise', $type = 'registrations';
    public $selection_type = 'user-wise', $from_date, $to_date, $sorting_order = 'desc';
    public $user_id, $consultant_id, $department_id, $patient_type_id, $admin_type_id, $visit_type_id, $cost_center_id;

    public $selection_types = [
        'user-wise' => 'User Wise',
        'consultant-wise' => 'Consultant Wise',
        'department-wise' => 'Department Wise',
        'consultant-wise-all-transaction' => 'Consultant Wise All Transaction',
        'department-wise-all-transaction' => 'Department Wise All Trans',
    ];

    public $consultants = [];
    public $departments = [];
    public $users = [];
    public $patient_types = [];
    public $admin_types = [];
    public $visit_types = [];
    public $cost_centers = [];

    public $month_day_wise_reports = [];

    public function mount()
    {
        $this->consultants = Doctor::latest()->get();
        $this->departments = Department::get();
        $this->users = User::latest()->get();
        $this->patient_types = PatientType::latest()->get();
        $this->admin_types = AdminType::latest()->get();
        $this->visit_types = VisitType::latest()->get();
        $this->cost_centers = CostCenter::latest()->get();

        $this->cost_center_id = CostCenter::latest()->value("id");
        $this->from_date = now()->format('Y-m-d');
        $this->to_date = now()->format('Y-m-d');
    }
    public function render()
    {
        return view('livewire.report.month-day-wise-report.month-day-wise-report')->extends('layouts.admin')->section('content');
    }

    public function reportTypeChanged()
    {
        $this->selectionTypeChanged();

        if ($this->report_type == 'day-wise') {
            $this->from_date = now()->format('Y-m-d');
            $this->to_date = now()->format('Y-m-d');
        }

        if ($this->report_type == 'month-wise') {
            $this->from_date = now()->format('Y-m-01');
            $this->to_date = now()->format('Y-m-d');
        }

        if ($this->report_type == 'year-wise') {
            $this->from_date = now()->format('Y-01-01');
            $this->to_date = now()->format('Y-m-d');
        }
    }

    public function typeChanged()
    {
        $this->selectionTypeChanged();
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'month_day_wise_reports',
            'user_id',
            'consultant_id',
            'department_id',
        ]);
    }

    public function show()
    {
        switch ($this->selection_type) {
            case 'user-wise':
                switch ($this->type) {
                    case 'registrations':
                        $registrations = Patient::select(
                            'users.name as user_name',
                            DB::raw('DATE(patients.created_at) as day'),
                            DB::raw('COUNT(patients.id) as count')
                        )
                            ->join('users', 'users.id', '=', 'patients.created_by_id')
                            ->whereBetween('patients.created_at', [$this->from_date, $this->to_date])
                            ->when($this->user_id, function ($query) {
                                $query->where('patients.created_by_id', $this->user_id);
                            })
                            ->when($this->patient_type_id, function ($query) {
                                $query->where('patients.patient_type_id', $this->patient_type_id);
                            })
                            ->groupBy('patients.created_by_id', DB::raw('DATE(patients.created_at)'), 'users.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $registrations;
                        break;

                    case 'admissions':
                        $ipds = Ipd::select(
                            'users.name as user_name',
                            DB::raw('DATE(ipds.created_at) as day'),
                            DB::raw('COUNT(ipds.id) as count')
                        )
                            ->join('users', 'users.id', '=', 'ipds.created_by_id')
                            ->whereBetween('ipds.created_at', [$this->from_date, $this->to_date])
                            ->when($this->user_id, function ($query) {
                                $query->where('ipds.created_by_id', $this->user_id);
                            })
                            ->when($this->admin_type_id, function ($query) {
                                $query->where('ipds.admin_type_id', $this->admin_type_id);
                            })
                            ->when($this->cost_center_id, function ($query) {
                                $query->where('ipds.cost_center_id', $this->cost_center_id);
                            })
                            ->groupBy('ipds.created_by_id', DB::raw('DATE(ipds.created_at)'), 'users.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $ipds;
                        break;

                    case 'consultations':
                        $patient_visits = PatientVisit::select(
                            'users.name as user_name',
                            DB::raw('DATE(patient_visits.created_at) as day'),
                            DB::raw('COUNT(patient_visits.id) as count'),
                            DB::raw('SUM(patient_visits.fee) as total_amount')
                        )
                            ->join('users', 'users.id', '=', 'patient_visits.created_by_id')
                            ->whereBetween('patient_visits.created_at', [$this->from_date, $this->to_date])
                            ->when($this->user_id, function ($query) {
                                $query->where('patient_visits.created_by_id', $this->user_id);
                            })
                            ->when($this->visit_type_id, function ($query) {
                                $query->where('patient_visits.visit_type_id', $this->visit_type_id);
                            })
                            ->groupBy('patient_visits.created_by_id', DB::raw('DATE(patient_visits.created_at)'), 'users.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $patient_visits;
                        break;

                    case 'discharges':
                        $discharges = [];

                        $this->month_day_wise_reports = $discharges;
                        break;
                }
                break;

            case 'consultant-wise':
                switch ($this->type) {
                    case 'registrations':
                        $registrations = [];

                        $this->month_day_wise_reports = $registrations;
                        break;

                    case 'admissions':
                        $ipds = [];

                        $this->month_day_wise_reports = $ipds;
                        break;

                    case 'consultations':
                        $patient_visits = PatientVisit::select(
                            'doctors.name as doctor_name',
                            DB::raw('DATE(patient_visits.created_at) as day'),
                            DB::raw('COUNT(patient_visits.id) as count'),
                            DB::raw('SUM(patient_visits.fee) as total_amount')
                        )
                            ->join('doctors', 'doctors.id', '=', 'patient_visits.doctor_id')
                            ->whereBetween('patient_visits.created_at', [$this->from_date, $this->to_date])
                            ->when($this->consultant_id, function ($query) {
                                $query->where('patient_visits.doctor_id', $this->consultant_id);
                            })
                            ->when($this->visit_type_id, function ($query) {
                                $query->where('patient_visits.visit_type_id', $this->visit_type_id);
                            })
                            ->groupBy('patient_visits.doctor_id', DB::raw('DATE(patient_visits.created_at)'), 'doctors.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $patient_visits;
                        break;

                    case 'discharges':
                        $discharges = [];

                        $this->month_day_wise_reports = $discharges;
                        break;
                }
                break;

            case 'department-wise':
                switch ($this->type) {
                    case 'registrations':
                        $registrations = [];

                        $this->month_day_wise_reports = $registrations;
                        break;

                    case 'admissions':
                        $ipds = Ipd::select(
                            'departments.name as department_name',
                            DB::raw('DATE(ipds.created_at) as day'),
                            DB::raw('COUNT(ipds.id) as count')
                        )
                            ->join('departments', 'departments.id', '=', 'ipds.department_id')
                            ->whereBetween('ipds.created_at', [$this->from_date, $this->to_date])
                            ->when($this->department_id, function ($query) {
                                $query->where('ipds.department_id', $this->department_id);
                            })
                            ->when($this->admin_type_id, function ($query) {
                                $query->where('ipds.admin_type_id', $this->admin_type_id);
                            })
                            ->when($this->cost_center_id, function ($query) {
                                $query->where('ipds.cost_center_id', $this->cost_center_id);
                            })
                            ->groupBy('ipds.department_id', DB::raw('DATE(ipds.created_at)'), 'departments.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $ipds;
                        break;

                    case 'consultations':
                        $patient_visits = PatientVisit::select(
                            'departments.name as department_name',
                            DB::raw('DATE(patient_visits.created_at) as day'),
                            DB::raw('COUNT(patient_visits.id) as count'),
                            DB::raw('SUM(patient_visits.fee) as total_amount')
                        )
                            ->join('departments', 'departments.id', '=', 'patient_visits.department_id')
                            ->whereBetween('patient_visits.created_at', [$this->from_date, $this->to_date])
                            ->when($this->department_id, function ($query) {
                                $query->where('patient_visits.department_id', $this->department_id);
                            })
                            ->when($this->visit_type_id, function ($query) {
                                $query->where('patient_visits.visit_type_id', $this->visit_type_id);
                            })
                            ->groupBy('patient_visits.department_id', DB::raw('DATE(patient_visits.created_at)'), 'departments.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $patient_visits;
                        break;

                    case 'discharges':
                        $discharges = [];

                        $this->month_day_wise_reports = $discharges;
                        break;
                }
                break;

            case 'consultant-wise-all-transaction':
                switch ($this->type) {
                    case 'registrations':
                        $registrations = [];

                        $this->month_day_wise_reports = $registrations;
                        break;

                    case 'admissions':
                        $ipds = [];

                        $this->month_day_wise_reports = $ipds;
                        break;

                    case 'consultations':
                        $patient_visits = PatientVisit::select(
                            'doctors.name as doctor_name',
                            DB::raw('DATE(patient_visits.created_at) as day'),
                            DB::raw('COUNT(patient_visits.id) as count'),
                            DB::raw('SUM(patient_visits.fee) as total_amount'),
                            DB::raw('SUM(patient_visits.discount) as discount_amount')
                        )
                            ->join('doctors', 'doctors.id', '=', 'patient_visits.doctor_id')
                            ->whereBetween('patient_visits.created_at', [$this->from_date, $this->to_date])
                            ->when($this->consultant_id, function ($query) {
                                $query->where('patient_visits.doctor_id', $this->consultant_id);
                            })
                            ->when($this->visit_type_id, function ($query) {
                                $query->where('patient_visits.visit_type_id', $this->visit_type_id);
                            })
                            ->groupBy('patient_visits.doctor_id', DB::raw('DATE(patient_visits.created_at)'), 'doctors.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $patient_visits;
                        break;

                    case 'discharges':
                        $discharges = [];

                        $this->month_day_wise_reports = $discharges;
                        break;
                }
                break;

            case 'department-wise-all-transaction':
                switch ($this->type) {
                    case 'registrations':
                        $registrations = [];

                        $this->month_day_wise_reports = $registrations;
                        break;

                    case 'admissions':
                        $ipds = Ipd::select(
                            'departments.name as department_name',
                            DB::raw('DATE(ipds.created_at) as day'),
                            DB::raw('COUNT(ipds.id) as count')
                        )
                            ->join('departments', 'departments.id', '=', 'ipds.department_id')
                            ->whereBetween('ipds.created_at', [$this->from_date, $this->to_date])
                            ->when($this->department_id, function ($query) {
                                $query->where('ispds.department_id', $this->department_id);
                            })
                            ->when($this->admin_type_id, function ($query) {
                                $query->where('ipds.admin_type_id', $this->admin_type_id);
                            })
                            ->when($this->cost_center_id, function ($query) {
                                $query->where('ipds.cost_center_id', $this->cost_center_id);
                            })
                            ->groupBy('ipds.department_id', DB::raw('DATE(ipds.created_at)'), 'departments.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $ipds;
                        break;

                    case 'consultations':
                        $patient_visits = PatientVisit::select(
                            'departments.name as department_name',
                            DB::raw('DATE(patient_visits.created_at) as day'),
                            DB::raw('COUNT(patient_visits.id) as count'),
                            DB::raw('SUM(patient_visits.fee) as total_amount'),
                            DB::raw('SUM(patient_visits.discount) as discount_amount')
                        )
                            ->join('departments', 'departments.id', '=', 'patient_visits.department_id')
                            ->whereBetween('patient_visits.created_at', [$this->from_date, $this->to_date])
                            ->when($this->department_id, function ($query) {
                                $query->where('patient_visits.department_id', $this->department_id);
                            })
                            ->when($this->visit_type_id, function ($query) {
                                $query->where('patient_visits.visit_type_id', $this->visit_type_id);
                            })
                            ->groupBy('patient_visits.department_id', DB::raw('DATE(patient_visits.created_at)'), 'departments.name')
                            ->orderBy('day', $this->sorting_order)
                            ->get();

                        $this->month_day_wise_reports = $patient_visits;
                        break;

                    case 'discharges':
                        $discharges = [];

                        $this->month_day_wise_reports = $discharges;
                        break;
                }
                break;
        }
    }

    public function exportPdf()
    {
        $this->show();

        if (count($this->month_day_wise_reports) > 0) {
            $pdf = Pdf::loadView("exports.month-day-wise-report.$this->selection_type-report", [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,

                'month_day_wise_reports' => $this->month_day_wise_reports,
                'type' => $this->type,

                'selection_types' => $this->selection_types,
                'selection_type' => $this->selection_type,
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "$this->selection_type-report.pdf");
        }

        session()->flash('error', 'No result found...');
    }

    public function exportExcel()
    {
        $this->show();

        if (count($this->month_day_wise_reports) > 0) {
            switch ($this->selection_type) {
                case 'user-wise':
                    return Excel::download(new UserWiseReportExport($this->month_day_wise_reports, $this->type), "$this->selection_type-report.xlsx");
                    break;

                case 'consultant-wise':
                    return Excel::download(new ConsultantWiseReportExport($this->month_day_wise_reports, $this->type), "$this->selection_type-report.xlsx");
                    break;

                case 'department-wise':
                    return Excel::download(new DepartmentWiseReportExport($this->month_day_wise_reports, $this->type), "$this->selection_type-report.xlsx");
                    break;

                case 'consultant-wise-all-transaction':
                    return Excel::download(new ConsultantWiseAllTransactionReportExport($this->month_day_wise_reports, $this->type), "$this->selection_type-report.xlsx");
                    break;

                case 'department-wise-all-transaction':
                    return Excel::download(new DepartmentWiseAllTransactionReportExport($this->month_day_wise_reports, $this->type), "$this->selection_type-report.xlsx");
                    break;
            }
        }

        session()->flash('error', 'No result found...');
    }
}
