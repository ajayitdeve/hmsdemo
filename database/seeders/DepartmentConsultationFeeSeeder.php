<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepartmentConsultationFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentConsultationFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentConsultationFees = [
            ['department_id' => 1, 'fee' => 50],
            ['department_id' => 2, 'fee' => 50],
        ];
        DepartmentConsultationFee::insert($departmentConsultationFees);
    }
}
