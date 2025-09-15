<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OutPatientConsultationCancellationReportExport implements FromCollection, WithHeadings, WithMapping
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

    public function map($out_patient_consultation_cancellation): array
    {
        $this->rowNumber++;
        $row = [];

        foreach ($this->selected_export_fields as $field) {
            switch ($field) {
                case 'sr_no':
                    $row[] = $this->rowNumber;
                    break;

                case 'visit_code':
                    $row[] = $out_patient_consultation_cancellation?->visit_no;
                    break;

                case 'cancel_date':
                    $row[] = date('Y-m-d', strtotime($out_patient_consultation_cancellation?->deleted_at));
                    break;

                case 'visit_date':
                    $row[] = date('Y-m-d', strtotime($out_patient_consultation_cancellation?->visit_date));
                    break;

                case 'umr':
                    $row[] = $out_patient_consultation_cancellation?->patient?->registration_no;
                    break;

                case 'patient_name':
                    $row[] = $out_patient_consultation_cancellation?->patient?->name;
                    break;

                case 'doctor_name':
                    $row[] = $out_patient_consultation_cancellation?->doctor?->name;
                    break;

                case 'department_name':
                    $row[] = $out_patient_consultation_cancellation?->department?->name;
                    break;

                case 'unit_name':
                    $row[] = $out_patient_consultation_cancellation?->unit?->name;
                    break;

                case 'amount':
                    $row[] = $out_patient_consultation_cancellation?->fee;
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
