<?php

namespace Database\Seeders;

use App\Models\PurchaseTerm;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PurchaseTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchaseTerms = [
            [
                'code' => 'POT1',
                'name' => 'Swami Stor',
                'details' => 'ITEM DELIVERY TIME WITHIN ONE WEEK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'POT2',
                'name' => 'SAKASH ENTE',
                'details' => 'WARRANTY_TWO YEARS',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
        PurchaseTerm::insert($purchaseTerms);
    }
}
