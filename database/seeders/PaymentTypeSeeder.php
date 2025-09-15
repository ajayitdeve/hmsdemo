<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_types = array(
            array('name' => 'Salaried', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Honorary', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Both', 'created_at' => now(), 'updated_at' => now())
        );
        \App\Models\PaymentType::insert($payment_types);
    }
}
