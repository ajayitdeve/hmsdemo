<?php

namespace App\Exports\MonthDayWise;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DepartmentWiseReportExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $data;
    public $type;
    private $rowNumber = 0;

    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function headings(): array
    {
        $fields = [];

        switch ($this->type) {
            case 'registrations':
                $fields = ["Sr. No.", "Department Name", "Day", "Count", "Registration Fee"];
                break;

            case 'admissions':
                $fields = ["Sr. No.", "Department Name", "Day", "Count"];
                break;

            case 'consultations':
                $fields = ["Sr. No.", "Department Name", "Day", "Count", "Total Amount"];
                break;

            case 'discharges':
                $fields = ["Sr. No.", "Department Name", "Day", "Count", "Total Amount"];
                break;
        }

        return $fields;
    }

    public function map($department_wise_report): array
    {
        $this->rowNumber++;
        $row = [];

        switch ($this->type) {
            case 'registrations':
                $row[] = $this->rowNumber;
                $row[] = $department_wise_report?->department_name;
                $row[] = $department_wise_report?->day;
                $row[] = $department_wise_report?->count;
                $row[] = "0";
                break;

            case 'admissions':
                $row[] = $this->rowNumber;
                $row[] = $department_wise_report?->department_name;
                $row[] = $department_wise_report?->day;
                $row[] = $department_wise_report?->count;
                break;

            case 'consultations':
                $row[] = $this->rowNumber;
                $row[] = $department_wise_report?->department_name;
                $row[] = $department_wise_report?->day;
                $row[] = $department_wise_report?->count;
                $row[] = $department_wise_report?->total_amount;
                break;

            case 'discharges':

                break;
        }

        return $row;
    }

    public function collection()
    {
        return $this->data;
    }
}
