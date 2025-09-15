<?php

namespace App\Exports\MonthDayWise;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserWiseReportExport implements FromCollection, WithHeadings, WithMapping
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
                $fields = ["Sr. No.", "User Name", "Day", "Count", "Registration Fee"];
                break;

            case 'admissions':
                $fields = ["Sr. No.", "User Name", "Day", "Count"];
                break;

            case 'consultations':
                $fields = ["Sr. No.", "User Name", "Day", "Count", "Total Amount"];
                break;

            case 'discharges':
                $fields = ["Sr. No.", "User Name", "Day", "Count", "Total Amount"];
                break;
        }

        return $fields;
    }

    public function map($user_wise_report): array
    {
        $this->rowNumber++;
        $row = [];

        switch ($this->type) {
            case 'registrations':
                $row[] = $this->rowNumber;
                $row[] = $user_wise_report?->user_name;
                $row[] = $user_wise_report?->day;
                $row[] = $user_wise_report?->count;
                $row[] = "0";
                break;

            case 'admissions':
                $row[] = $this->rowNumber;
                $row[] = $user_wise_report?->user_name;
                $row[] = $user_wise_report?->day;
                $row[] = $user_wise_report?->count;
                break;

            case 'consultations':
                $row[] = $this->rowNumber;
                $row[] = $user_wise_report?->user_name;
                $row[] = $user_wise_report?->day;
                $row[] = $user_wise_report?->count;
                $row[] = $user_wise_report?->total_amount;
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
