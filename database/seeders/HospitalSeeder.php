<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = [
            ['name' => 'City Hospital', 'address' => 'Medical College Road Gorakhpur', 'mobile' => '1234567890', 'email' => 'cityhospital@gorakhpur.com']
        ];
        \App\Models\Hospital::insert($hospitals);
    }
}
