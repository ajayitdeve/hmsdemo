<?php

namespace Database\Seeders;

use App\Models\DischargeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DischargeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discharge_types = [
            [
                "name" => "Discharged",
                "description" => "Discharged",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Expired",
                "description" => "Expired",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "LAMA",
                "description" => "LAMA",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Improved",
                "description" => "Improved",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Hospital Transfered",
                "description" => "Hospital Transfered",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "MLC",
                "description" => "MLC",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Infant Death",
                "description" => "Infant Death",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Maternal Death",
                "description" => "Maternal Death",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        DischargeType::insert($discharge_types);
    }
}
