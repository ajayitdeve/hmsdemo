<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')

        ])->assignRole('admin');

        // User::create([
        //     'name' => 'superadmin',
        //     'email' => 'superadmin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password')

        // ])->assignRole('superadmin');

        // User::create([
        //     'name' => 'Central Pharmacy',
        //     'email' => 'centralpharmacy@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password')

        // ])->assignRole('pharmacy');

        // User::create([
        //     'name' => 'OP Pharmacy',
        //     'email' => 'oppharmacy@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password')

        // ])->assignRole('ot-pharmacy');
        // User::create([
        //     'name' => 'OT Pharmacy',
        //     'email' => 'otpharmacy@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password')

        // ])->assignRole('ot-pharmacy');
        // User::create([
        //     'name' => 'Emergency Pharmacy',
        //     'email' => 'emgpharmacy@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password')

        // ])->assignRole('emg-pharmacy');
        // User::create([
        //     'name' => 'OPD Coordinator',
        //     'email' => 'opdco@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password')

        // ])->assignRole('opd-coordinator');
    }
}
