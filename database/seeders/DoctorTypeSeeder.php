<?php

namespace Database\Seeders;

use App\Models\DoctorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor_types = array(
            array('name' => 'Physician', 'created_at' => NULL, 'updated_at' => NULL),
            array('name' => 'Surgeon', 'created_at' => NULL, 'updated_at' => NULL),
            array('name' => 'Both', 'created_at' => NULL, 'updated_at' => NULL)
        );
        \App\Models\DoctorType::insert($doctor_types);
    }
}
