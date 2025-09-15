<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occupations = array(
            array('id' => '1', 'name' => 'Farmer', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '2', 'name' => 'Pvt. Job', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '3', 'name' => 'Govt Job', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '4', 'name' => 'Self Employed', 'created_at' => now(), 'updated_at' => now())
        );
        Occupation::insert($occupations);
    }
}
