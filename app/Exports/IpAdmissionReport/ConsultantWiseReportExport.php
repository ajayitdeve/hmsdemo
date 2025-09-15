<?php

namespace App\Exports\IpAdmissionReport;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConsultantWiseReportExport implements FromCollection, WithHeadings, WithMapping
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

    public function map($ip_admission_report): array
    {
        $this->rowNumber++;
        $row = [];

        foreach ($this->selected_export_fields as $field) {
            switch ($field) {
                case 'sr_no':
                    $row[] = $this->rowNumber;
                    break;

                case 'ipd_code':
                    $row[] = $ip_admission_report?->ipdcode;
                    break;

                case 'umr':
                    $row[] = $ip_admission_report?->patient?->registration_no;
                    break;

                case 'patient_name':
                    $row[] = $ip_admission_report?->patient?->name;
                    break;

                case 'age':
                    $row[] = Carbon::parse($ip_admission_report?->patient?->dob)->diff(Carbon::now())->format('%yY') . "(s)";
                    break;

                case 'gender':
                    $row[] = $ip_admission_report?->patient?->gender?->name;
                    break;

                case 'address':
                    $row[] = $ip_admission_report?->patient?->address;
                    break;

                case 'patient_type':
                    $row[] = $ip_admission_report?->patient?->patienttype?->name;
                    break;

                case 'area':
                    $row[] = $ip_admission_report?->patient?->is_rural ? 'Rural' : 'Urban';
                    break;

                case 'admission_date':
                    $row[] = date('Y-m-d', strtotime($ip_admission_report?->created_at));
                    break;

                case 'admn_type':
                    $row[] = $ip_admission_report?->admin_type?->name;
                    break;

                case 'patient_source':
                    $row[] = $ip_admission_report?->patient_source;
                    break;

                case 'doctor_name':
                    $row[] = $ip_admission_report?->patient_visit?->doctor?->name;
                    break;

                case 'department':
                    $row[] = $ip_admission_report?->department?->name;
                    break;

                case 'unit':
                    $row[] = $ip_admission_report?->unit?->name;
                    break;

                case 'ward':
                    $row[] = $ip_admission_report?->ward?->name;
                    break;

                case 'organization_name':
                    $row[] = $ip_admission_report?->corporate_registration?->organization?->name;
                    break;

                case 'purpose':
                    $row[] = $ip_admission_report?->admin_purpose?->name;
                    break;

                case 'created_by':
                    $row[] = $ip_admission_report?->created_by?->name;
                    break;

                case 'created_at':
                    $row[] = $ip_admission_report->created_at;
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
