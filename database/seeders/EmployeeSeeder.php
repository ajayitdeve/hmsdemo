<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'employee_category_id' => 1,
            'employee_code' => 'admin@gmail.com',
            'title_id' => 1,
            'employee_name' => "Admin",
            'gender_id' => 1,
            'relation_id' => 1,
            'father_name' => "Admin Father",
            'dob' => "1999-05-05",
            'doj' => "2025-08-12",
            'religion_id' => 1,
            'nationality_id' => 1,
            'marital_id' => 1,
            'qualification' => "12th",
            'qualified_university' => "Delhi University",
            'department_id' => 1,
            'designation_id' => 1,
            'is_hod' => 1,
            'cost_center_id' => 1,
            'bloodgroup_id' => 3,
            'mobile' => "9058091862",
            'email' => "admin@gmail.com",
            'pincode' => "282006",
            'village_id' => 1,
            'address' => "BANSBARI, Block-ARARIA , District-ARARIA ,BIHAR",
            'created_by_id' => 1,
        ]);
    }
}
