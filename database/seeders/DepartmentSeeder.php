<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = array(
            array('name' => 'Orthopedic', 'code' => 'Ortho', 'is_medical' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Pediatric', 'code' => 'Pedia', 'is_medical' => '1', 'created_at' => now(), 'updated_at' => now()),
        );
        \App\Models\Department::insert($departments);
    }
}
