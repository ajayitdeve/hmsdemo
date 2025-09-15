<?php

namespace Database\Seeders;

use App\Models\PatientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientTypes = [
            ['name' => 'General', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Package', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Insurance', 'created_at' => now(), 'updated_at' => now()]
        ];
        PatientType::insert($patientTypes);
    }
}
