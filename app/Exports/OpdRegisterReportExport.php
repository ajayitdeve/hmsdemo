<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OpdRegisterReportExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $data;
    private $rowNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return ['Sr. No.', 'UMR', 'Patient Name', 'Patient Type', 'Age', 'Gender', 'Address', 'Created By', 'Created At'];
    }

    public function map($opd_register_report): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $opd_register_report?->registration_no,
            $opd_register_report?->name,
            $opd_register_report?->patienttype?->name,
            Carbon::parse($opd_register_report->dob)->diff(Carbon::now())->format('%yY') . "(s)",
            $opd_register_report?->gender?->name,
            $opd_register_report?->address,
            $opd_register_report?->created_by?->name,
            $opd_register_report->created_at
        ];
    }

    public function collection()
    {
        return $this->data;
    }
}
