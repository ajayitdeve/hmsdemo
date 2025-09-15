<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OpConsultationReportExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

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

    public function map($op_consultation_report): array
    {
        $this->rowNumber++;
        $row = [];

        foreach ($this->selected_export_fields as $field) {
            switch ($field) {
                case 'sr_no':
                    $row[] = $this->rowNumber;
                    break;

                case 'umr':
                    $row[] = $op_consultation_report?->patient?->registration_no;
                    break;

                case 'patient_name':
                    $row[] = $op_consultation_report?->patient?->name;
                    break;

                case 'patient_type':
                    $row[] = $op_consultation_report?->patient?->patienttype?->name;
                    break;

                case 'area':
                    $row[] = $op_consultation_report?->patient?->is_rural ? 'Rural' : 'Urban';
                    break;

                case 'ipd_code':
                    $row[] = $op_consultation_report?->ipd?->ipdcode;
                    break;

                case 'organization_name':
                    $row[] = $op_consultation_report?->ipd?->corporate_registration?->organization?->name;
                    break;

                case 'age':
                    $row[] = Carbon::parse($op_consultation_report?->patient?->dob)->diff(Carbon::now())->format('%yY') . "(s)";
                    break;

                case 'gender':
                    $row[] = $op_consultation_report?->patient?->gender?->name;
                    break;

                case 'address':
                    $row[] = $op_consultation_report?->patient?->address;
                    break;

                case 'consult_no':
                    $row[] = $op_consultation_report?->visit_no;
                    break;

                case 'consult_date':
                    $row[] = $op_consultation_report?->visit_date;
                    break;

                case 'doctor_name':
                    $row[] = $op_consultation_report?->doctor?->name;
                    break;

                case 'visit_type':
                    $row[] = $op_consultation_report?->visitType?->name;
                    break;

                case 'department':
                    $row[] = $op_consultation_report?->department?->name;
                    break;

                case 'unit':
                    $row[] = $op_consultation_report?->unit?->name;
                    break;

                case 'consult_fee':
                    $row[] = $op_consultation_report?->fee;
                    break;

                case 'foc':
                    $row[] = $op_consultation_report?->foc ? 'Yes' : 'No';
                    break;

                case 'consult_status':
                    $row[] = $op_consultation_report?->patient?->patientvisits?->count() > 1 ? 'Old' : 'New';
                    break;

                case 'created_by':
                    $row[] = $op_consultation_report?->created_by?->name;
                    break;

                case 'created_at':
                    $row[] = $op_consultation_report->created_at;
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
