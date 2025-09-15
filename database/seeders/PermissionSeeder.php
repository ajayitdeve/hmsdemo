<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = array(
            array('name' => 'role_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_user_profile_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_roles_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'permission_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_permissions_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'employee_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_employees_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'user_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_users_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'gender_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'title_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'relation_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'marital_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'bloodgroup_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'religion_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'occupation_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'department_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'unit_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'category_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'designation_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'doctor_specialization_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'referral_other_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'health_coordinator_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'country_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'state_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'district_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'block_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'village_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'abnormal_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'equipment_group_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'equipment_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ot_type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ot_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'surgery_type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'surgery_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'anesthesia_type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'case_type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'admission_type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'admission_purpose_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'bag_type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($admin_permissions);


        $central_pharmacy_permissions = array(
            array('name' => 'pharmacy_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'type_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'stock_point_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'item_group_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'generic_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'form_UOM_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'category_pharmacy_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'specialization_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'manufacturer_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'add_item_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'bin_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'bin_group_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'add_item_to_bin_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'purchase_and_issue_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'add_vendor_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'purchase_indent_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'purchase_order_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'goods_receipt_notes_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_mrq_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'gin_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'central_pharmacy_medicine_sale_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'inventory_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'sales_stores_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'purchase_report_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_cancel_receipts_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($central_pharmacy_permissions);


        $nursing_permissions = array(
            array('name' => 'nurse_patients_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'nurse_patient_list_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'drug_managements_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'drug_indents_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'service_lab_indents_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'lab_indents_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($nursing_permissions);


        $opd_coordinator_permissions = array(
            array('name' => 'consultations_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'assign_doctor_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'refer_patient_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($opd_coordinator_permissions);


        $op_pharmacy_permissions = array(
            array('name' => 'mrq_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'op_pharmacy_all_mrq_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'create_mrq_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'internal_transfer_GIN_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_gin_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'scrap_transfer_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'scrap_transfer_create_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'scrap_transfer_list_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'op_pharmacy_inventory_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'new_issued_items_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_items_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'medicine_sale_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'cancel_medicine_sale_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'op_pharmacy_all_cancel_receipts_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'return_medicine_sale_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($op_pharmacy_permissions);


        $lab_permissions = array(
            array('name' => 'central_lab_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'sample_collection_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'diagnostic_result_entry_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'diagnostic_result_list_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ipd_sample_collection_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ipd_diagnostic_result_entry_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ipd_diagnostic_result_list_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($lab_permissions);


        $ot_permissions = array(
            array('name' => 'ot_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ot_scheduling_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ot_pre_booking_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ot_booking_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'day_care_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'pre_operartion_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'pre_operartion_checklist_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'post_operartion_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($ot_permissions);


        $blood_bank_permissions = array(
            array('name' => 'blood_requisition_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'blood_requisition_request_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'donor_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'donor_registration_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'donor_questionnaire_consent_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'donor_bleeding_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'transfusion_reaction_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'transfusion_reaction_return_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );
        Permission::insert($blood_bank_permissions);


        $permissions = array(
            array('name' => 'consultation_charges_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'department_fee_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'doctor_fee_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'change_consultation_fee_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'service_charges_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'billing_head_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'location_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'teriff_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'service_group_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'service_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'package_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'opd_patient_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'new_patient_reg_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'reg_with_consultation_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_patients_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_consultations_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'old_consultations_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'opd_billing_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'cancel_bill_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_opd_billing_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'today_cash_collection_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'cash_collection_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'ipd_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'nurse_station_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ward_teriff_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ward_group_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ward_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'room_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ipd_registration_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ipd_list_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'corporate_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'corporate_registration_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_corporate_registration_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'organization_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'corporate_relation_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'organization_tariff_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'wallet_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'doctor_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'doctor_registration_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'central_lab_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'parameter_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'test_format_setup_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'template_setup_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'antibiotic_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'organism_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'specimen_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'vacutaine_master_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'specimen_setup_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'reports_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'op_consultation_report_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'op_register_report_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'medicine_issues_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ip_pharmacy_billing_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'all_ip_pharmacy_billing_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'adt_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ip_service_create_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ip_services_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'patient_wise_credit_limit_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),


            array('name' => 'dashboard_admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_cental_pharmacy', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_op_pharmacy', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_opd_coordinator', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_front_desk', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_lab', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_nurse', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_ot', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'dashboard_blood_bank', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'choose_stock_point_menu', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()),
        );

        Permission::insert($permissions);
    }
}
