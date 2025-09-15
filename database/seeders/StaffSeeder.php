<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffs = [
            ['name' => 'Ramesh', 'father_name' => 'Shri Mukesh', 'mobile' => '1234567890', 'department_id' => '1']
        ];
        \App\Models\Staff::insert($staffs);
    }
}
