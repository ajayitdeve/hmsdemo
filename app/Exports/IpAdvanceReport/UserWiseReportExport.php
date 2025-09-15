<?php

namespace App\Exports\IpAdvanceReport;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserWiseReportExport implements FromCollection, WithHeadings, WithMapping
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

    public function map($ip_advance_report): array
    {
        $this->rowNumber++;
        $row = [];

        foreach ($this->selected_export_fields as $field) {
            switch ($field) {
                case 'sr_no':
                    $row[] = $this->rowNumber;
                    break;

                case 'umr':
                    $row[] = $ip_advance_report?->patient?->registration_no;
                    break;

                case 'patient_name':
                    $row[] = $ip_advance_report?->patient?->name;
                    break;

                case 'ipd_code':
                    $row[] = $ip_advance_report?->ipd?->ipdcode;
                    break;

                case 'admission_date':
                    $row[] = date('Y-m-d', strtotime($ip_advance_report?->ipd?->created_at));
                    break;

                case 'advance_amount':
                    $row[] = $ip_advance_report?->amount;
                    break;

                case 'doctor_name':
                    $row[] = $ip_advance_report?->ipd?->patient_visit?->doctor?->name;
                    break;

                case 'department':
                    $row[] = $ip_advance_report?->ipd?->department?->name;
                    break;

                case 'unit':
                    $row[] = $ip_advance_report?->ipd?->unit?->name;
                    break;

                case 'ward':
                    $row[] = $ip_advance_report?->ipd?->ward?->name;
                    break;

                case 'patient_type':
                    $row[] = $ip_advance_report?->patient?->patienttype?->name;
                    break;

                case 'area':
                    $row[] = $ip_advance_report?->patient?->is_rural ? 'Rural' : 'Urban';
                    break;

                case 'organization_name':
                    $row[] = $ip_advance_report?->ipd?->corporate_registration?->organization?->name;
                    break;

                case 'created_by':
                    $row[] = $ip_advance_report?->created_by?->name;
                    break;

                case 'created_at':
                    $row[] = $ip_advance_report->created_at;
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
