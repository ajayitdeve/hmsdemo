<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $patients = array(
      array('registration_no' => 'UMR2310051', 'password' => '$2y$10$spHkTVA2Ia91ONItHLobqe4mFgC0k9w4ukc0PznhbCzT/X9rkHagu', 'registration_date' => '2023-10-05', 'name' => 'Ajay', 'email' => 'Ajay', 'mobile' => '123456789', 'dob' => '1980-07-17', 'age' => '43 years, 2 months and 18 days', 'address' => 'test', 'pincode' => NULL, 'father_name' => 'DPP', 'mother_name' => 'Usha', 'patient_type_id' => '2', 'country_id' => '101', 'state_id' => '4023', 'city_id' => '57837', 'title_id' => '2', 'gender_id' => '1', 'marital_id' => '1', 'bloodgroup_id' => '1', 'religion_id' => '1', 'occupation_id' => '1', 'nationality_id' => '1', 'relation_id' => '1', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => '2023-10-05 07:00:20', 'updated_at' => '2023-10-05 07:00:20'),
      array('registration_no' => 'UMR2310052', 'password' => '$2y$10$5dapD2.pWkDKZx0I5RtNd.n3vZhW/f75/VUjFHYO9tsHseOGS8g1K', 'registration_date' => '2023-10-05', 'name' => 'Rajat', 'email' => 'Rajat', 'mobile' => '1234567890', 'dob' => '1980-07-17', 'age' => '43 years, 2 months and 18 days', 'address' => 'test', 'pincode' => NULL, 'father_name' => 'DP ', 'mother_name' => 'Usha', 'patient_type_id' => '1', 'country_id' => '101', 'state_id' => '4026', 'city_id' => '57848', 'title_id' => '3', 'gender_id' => '1', 'marital_id' => '1', 'bloodgroup_id' => '6', 'religion_id' => '1', 'occupation_id' => '1', 'nationality_id' => '1', 'relation_id' => '1', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => '2023-10-05 09:36:24', 'updated_at' => '2023-10-05 09:36:24'),
      array('registration_no' => 'UMR2310053', 'password' => '$2y$10$neyp3dnP5XNAjTmnmzysgOS1SB5o1M9bwIMozxLr/pxK5xYDI303G', 'registration_date' => '2023-10-05', 'name' => 'Nitin', 'email' => 'Nitin', 'mobile' => '1234567890', 'dob' => '1980-07-17', 'age' => '43 years, 2 months and 18 days', 'address' => 'test', 'pincode' => NULL, 'father_name' => 'DPP', 'mother_name' => 'Usha', 'patient_type_id' => '2', 'country_id' => '101', 'state_id' => '4026', 'city_id' => '57814', 'title_id' => '1', 'gender_id' => '1', 'marital_id' => '2', 'bloodgroup_id' => '2', 'religion_id' => '1', 'occupation_id' => '1', 'nationality_id' => '2', 'relation_id' => '2', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => '2023-10-05 11:11:13', 'updated_at' => '2023-10-05 11:11:13')
    );
    $referrals = array(
      array('name' => 'Doctor', 'referrable_type' => '\\App\\Models\\Doctor', 'referrable_id' => '3', 'patient_id' => '1', 'created_at' => '2023-10-05 07:00:20', 'updated_at' => '2023-10-05 07:00:20'),
      array('name' => 'Self', 'referrable_type' => '\\App\\Models\\ReferralSelf', 'referrable_id' => '1', 'patient_id' => '2', 'created_at' => '2023-10-05 09:36:24', 'updated_at' => '2023-10-05 09:36:24'),
      array('name' => 'Self', 'referrable_type' => '\\App\\Models\\ReferralSelf', 'referrable_id' => '1', 'patient_id' => '3', 'created_at' => '2023-10-05 11:11:13', 'updated_at' => '2023-10-05 11:11:13')
    );

    \App\Models\Patient::insert($patients);
    \App\Models\Referral::insert($referrals);
  }
}
