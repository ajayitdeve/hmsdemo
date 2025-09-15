<?php

namespace App\Http\Livewire\Report\IpAdvanceReport;

use App\Exports\IpAdvanceReport\AdmissionNoWiseReportExport;
use App\Exports\IpAdvanceReport\DepartmentWiseReportExport;
use App\Exports\IpAdvanceReport\PatientWiseReportExport;
use App\Exports\IpAdvanceReport\UserWiseReportExport;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use App\Models\PatientType;
use App\Models\User;
use App\Models\WalletTransaction;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class IpAdvanceReport extends Component
{
    public $selection_type = 'user-wise', $from_date, $to_date, $patient_type_id;
    // public $patient_status = 'admitted', $service_type = 'called-on';
    public $user_id, $patient_name, $ipd_id, $department_id;
    public $organization_id, $sorting_order = 'desc', $cost_center_id;

    public $selection_types = [
        'user-wise' => "User Wise",
        'patient-wise' => "Patient Wise",
        'admission-no-wise' => "Admission No Wise",
        'department-wise' => "Department Wise",

        // 'advance-receipts' => 'Advance Receipts',
        // 'advance-status-of-admitted-patients' => 'Advance Status of Admitted Patients',
        // 'cancelled-receipts' => 'Cancelled Receipts',
        // 'services-called-on-off-list' => 'Services Called On/Off List',
        // 'user-wise-advance-receipts' => 'User Wise Advance Receipts',
        // 'advance-for-own-cases' => 'Advance For OwnCases',
        // 'department-wise-advances' => 'Department Wise Advances',
        // 'consultant-wise-advances' => 'Consultant Wise Advances',
        // 'record-type-advances' => 'Record Type Advances',
        // 'pre-advances' => 'Pre Advances',
        // 'pre-refunds' => 'Pre Refunds',
    ];
    public $users = [];
    public $ipds = [];
    public $departments = [];
    public $patient_types = [];
    public $organizations = [];
    public $cost_centers = [];

    public $ip_advance_reports = [];

    public $export_fields = [
        "sr_no" => "Sr. No.",
        "umr" => "UMR",
        "patient_name" => "Patient Name",
        "ipd_code" => "IPD Code",
        "admission_date" => "Admission Date",
        "advance_amount" => "Advance Amount",
        "doctor_name" => "Doctor Name",
        "department" => "Department",
        "unit" => "Unit",
        "ward" => "Ward",
        "patient_type" => "Patient Type",
        "area" => "Area",
        "organization_name" => "Organization",
        "created_by" => "Created By",
        "created_at" => "Created At",
    ];
    public $selected_export_fields = [
        "sr_no",
        "umr",
        "patient_name",
        "ipd_code",
        "admission_date",
        "advance_amount",
        "doctor_name",
        "department",
        "unit",
        "ward",
        "patient_type",
        "area",
    ];

    public function mount()
    {
        $this->users = User::latest()->get();
        $this->ipds = Ipd::latest()->get();
        $this->departments = Department::get();
        $this->patient_types = PatientType::get();
        $this->organizations = Organization::get();
        $this->cost_centers = CostCenter::get();

        $this->cost_center_id = CostCenter::value("id");
        $this->from_date = now()->format('Y-m-d');
        $this->to_date = now()->format('Y-m-d');
    }
    public function render()
    {
        return view('livewire.report.ip-advance-report.ip-advance-report')->extends('layouts.admin')->section('content');
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'ip_advance_reports',
            'user_id',
            'ipd_id',
            'patient_name',
            'department_id',
        ]);
    }

    public function show()
    {
        $wallet_transactions = WalletTransaction::query()
            ->with(['ipd', 'patient', 'created_by'])
            ->whereHas('patient', function ($query) {
                $query
                    ->when($this->patient_type_id, function ($query) {
                        $query->where('patient_type_id', $this->patient_type_id);
                    })
                    ->when($this->patient_name, function ($query) {
                        $query->where('name', 'like', '%' . $this->patient_name . '%');
                    });
            })
            ->when($this->organization_id, function ($query) {
                $query->whereHas('ipd.corporate_registration', function ($q) {
                    $q->where('organization_id', $this->organization_id)
                        ->where('is_cancelled', 0);
                });
            })
            ->when($this->user_id, function ($query) {
                $query->where('created_by_id', $this->user_id);
            })
            ->when($this->ipd_id, function ($query) {
                $query->where('ipd_id', $this->ipd_id);
            })
            ->when($this->department_id, function ($query) {
                $query->where('department_id', $this->department_id);
            })
            ->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->where('type', 'credit')
            ->orderBy('created_at', $this->sorting_order)
            ->get();

        $this->ip_advance_reports = $wallet_transactions;
    }

    public function getGroupedData()
    {
        $wallet_transactions = $this->ip_advance_reports;

        return match ($this->selection_type) {
            'user-wise' => $wallet_transactions->filter(fn($item) => $item?->created_by?->name)->groupBy(fn($item) => $item?->created_by?->name),
            'patient-wise' => $wallet_transactions->filter(fn($item) => $item?->patient?->name)->groupBy(fn($item) => $item?->patient?->name),
            'department-wise' => $wallet_transactions->filter(fn($item) => $item?->ipd?->department?->name)->groupBy(fn($item) => $item?->ipd?->department?->name),
            default => $wallet_transactions,
        };
    }

    public function exportPdf()
    {
        if (count($this->ip_advance_reports) > 0) {
            $groupedData = $this->getGroupedData();

            $pdf = Pdf::loadView("exports.ip-advance-report.$this->selection_type-report", [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'ip_advance_reports' => $this->ip_advance_reports,
                'groupedData' => $groupedData,
                'selection_types' => $this->selection_types,
                'selection_type' => $this->selection_type,
                'export_fields' => $this->export_fields,
                'selected_export_fields' => $this->selected_export_fields,
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "$this->selection_type-ip-advance-report.pdf");
        }

        session()->flash('error', 'No result found...');
    }

    public function exportExcel()
    {
        if (count($this->ip_advance_reports) > 0) {
            switch ($this->selection_type) {
                case 'user-wise':
                    return Excel::download(new UserWiseReportExport($this->ip_advance_reports, $this->export_fields, $this->selected_export_fields), "ip-advance-$this->selection_type-report.xlsx");
                    break;

                case 'patient-wise':
                    return Excel::download(new PatientWiseReportExport($this->ip_advance_reports, $this->export_fields, $this->selected_export_fields), "ip-advance-$this->selection_type-report.xlsx");
                    break;

                case 'admission-no-wise':
                    return Excel::download(new AdmissionNoWiseReportExport($this->ip_advance_reports, $this->export_fields, $this->selected_export_fields), "ip-advance-$this->selection_type-report.xlsx");
                    break;

                case 'department-wise':
                    return Excel::download(new DepartmentWiseReportExport($this->ip_advance_reports, $this->export_fields, $this->selected_export_fields), "ip-advance-$this->selection_type-report.xlsx");
                    break;
            }
        }

        session()->flash('error', 'No result found...');
    }
}
