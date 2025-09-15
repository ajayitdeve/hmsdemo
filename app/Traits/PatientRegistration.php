<?php

namespace App\Traits;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;

trait PatientRegistration
{

    protected function registrationNo(): string
    {
        // $currentPatientId=Patient::max('id');
        $currentDate = date('Y-m-d');
        $count = Patient::where('registration_date', $currentDate)->count();
        $registrationNo = 'UMR' . date('y') . date('m') . date('d') . ($count + 1);
        return $registrationNo;
    }

    //'registration_no', 'password', 'registration_date', 'name', 'email', 'mobile', 'dob', 'age', 'address', 'village_id', 'pincode', 'father_name'
    // 'mother_name', 'patient_type_id', 'title_id', 'gender_id', 'marital_id', 'bloodgroup_id', 'religion_id', 'occupation_id', 'nationality_id', 'relation_id', 'is_rural', 'created_by_id'
    public function patientRegistration($patient)
    {
        $currentUser = Auth()->user();
        $newPatient = new Patient();
        $newPatient->registration_no = $this->registrationNo();
        $newPatient->password = bcrypt($this->registrationNo());
        $newPatient->registration_date = date('Y-m-d');
        $newPatient->name = $patient['name'];
        $newPatient->email = $patient['email'];
        $newPatient->mobile = $patient['mobile'];
        $newPatient->dob = $patient['dob'];
        $newPatient->age = $patient['age'];
        $newPatient->address = $patient['address'];
        $newPatient->village_id = $patient['village_id'];
        $newPatient->pincode = $patient['pincode'];
        $newPatient->father_name = $patient['father_name'];
        $newPatient->mother_name = $patient['mother_name'];
        //   $newPatient->referral_id=$patient['referral_id'];
        $newPatient->patient_type_id = $patient['patient_type_id'];
        $newPatient->title_id = $patient['title_id'];
        $newPatient->gender_id = $patient['gender_id'];
        $newPatient->marital_id = $patient['marital_id'];
        $newPatient->bloodgroup_id = $patient['bloodgroup_id'] != null ? $patient['bloodgroup_id'] : null;
        $newPatient->religion_id = $patient['religion_id'];
        $newPatient->occupation_id = $patient['occupation_id'];
        $newPatient->nationality_id = $patient['nationality_id'];
        $newPatient->is_rural = $patient['is_rural'];
        $newPatient->relation_id = $patient['relation_id'];
        $newPatient->created_by_id = $currentUser->id;
        //added for identification no
        $newPatient->id_type_id = $patient['id_type_id'];
        $newPatient->identification_no = $patient['identification_no'];
        //remarks
        $newPatient->remarks = $patient['remarks'];
        $patient_id = $newPatient->save();
        return $newPatient->id; //returning last inserted id
    }
}
