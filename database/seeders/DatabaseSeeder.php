<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Referral;
use App\Models\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    $this->call(GenderSeeder::class);
    // $this->call(TitleSeeder::class);
    $this->call(OccupationSeeder::class);
    $this->call(NationalitySeeder::class);
    $this->call(RelationSeeder::class);
    $this->call(ReligionSeeder::class);
    $this->call(CountrySeeder::class);
    $this->call(StateSeeder::class);
    $this->call(CitySeeder::class);
    // $this->call(PatientTypeSeeder::class);
    $this->call(MaritalSeeder::class);
    $this->call(BloodGroupSeeder::class);
    $this->call(DepartmentSeeder::class);
    // $this->call(CostCenterSeeder::class);

    // $this->call(PermissionSeeder::class);
    // $this->call(RoleSeeder::class);
    // $this->call(EmployeeCategorySeeder::class);

    // $this->call(EmployeeSeeder::class);
    // $this->call(TeamSeeder::class);
    // $this->call(AdminSeeder::class);


    // $this->call(DoctorTypeSeeder::class);
    // $this->call(DepartmentConsultationFeeSeeder::class);
    // $this->call(UnitSeeder::class);
    // $this->Call(PaymentTypeSeeder::class);
    // $this->call(ConsultingTypeSeeder::class);
    // $this->call(ConsultationTypeSeeder::class);

    //pharmacy seeders
    $this->call(TypeSeeder::class);
    $this->call(ItemSpecializationSeeder::class);
    // $this->call(StockPointSeeder::class);
    // $this->call(RoleStockPointSeeder::class);
    $this->call(ItemGroupSeeder::class);
    // $this->call(UomSeeder::class);
    $this->call(CategorySeeder::class);
    $this->call(SpecializationSeeder::class);
    $this->call(ManufacturerSeeder::class);
    $this->call(FormSeeder::class);
    $this->call(GenericSeeder::class);
    $this->call(ItemSeeder::class);
    $this->call(VendorSeeder::class);
    // $this->call(DoctorSeeder::class);
    // $this->call(PurchaseTermSeeder::class);

    // $this->call(StaffSeeder::class);
    // $this->call(HospitalSeeder::class);
    // $this->call(ReferralSelfSeeder::class);

    // Not required
    // $this->call(PatientSeeder::class);
    // $this->call(ReferralSeeder::class);
  }
}
