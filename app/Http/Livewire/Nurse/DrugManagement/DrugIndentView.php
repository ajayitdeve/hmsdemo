<?php

namespace App\Http\Livewire\Nurse\DrugManagement;

use App\Models\IpPharmacyIndent;
use App\Models\StockPoint;
use App\Traits\NurseDepartment;
use Livewire\Component;

class DrugIndentView extends Component
{
    use NurseDepartment;

    public $bg_color, $exd;
    public $nrq_no, $nrq_date, $req_by, $status, $admn_no, $admn_date, $ward, $room, $bed, $umr, $patient_name, $nurse_department_code, $nurse_department_name;
    public $doctor_code, $doctor_name, $stock_point_id, $stock_point_code, $corporate_name, $patient_type, $doctor_department_code, $doctor_department_name, $remarks;
    public $stock_points = [];

    public $batch_no, $quantity, $unit_sale_price, $discount = 0, $amount, $taxable_amount, $cgst, $sgst, $total;
    public $item_id, $item_name;
    public $items = [], $counter, $arrCart = [], $batch_nos = [], $users = [];
    public $discount_approved_by_id = 1, $payableAmount = 0, $dueAmount = 0, $payingAmount = 0, $discountAmount = 0, $prviousDuesAmount = 0;

    public function mount($indent_id)
    {
        $this->checkNurseStationSession();

        $drug_indent = IpPharmacyIndent::where('id', $indent_id)->where("nurse_station_id", session()->get("nurse_station_id"))->first();

        if ($drug_indent) {
            $this->nrq_no = $drug_indent->nrq_code;
            $this->nrq_date = date("Y-m-d", strtotime($drug_indent->created_at));
            $this->req_by = $drug_indent->user?->name;
            $this->status = $drug_indent->status;
            $this->admn_no = $drug_indent->ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($drug_indent->ipd?->created_at));
            $this->ward = $drug_indent->ipd?->ward?->name;
            $this->room = $drug_indent->ipd?->room?->name;
            $this->bed = $drug_indent->ipd?->bed?->display_name;
            $this->umr = $drug_indent->ipd?->patient?->registration_no;
            $this->patient_name = $drug_indent->ipd?->patient?->name;
            $this->nurse_department_code = $drug_indent->ipd?->room?->nurseStation?->code;
            $this->nurse_department_name = $drug_indent->ipd?->room?->nurseStation?->name;
            $this->doctor_code = $drug_indent->ipd?->patient_visit?->doctor?->code;
            $this->doctor_name = $drug_indent->ipd?->patient_visit?->doctor?->name;
            $this->stock_point_id = $drug_indent->stock_point_id;
            $this->stock_point_code = $drug_indent->stock_point?->code;
            $this->patient_type = $drug_indent->ipd?->patient?->patienttype->name;
            $this->doctor_department_code = $drug_indent->ipd?->patient_visit?->department?->code;
            $this->doctor_department_name = $drug_indent->ipd?->patient_visit?->department?->name;
            $this->remarks = $drug_indent->remarks;

            $this->corporate_name = $drug_indent->ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $drug_indent->ipd?->corporate_registration?->organization?->color;

            $this->arrCart = $drug_indent->indent_items;
            $this->payableAmount = $drug_indent->indent_items()->sum('total');
        }

        $this->stock_points = StockPoint::get();
    }

    public function render()
    {
        return view('livewire.nurse.drug-management.drug-indent-view')->extends('layouts.admin')->section('content');
    }
}
