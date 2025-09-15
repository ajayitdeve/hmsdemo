<?php

namespace App\Http\Livewire\Report\OpdRegisterReport;

use App\Exports\OpdRegisterReportExport;
use App\Models\CostCenter;
use App\Models\Patient;
use App\Models\PatientType;
use Livewire\Component;

use Maatwebsite\Excel\Facades\Excel;

class OpdRegisterReport extends Component
{
    public $from_date, $to_date, $patient_type_id, $cost_center_id, $sorting_order = 'asc';
    public $opd_register_reports = [];
    public $patient_types = [];
    public $cost_centers = [];

    public function mount()
    {
        $this->patient_types = PatientType::latest()->get();
        $this->cost_centers = CostCenter::latest()->get();

        $this->cost_center_id = CostCenter::latest()->value("id");
    }

    public function show()
    {
        $this->opd_register_reports = Patient::query()
            ->when($this->patient_type_id, function ($query) {
                $query->where("patient_type_id", $this->patient_type_id);
            })

            ->when($this->from_date, function ($query) {
                $query->whereDate("created_at", ">=", $this->from_date);
            })

            ->when($this->to_date, function ($query) {
                $query->whereDate("created_at", "<=", $this->to_date);
            })
            ->orderBy('created_at', $this->sorting_order)
            ->get();
    }

    public function exportExcel()
    {
        if (count($this->opd_register_reports) > 0) {
            return Excel::download(new OpdRegisterReportExport($this->opd_register_reports), 'opd-register-report.xlsx');
        }

        session()->flash('error', 'No result found...');
    }

    public function render()
    {
        return view('livewire.report.opd-register-report.opd-register-report')->extends('layouts.admin')->section('content');
    }
}
