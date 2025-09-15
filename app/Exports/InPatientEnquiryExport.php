<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InPatientEnquiryExport implements FromCollection, WithHeadings, WithMapping
{
    public $data;
    public $export_fields;
    public $selected_export_fields;
    private $rowNumber = 0;

    public function __construct($data, $export_fields, $selected_export_fields)
    {
        $this->data = $data;
        $this->export_fields = $export_fields;
        $this->selected_export_fields = $selected_export_fields;
    }

    public function headings(): array
    {
        $fields = [];

        foreach ($this->selected_export_fields as $key) {
            $fields[] = $this->export_fields["$key"];
        }

        return $fields;
    }

    public function map($in_patient_enquiry): array
    {
        $this->rowNumber++;
        $row = [];

        foreach ($this->selected_export_fields as $field) {
            switch ($field) {
                case 'sr_no':
                    $row[] = $this->rowNumber;
                    break;

                case 'patient_name':
                    $row[] = $in_patient_enquiry?->patient?->name;
                    break;

                case 'umr':
                    $row[] = $in_patient_enquiry?->patient?->registration_no;
                    break;

                case 'age':
                    $row[] = Carbon::parse($in_patient_enquiry?->patient?->dob)->diff(Carbon::now())->format('%yY') . "(s)";
                    break;

                case 'gender':
                    $row[] = $in_patient_enquiry?->patient?->gender?->name;
                    break;

                case 'ipd_code':
                    $row[] = $in_patient_enquiry?->ipdcode;
                    break;

                case 'ipd_date':
                    $row[] = date('d-M-Y H:i:s', strtotime($in_patient_enquiry?->created_at));
                    break;

                case 'ward':
                    $row[] =  $in_patient_enquiry?->ward?->name;
                    break;

                case 'room':
                    $row[] =  $in_patient_enquiry?->room?->name;
                    break;

                case 'bed':
                    $row[] =  $in_patient_enquiry?->bed?->display_name;
                    break;

                case 'doctor':
                    $row[] =  $in_patient_enquiry?->patient_visit?->doctor?->name;
                    break;

                case 'patient_type':
                    $row[] =  $in_patient_enquiry?->patient?->patienttype?->name;
                    break;

                case 'marital_status':
                    $row[] =  $in_patient_enquiry?->patient?->marital_status?->name;
                    break;

                case 'city':
                    $row[] =  $in_patient_enquiry?->patient?->village?->district?->name;
                    break;

                case 'father_name':
                    $row[] =  $in_patient_enquiry?->patient?->father_name;
                    break;

                case 'address':
                    $row[] =  $in_patient_enquiry?->patient?->address;
                    break;

                case 'mobile':
                    $row[] =  $in_patient_enquiry?->patient?->mobile;
                    break;

                case 'admn_type':
                    $row[] =  $in_patient_enquiry?->admin_type?->name;
                    break;

                case 'department':
                    $row[] = $in_patient_enquiry?->department?->name;
                    break;

                case 'cost_center':
                    $row[] = $in_patient_enquiry?->cost_center?->code;
                    break;
            }
        }

        return $row;
    }

    public function collection()
    {
        return $this->data;
    }
}
