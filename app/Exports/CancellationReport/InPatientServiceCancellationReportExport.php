<?php

namespace App\Exports\CancellationReport;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InPatientServiceCancellationReportExport implements FromCollection, WithHeadings, WithMapping
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

    public function map($cancellation_report): array
    {
        $this->rowNumber++;
        $row = [];

        foreach ($this->selected_export_fields as $field) {
            switch ($field) {
                case 'sr_no':
                    $row[] = $this->rowNumber;
                    break;

                case 'ipd_code':
                    $row[] = $cancellation_report?->lab_indent?->ipd?->ipdcode;
                    break;

                case 'cancel_date':
                    $row[] = $cancellation_report?->service_date;
                    break;

                case 'service_date':
                    $row[] = $cancellation_report?->service_date;
                    break;

                case 'umr':
                    $row[] = $cancellation_report?->lab_indent?->patient?->registration_no;
                    break;

                case 'patient_name':
                    $row[] = $cancellation_report?->lab_indent?->patient?->name;
                    break;

                case 'service_name':
                    $row[] = $cancellation_report?->service?->name;
                    break;

                case 'service_code':
                    $row[] = $cancellation_report?->service?->code;
                    break;

                case 'service_group':
                    $row[] = $cancellation_report?->service?->servicegroup?->name;
                    break;

                case 'qty':
                    $row[] = $cancellation_report?->quantity;
                    break;

                case 'rate':
                    $row[] = $cancellation_report?->unit_service_price;
                    break;

                case 'amount':
                    $row[] = $cancellation_report?->amount;
                    break;

                case 'discount':
                    $row[] = $cancellation_report?->discount;
                    break;

                case 'total':
                    $row[] = $cancellation_report?->total;
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
