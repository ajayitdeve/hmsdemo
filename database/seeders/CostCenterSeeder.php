<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostCenterSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    \App\Models\CostCenter::create(['name' => 'Narayan Medical College & Hospital', 'code' => 'NMCH']);
  }
}
