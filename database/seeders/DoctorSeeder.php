<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $doctors = array(
      array('code' => 'DR01', 'name' => 'Sanjeev', 'alias' => NULL, 'registration_no' => '12345', 'designation' => 'Doctor', 'consulting_room' => NULL, 'email' => 'sanjeev@gmail.com', 'mobile' => '8130271181', 'dob' => '1980-07-17', 'marriage_date' => NULL, 'fee' => '0.00', 'email_verified_at' => NULL, 'password' => '123456789', 'remember_token' => NULL, 'qualification' => NULL, 'about_doctor' => NULL, 'experience' => NULL, 'resigned_date' => NULL, 'specialization1' => '1', 'specialization2' => NULL, 'cost_center_id' => '1', 'payment_type_id' => '1', 'consultation_type_id' => '1', 'doctor_type_id' => '1', 'consulting_type_id' => '1', 'department_id' => '1', 'unit_id' => '2', 'gender_id' => '1', 'specialization_id' => '1', 'created_by_id' => NULL, 'updated_by_id' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
      array('code' => 'DR02', 'name' => 'Parmatma', 'alias' => NULL, 'registration_no' => '123', 'designation' => 'Dr', 'consulting_room' => NULL, 'email' => 'paramata@gmail.com', 'mobile' => '123456789', 'dob' => '1980-07-17', 'marriage_date' => NULL, 'fee' => '0.00', 'email_verified_at' => NULL, 'password' => '8052256423', 'remember_token' => NULL, 'qualification' => NULL, 'about_doctor' => NULL, 'experience' => NULL, 'resigned_date' => NULL, 'specialization1' => '2', 'specialization2' => NULL, 'cost_center_id' => '1', 'payment_type_id' => '1', 'consultation_type_id' => '1', 'doctor_type_id' => '1', 'consulting_type_id' => '1', 'department_id' => '2', 'unit_id' => '4', 'gender_id' => '1', 'specialization_id' => '2', 'created_by_id' => NULL, 'updated_by_id' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
      array('code' => 'DR03', 'name' => 'P Govind', 'alias' => NULL, 'registration_no' => '123', 'designation' => 'Dr', 'consulting_room' => NULL, 'email' => 'pgovind@gmail.com', 'mobile' => '8052256423', 'dob' => '2023-09-29', 'marriage_date' => NULL, 'fee' => '0.00', 'email_verified_at' => NULL, 'password' => '8052256423', 'remember_token' => NULL, 'qualification' => NULL, 'about_doctor' => NULL, 'experience' => NULL, 'resigned_date' => NULL, 'specialization1' => '1', 'specialization2' => NULL, 'cost_center_id' => '1', 'payment_type_id' => '1', 'consultation_type_id' => '2', 'doctor_type_id' => '1', 'consulting_type_id' => '1', 'department_id' => '1', 'unit_id' => '2', 'gender_id' => '1', 'specialization_id' => '1', 'created_by_id' => NULL, 'updated_by_id' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
      array('code' => 'DR04', 'name' => 'M Q Khan', 'alias' => NULL, 'registration_no' => '123456789', 'designation' => 'Dr.', 'consulting_room' => NULL, 'email' => 'mqkhan@gmail.com', 'mobile' => '123456789', 'dob' => '1990-09-30', 'marriage_date' => NULL, 'fee' => '0.00', 'email_verified_at' => NULL, 'password' => 'swadha123!@#', 'remember_token' => NULL, 'qualification' => NULL, 'about_doctor' => NULL, 'experience' => NULL, 'resigned_date' => NULL, 'specialization1' => '1', 'specialization2' => NULL, 'cost_center_id' => '1', 'payment_type_id' => '1', 'consultation_type_id' => '1', 'doctor_type_id' => '1', 'consulting_type_id' => '1', 'department_id' => '1', 'unit_id' => '2', 'gender_id' => '1', 'specialization_id' => '1', 'created_by_id' => NULL, 'updated_by_id' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
      array('code' => 'DR05', 'name' => 'Alok Gupta', 'alias' => NULL, 'registration_no' => '12345', 'designation' => 'Doctor', 'consulting_room' => NULL, 'email' => 'alokgupta@gmail.com', 'mobile' => '80522256423', 'dob' => '1980-07-17', 'marriage_date' => NULL, 'fee' => '0.00', 'email_verified_at' => NULL, 'password' => '8052256423', 'remember_token' => NULL, 'qualification' => NULL, 'about_doctor' => NULL, 'experience' => NULL, 'resigned_date' => NULL, 'specialization1' => '2', 'specialization2' => NULL, 'cost_center_id' => '1', 'payment_type_id' => '1', 'consultation_type_id' => '2', 'doctor_type_id' => '1', 'consulting_type_id' => '1', 'department_id' => '1', 'unit_id' => '2', 'gender_id' => '1', 'specialization_id' => '2', 'created_by_id' => NULL, 'updated_by_id' => NULL, 'created_at' => NULL, 'updated_at' => NULL)
    );
    \App\Models\Doctor::insert($doctors);
  }
}
