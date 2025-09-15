<?php

namespace App\Http\Livewire\Report\IpExpenditureReport;

use App\Models\AdmissionPurpose;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use App\Models\Ipd\Ward;
use App\Models\Patient;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class IpExpenditureReport extends Component
{
    public $selection_type = 'consultant-wise', $ipd_id, $patient_name, $area, $umr, $balance_start, $balance_last;
    public $consultant_id, $ward_id, $department_id, $organization_id, $admn_purpose_id, $sorting_order = 'desc', $cost_center_id;

    public $selection_types = [
        'consultant-wise' => 'Consultant Wise',
        'department-wise' => 'Department Wise',
        'ward-wise' => 'Ward Wise',
        'general' => 'General',
    ];

    public $ipds = [];
    public $patients = [];
    public $consultants = [];
    public $wards = [];
    public $departments = [];
    public $organizations = [];
    public $admn_purposes = [];
    public $cost_centers = [];
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
    public $ip_expenditure_reports = [];

    public function mount()
    {
        $this->ipds = Ipd::latest()->get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->consultants = Doctor::latest()->get();
        $this->wards = Ward::latest()->get();
        $this->departments = Department::get();
        $this->organizations = Organization::latest()->get();
        $this->admn_purposes = AdmissionPurpose::latest()->get();
        $this->cost_centers = CostCenter::latest()->get();

        $this->cost_center_id = CostCenter::latest()->value("id");
    }
    public function render()
    {
        return view('livewire.report.ip-expenditure-report.ip-expenditure-report')->extends('layouts.admin')->section('content');
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'ip_expenditure_reports',
        ]);
    }

    public function show()
    {
    }

    public function exportPdf()
    {
        // if (count($this->month_day_wise_reports) > 0) {
        //     $groupedData = $this->getGroupedData();

        //     $pdf = Pdf::loadView('exports.op-consultation-report', [
        //         'from_date' => $this->from_date,
        //         'to_date' => $this->to_date,
        //         'month_day_wise_reports' => $this->month_day_wise_reports,
        //         'groupedData' => $groupedData,
        //         'selection_types' => $this->selection_types,
        //         'selection_type' => $this->selection_type,
        //         'export_fields' => $this->export_fields,
        //         'selected_export_fields' => $this->selected_export_fields,
        //     ])->setPaper('a4', 'landscape');

        //     return response()->streamDownload(function () use ($pdf) {
        //         echo $pdf->stream();
        //     }, 'op-consultation-report.pdf');
        // }

        session()->flash('error', 'No result found...');
    }

    public function exportExcel()
    {
        // if (count($this->month_day_wise_reports) > 0) {
        //     return Excel::download(new OpConsultationReportExport($this->month_day_wise_reports, $this->export_fields, $this->selected_export_fields), 'op-consultation-report.xlsx');
        // }

        session()->flash('error', 'No result found...');
    }
}
