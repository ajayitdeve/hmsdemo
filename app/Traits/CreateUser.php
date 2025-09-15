<?php

namespace App\Traits;

use App\Models\Billing;
use App\Models\BillingInvoice;
use App\Models\BillingInvoiceDetail;
use App\Models\BillingTransaction;
use App\Models\Doctor;
use App\Models\DoctorOrder;
use App\Models\Patient;
use App\Models\PatientPackage;
use App\Models\PatientVisit;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait CreateUser
{

    public function createNewUser($user)
    {
        $user_id = User::create($user);
        return $user_id;
    }

    public function createNewPatient($patient)
    {
        $patient_id = Patient::create($patient);
        $curPatient = Patient::find($patient_id->id);
        $curPatient->registration_no = 'UMR' . date('y') . date('m') . $patient_id->id;
        $curPatient->save();
        return $patient_id;
    }

    public function createNewDoctor($doctor)
    {
        $doctor_id = Doctor::create($doctor);
        return $doctor_id;
    }

    public function doctorRegistration($doctor)
    {

        $currentUser = Auth()->user();
        $status = true;
        try {
            DB::beginTransaction();
            //create user using trait
            $user_id = $this->createNewUser([
                'name' => $doctor['name'],
                'email' => $doctor['email'],
                'password' => bcrypt($doctor['mobile'])
            ]);
            //create doctor using trait
            $doctor_id = $this->createNewDoctor([
                'specialist_id' => $doctor['specialist_id'],
                'about_doctor' => $doctor['about_doctor'],
                'charge' => $doctor['charge'],
                'experience' => $doctor['experience'],
                'user_id' => $user_id->id,//last genered id
                'created_by_id' => $currentUser->id,
                'mobile' => $doctor['mobile'],
            ]);
            //checking status for above function i.e. aboove are successfull or not
            $status = $status && $user_id && $doctor_id;
        } catch (\Exception $e) {
            DB::rollBack();
        }
        //if previous DB action are OK
        if ($status) {
            DB::commit();
            return redirect()->route('admin.dashboard');
        } else {
            DB::rollBack();
            return false;
        }
    }

    public function patientRegistration($patient)
    {

        $currentUser = Auth()->user();

        $status = true;
        try {
            DB::beginTransaction();
            $user_id = $this->createNewUser([
                'name' => $patient['name'],
                'email' => $patient['email'],
                'password' => bcrypt($patient['phone'])
            ]);
            //create patient using trait
            $patient_id = $this->createNewPatient([
                'referral_id' => $patient['referral_id'],
                'country_id' => 101,
                'state_id' => $patient['state_id'],
                'city_id' => $patient['city_id'],
                'patient_type' => $patient['patient_type'],
                'title_id' => $patient['title_id'],
                'name' => $patient['name'],
                'dob' => $patient['dob'],
                'gender_id' => $patient['gender_id'],
                'marital_id' => $patient['marital_id'],
                'bloodgroup_id' => $patient['bloodgroup_id'],
                'email' => $patient['email'],
                'phone' => $patient['phone'],
                'religion_id' => $patient['religion_id'],
                'occupation_id' => $patient['occupation_id'],
                'address' => $patient['address'],
                'nationality_id' => $patient['nationality_id'],
                'father_name' => $patient['father_name'],
                'relation_id' => $patient['relation_id'],
                'mother_name' => $patient['mother_name'],
                'user_id' => $user_id->id,
                'created_by_id' => $currentUser->id,
            ]);
            $status = $status && $user_id && $patient_id;
            //create patient_packge only if your is not general i.e. having any package like Auushman Card
            if ($patient['patient_type'] == 1) {
                $patient_package_id = PatientPackage::create([
                    'package_id' => $patient['package_id'],
                    'patient_id' => $patient_id->id,
                    'created_by_id' => $currentUser->id
                ]);
            }
            //creating patient visit
            $patient_visit_id = PatientVisit::create(['visit_no' => 0, 'visit_type' => 0, 'visit_date' => date('Y-m-d'), 'visit_status' => 0, 'description' => 'test', 'patient_id' => $patient_id->id, 'doctor_id' => null, 'unit_id' => $patient['unit_id']]);

            $status = $status && $user_id && $patient_id && $patient_package_id && $patient_visit_id;
            //generating visit no
            $patient_visit = PatientVisit::where('id', $patient_visit_id->id)->first();
            if ($patient_visit) {
                $patient_visit->visit_no = 'OP' . date('y') . date('m') . $patient_visit->id;
                $patient_visit->save();
            }

            //payment module
            //1- create doctor_orders
            $doctor_order_id = DoctorOrder::create([
                'order_no' => 'OP' . (DoctorOrder::max('id')) + 1,
                'order_type' => 0,
                'status' => 0,
                'patient_visit_id' => $patient_visit_id->id,
                'doctor_id' => null,
                'approved_by_id' => $currentUser->id,
                'created_by_id' => $currentUser->id
            ]);
            //2- creating billings
            $billing_id = Billing::create([
                'status' => 1,
                'doctor_order_id' => $doctor_order_id->id,
                'patient_visit_id' => $patient_visit_id->id,
                'created_by_id' => $currentUser->id
            ]);
            //3- create billing_invoices
            $billing_invoice_id = BillingInvoice::create([
                'invoice_number' => 'NMC' . (BillingInvoice::max('id') + 1),
                'total' => 50,
                'pending_amount' => 0,
                'payment_amount' => 50,
                'mood' => 0,
                'discount_type' => null,
                'discount_amount' => 0,
                'discount_note' => null,
                'note' => 'OPD Registration',
                'tax' => 0,
                'additional_fee' => 0,
                'status' => 1,
                'patient_id' => $patient_id->id,
                'patient_visit_id' => $patient_visit_id->id,
                'doctor_order_id' => $doctor_order_id->id,
                'created_by_id' => $currentUser->id
            ]);
            //4- create billing_invoice_details
            $billing_invoice_detail_id = BillingInvoiceDetail::create([
                'item_amount' => 50,
                'item_total_amount' => 50,
                'billing_invoice_id' => $billing_invoice_id->id,
                'created_by_id' => $currentUser->id

            ]);
            //5- create billing_transaction
            $billing_transaction_id = BillingTransaction::create([
                'pending_amount' => 0,
                'payment_amount' => 50,
                'status' => 1,
                'patient_visit_id' => $patient_visit_id->id,
                'billing_invoice_id' => $billing_invoice_id->id,
                'created_by_id' => $currentUser->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
        }
        //if previous DB action are OK
        if ($status) {
            DB::commit();
            return $patient_visit_id->id;
        } else {
            DB::rollBack();
            return false;
        }
    }


}
