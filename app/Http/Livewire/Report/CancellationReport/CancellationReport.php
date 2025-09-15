<?php

namespace App\Http\Livewire\Report\CancellationReport;

use App\Exports\CancellationReport\InPatientInvestigationCancellationReportExport;
use App\Exports\CancellationReport\InPatientMiscellaneousCancellationReportExport;
use App\Exports\CancellationReport\InPatientProcedureCancellationReportExport;
use App\Exports\CancellationReport\InPatientServiceCancellationReportExport;
use App\Exports\CancellationReport\OutPatientMiscellaneousCancellationReportExport;
use App\Exports\OutPatientConsultationCancellationReportExport;
use App\Models\CostCenter;
use App\Models\IpLabIndentItem;
use App\Models\OpdBillingItems;
use App\Models\PatientVisit;
use Livewire\Component;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CancellationReport extends Component
{
    public $selection_type = 'in-patient-service-cancellation', $from_date, $to_date, $sorting_order = "desc", $cost_center_id;
    public $service_cancel = 1; // 1 for cancelled, 0 for not cancelled

    public $selection_types = [
        'in-patient-service-cancellation' => 'InPatient Service Cancellation',
        // 'in-patient-consultation-cancellation' => 'InPatient Consultation Cancellation',
        'in-patient-investigation-cancellation' => 'InPatient Investigation Cancellation',
        'in-patient-miscellaneous-cancellation' => 'InPatient Miscellaneous Cancellation',
        'in-patient-procedure-cancellation' => 'InPatient Procedure Cancellation',
        // 'in-patient-final-bill-cancellation' => 'InPatient FinalBill Cancellation',
        // 'in-patient-post-discount-cancellation' => 'InPatient PostDiscount Cancellation',
        // 'in-patient-refunds-cancellation' => 'InPatient Refunds Cancellation',
        'out-patient-consultation-cancellation' => 'OutPatient Consultation Cancellation',
        // 'out-patient-bill-cancellation' => 'OutPatient Bill Cancellation',
        'out-patient-miscellaneous-cancellation' => 'OutPatient Miscellaneous Cancellation',
        // 'out-patient-post-discount-cancellation' => 'OutPatient PostDiscount Cancellation',
        // 'out-patient-refund-cancellation' => 'OutPatient Refund Cancellation',
        // 'miscellaneous-refund-cancellation' => 'Miscellaneous Refund Cancellation',
        // 'due-cancellation' => 'Due Cancellation',
        // 'in-patient-ward-cancellation' => 'InPatient Ward Cancellation',
        // 'in-patient-professional-cancellation' => 'InPatient Professional Cancellation',
    ];

    public $service_types = [
        'S' => 'Service',
        'I' => 'Investigation',
        'M' => 'Miscellaneous',
        'P' => 'Procedure',
    ];

    public $cost_centers = [];
    public $export_fields = [
        "sr_no" => "Sr. No.",
        "ipd_code" => "IPD Code",
        "cancel_date" => "Cancel Date",
        "service_date" => "Service Date",
        "umr" => "UMR",
        "patient_name" => "Patient Name",
        "service_name" => "Service Name",
        "service_code" => "Service Code",
        "service_group" => "Service Group",
        "qty" => "Quantity",
        "rate" => "Rate",
        "amount" => "Amount",
        "discount" => "Discount",
        "total" => "Total",
    ];
    public $selected_export_fields = [
        "sr_no",
        "ipd_code",
        "cancel_date",
        "service_date",
        "umr",
        "patient_name",
        "service_name",
        "service_code",
        "service_group",
        "qty",
        "rate",
        "amount",
        "discount",
        "total",
    ];
    public $cancellation_reports = [];

    public function mount()
    {
        $this->cost_centers = CostCenter::latest()->get();
        $this->cost_center_id = CostCenter::latest()->value("id");
        $this->from_date = now()->startOfDay()->format('Y-m-d\TH:i'); // 12:00 AM
        $this->to_date = now()->endOfDay()->format('Y-m-d\TH:i');     // 11:59 PM
    }

    public function render()
    {
        return view('livewire.report.cancellation-report.cancellation-report')->extends('layouts.admin')->section('content');
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'cancellation_reports',
            'export_fields',
            'selected_export_fields',
        ]);

        switch ($this->selection_type) {
            case 'out-patient-consultation-cancellation':
                $this->export_fields = [
                    "sr_no" => "Sr. No.",
                    "visit_code" => "Visit Code",
                    "cancel_date" => "Cancel Date",
                    "visit_date" => "Visit Date",
                    "umr" => "UMR",
                    "patient_name" => "Patient Name",
                    "doctor_name" => "Doctor Name",
                    "department_name" => "Department Name",
                    "unit_name" => "Unit Name",
                    "amount" => "Amount",
                ];
                $this->selected_export_fields = [
                    "sr_no",
                    "visit_code",
                    "cancel_date",
                    "visit_date",
                    "umr",
                    "patient_name",
                    "doctor_name",
                    "department_name",
                    "unit_name",
                    "amount",
                ];
                break;

            case 'out-patient-miscellaneous-cancellation':
                unset($this->export_fields['ipd_code']);
                $this->selected_export_fields = array_values(array_filter(
                    $this->selected_export_fields,
                    fn($field) => $field !== 'ipd_code'
                ));
                break;
        }
    }

    public function show()
    {
        switch ($this->selection_type) {
            case 'in-patient-service-cancellation':
                $ip_patient_service_cancellation = IpLabIndentItem::with(['service', 'lab_indent'])
                    ->whereHas('service', function ($q) {
                        $q->where('type', "S");
                    })
                    ->whereHas('lab_indent', function ($q) {
                        $q->where('is_cancelled', $this->service_cancel);
                    })
                    ->whereBetween('created_at', [$this->from_date, $this->to_date])
                    ->orderBy('created_at', $this->sorting_order)
                    ->get();

                $this->cancellation_reports = $ip_patient_service_cancellation;
                break;

            case 'in-patient-consultation-cancellation':

                break;

            case 'in-patient-investigation-cancellation':
                $ip_patient_service_cancellation = IpLabIndentItem::with(['service', 'lab_indent'])
                    ->whereHas('service', function ($q) {
                        $q->where('type', "I");
                    })
                    ->whereHas('lab_indent', function ($q) {
                        $q->where('is_cancelled', $this->service_cancel);
                    })
                    ->whereBetween('created_at', [$this->from_date, $this->to_date])
                    ->orderBy('created_at', $this->sorting_order)
                    ->get();

                $this->cancellation_reports = $ip_patient_service_cancellation;
                break;

            case 'in-patient-miscellaneous-cancellation':
                $ip_patient_service_cancellation = IpLabIndentItem::with(['service', 'lab_indent'])
                    ->whereHas('service', function ($q) {
                        $q->where('type', "M");
                    })
                    ->whereHas('lab_indent', function ($q) {
                        $q->where('is_cancelled', $this->service_cancel);
                    })
                    ->whereBetween('created_at', [$this->from_date, $this->to_date])
                    ->orderBy('created_at', $this->sorting_order)
                    ->get();

                $this->cancellation_reports = $ip_patient_service_cancellation;
                break;

            case 'in-patient-procedure-cancellation':
                $ip_patient_service_cancellation = IpLabIndentItem::with(['service', 'lab_indent'])
                    ->whereHas('service', function ($q) {
                        $q->where('type', "P");
                    })
                    ->whereHas('lab_indent', function ($q) {
                        $q->where('is_cancelled', $this->service_cancel);
                    })
                    ->whereBetween('created_at', [$this->from_date, $this->to_date])
                    ->orderBy('created_at', $this->sorting_order)
                    ->get();

                $this->cancellation_reports = $ip_patient_service_cancellation;
                break;

            case 'out-patient-consultation-cancellation':
                $out_patient_consultation_cancellation = PatientVisit::onlyTrashed()
                    ->with(['patient'])
                    ->whereNotNull('cancelled_by_id')
                    ->whereBetween('created_at', [$this->from_date, $this->to_date])
                    ->orderBy('created_at', $this->sorting_order)
                    ->get();

                $this->cancellation_reports = $out_patient_consultation_cancellation;
                break;

            case 'out-patient-miscellaneous-cancellation':
                $out_patient_service_cancellation = OpdBillingItems::with(['service', 'opdBilling'])
                    ->whereHas('service', function ($q) {
                        $q->where('type', "M");
                    })
                    ->where('is_cancled', $this->service_cancel)
                    ->whereBetween('created_at', [$this->from_date, $this->to_date])
                    ->orderBy('created_at', $this->sorting_order)
                    ->get();

                $this->cancellation_reports = $out_patient_service_cancellation;
                break;
        }
    }

    public function exportPdf()
    {
        $this->show();

        if (count($this->cancellation_reports) > 0) {
            $pdf = Pdf::loadView("exports.cancellation-report.$this->selection_type-report", [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,

                'cancellation_reports' => $this->cancellation_reports,

                'export_fields' => $this->export_fields,
                'selected_export_fields' => $this->selected_export_fields,
                'selection_types' => $this->selection_types,
                'selection_type' => $this->selection_type,
                'service_types' => $this->service_types,
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

        if (count($this->cancellation_reports) > 0) {
            switch ($this->selection_type) {
                case 'in-patient-service-cancellation':
                    return Excel::download(new InPatientServiceCancellationReportExport($this->cancellation_reports, $this->export_fields, $this->selected_export_fields), "$this->selection_type-report.xlsx");
                    break;

                case 'in-patient-consultation-cancellation':

                    break;

                case 'in-patient-investigation-cancellation':
                    return Excel::download(new InPatientInvestigationCancellationReportExport($this->cancellation_reports, $this->export_fields, $this->selected_export_fields), "$this->selection_type-report.xlsx");
                    break;

                case 'in-patient-miscellaneous-cancellation':
                    return Excel::download(new InPatientMiscellaneousCancellationReportExport($this->cancellation_reports, $this->export_fields, $this->selected_export_fields), "$this->selection_type-report.xlsx");
                    break;

                case 'in-patient-procedure-cancellation':
                    return Excel::download(new InPatientProcedureCancellationReportExport($this->cancellation_reports, $this->export_fields, $this->selected_export_fields), "$this->selection_type-report.xlsx");
                    break;

                case 'out-patient-consultation-cancellation':
                    return Excel::download(new OutPatientConsultationCancellationReportExport($this->cancellation_reports, $this->export_fields, $this->selected_export_fields), "$this->selection_type-report.xlsx");
                    break;

                case 'out-patient-miscellaneous-cancellation':
                    return Excel::download(new OutPatientMiscellaneousCancellationReportExport($this->cancellation_reports, $this->export_fields, $this->selected_export_fields), "$this->selection_type-report.xlsx");
                    break;
            }
        }

        session()->flash('error', 'No result found...');
    }
}
