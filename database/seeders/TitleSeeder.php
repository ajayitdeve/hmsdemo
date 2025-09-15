<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Title::create(['name' => 'Mr.', 'gender_id' => 1]);
        Title::create(['name' => 'Miss.', 'gender_id' => 2]);
        Title::create(['name' => 'Mrs.', 'gender_id' => 2]);
        Title::create(['name' => 'Shri.', 'gender_id' => 1]);
    }
}
