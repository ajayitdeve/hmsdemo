<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'pharmacy']);
        Role::create(['name' => 'op-pharmacy']);
        Role::create(['name' => 'ot-pharmacy']);
        Role::create(['name' => 'emg-pharmacy']);
        Role::create(['name' => 'opd-coordinator']);
        Role::create(['name' => 'front-desk']);
        Role::create(['name' => 'lab']);
        Role::create(['name' => 'nurse']);
        Role::create(['name' => 'OT User']);
        Role::create(['name' => 'blood-bank']);
    }
}
