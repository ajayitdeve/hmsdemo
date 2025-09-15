<?php

namespace App\Http\Livewire\Report\ChangePatientReport;

use App\Models\CostCenter;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ChangePatientReport extends Component
{
    public $from_date, $to_date, $sorting_order = 'desc', $cost_center_id, $change_in = [];

    public $cost_centers;
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
    public $change_patient_reports = [];
    public function mount()
    {
        $this->cost_centers = CostCenter::latest()->get();
        $this->cost_center_id = CostCenter::latest()->value("id");
        $this->from_date = now()->format('Y-m-d');
        $this->to_date = now()->format('Y-m-d');
    }
    public function render()
    {
        return view('livewire.report.change-patient-report.change-patient-report')->extends('layouts.admin')->section('content');
    }

    public function show() {
        $this->change_patient_reports = [];
    }

    public function exportPdf()
    {
        // if (count($this->op_consultation_reports) > 0) {

        //     $pdf = Pdf::loadView('exports.op-consultation-report', [
        //         'from_date' => $this->from_date,
        //         'to_date' => $this->to_date,
        //         'change_patient_reports' => $this->change_patient_reports,
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
        // if (count($this->change_patient_reports) > 0) {
        //     return Excel::download(new OpConsultationReportExport($this->change_patient_reports, $this->export_fields, $this->selected_export_fields), 'op-consultation-report.xlsx');
        // }

        session()->flash('error', 'No result found...');
    }
}
