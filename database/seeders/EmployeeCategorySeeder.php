<?php

namespace Database\Seeders;

use App\Models\EmployeeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeCategory::create([
            'name' => 'Administration',
            'code' => 'DRG1',
            'created_by_id' => 1,
        ]);

        EmployeeCategory::create([
            'name' => 'Medical',
            'code' => 'DRG2',
            'created_by_id' => 1,
        ]);

        EmployeeCategory::create([
            'name' => 'Non Medical',
            'code' => 'DRG3',
            'created_by_id' => 1,
        ]);

        EmployeeCategory::create([
            'name' => 'Nursing',
            'code' => 'DRG4',
            'created_by_id' => 1,
        ]);
    }
}
