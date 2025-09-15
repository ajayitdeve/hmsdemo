<?php

namespace Database\Seeders;

use App\Models\Bloodgroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodgroups = array(
            array('id' => '1', 'name' => 'A+', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '2', 'name' => 'A-', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '3', 'name' => 'B+', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '4', 'name' => 'B-', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '5', 'name' => 'O+', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '6', 'name' => 'O-', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '7', 'name' => 'AB+', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '8', 'name' => 'AB-', 'created_at' => NULL, 'updated_at' => NULL)
        );

        Bloodgroup::insert($bloodgroups);
    }
}
