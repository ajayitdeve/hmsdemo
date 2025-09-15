<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SidebarPolicy
{
    use HandlesAuthorization;

    // public function before(User $user, string $ability): bool|null
    // {
    //     if (provide_all_permission($user)) {
    //         return true;
    //     }

    //     return null;
    // }
    public function dashboard_admin(?User $user)
    {
        return $user->can('dashboard_admin');
    }
    public function dashboard_cental_pharmacy(?User $user)
    {
        return $user->can('dashboard_cental_pharmacy');
    }
    public function dashboard_op_pharmacy(?User $user)
    {
        return $user->can('dashboard_op_pharmacy');
    }
    public function dashboard_opd_coordinator(?User $user)
    {
        return $user->can('dashboard_opd_coordinator');
    }
    public function dashboard_front_desk(?User $user)
    {
        return $user->can('dashboard_front_desk');
    }
    public function dashboard_lab(?User $user)
    {
        return $user->can('dashboard_lab');
    }
    public function dashboard_nurse(?User $user)
    {
        return $user->can('dashboard_nurse');
    }
    public function dashboard_ot(?User $user)
    {
        return $user->can('dashboard_ot');
    }
    public function dashboard_blood_bank(?User $user)
    {
        return $user->can('dashboard_blood_bank');
    }

    public function superadminadmin(?User $user)
    {
        return $user->can('superadminadmin');
    }

    public function dashboard_ot_pharmacy(?User $user)
    {
        return $user->can('dashboard_ot_pharmacy');
    }

    public function dashboard_emg_pharmacy(?User $user)
    {
        return $user->can('dashboard_emg_pharmacy');
    }

    public function role_menu(?User $user)
    {
        return $user->can('role_menu');
    }
    public function all_user_profile_menu(?User $user)
    {
        return $user->can('all_user_profile_menu');
    }
    public function all_roles_menu(?User $user)
    {
        return $user->can('all_roles_menu');
    }
    public function permission_menu(?User $user)
    {
        return $user->can('permission_menu');
    }
    public function all_permissions_menu(?User $user)
    {
        return $user->can('all_permissions_menu');
    }
    public function employee_menu(?User $user)
    {
        return $user->can('employee_menu');
    }
    public function all_employees_menu(?User $user)
    {
        return $user->can('all_employees_menu');
    }
    public function user_menu(?User $user)
    {
        return $user->can('user_menu');
    }
    public function all_users_menu(?User $user)
    {
        return $user->can('all_users_menu');
    }
    public function master_menu(?User $user)
    {
        return $user->can('master_menu');
    }
    public function gender_master_menu(?User $user)
    {
        return $user->can('gender_master_menu');
    }
    public function title_master_menu(?User $user)
    {
        return $user->can('title_master_menu');
    }
    public function relation_master_menu(?User $user)
    {
        return $user->can('relation_master_menu');
    }
    public function marital_master_menu(?User $user)
    {
        return $user->can('marital_master_menu');
    }
    public function bloodgroup_master_menu(?User $user)
    {
        return $user->can('bloodgroup_master_menu');
    }
    public function religion_master_menu(?User $user)
    {
        return $user->can('religion_master_menu');
    }
    public function occupation_master_menu(?User $user)
    {
        return $user->can('occupation_master_menu');
    }
    public function department_master_menu(?User $user)
    {
        return $user->can('department_master_menu');
    }
    public function unit_master_menu(?User $user)
    {
        return $user->can('unit_master_menu');
    }
    public function category_master_menu(?User $user)
    {
        return $user->can('category_master_menu');
    }
    public function designation_master_menu(?User $user)
    {
        return $user->can('designation_master_menu');
    }
    public function doctor_specialization_master_menu(?User $user)
    {
        return $user->can('doctor_specialization_master_menu');
    }
    public function referral_other_master_menu(?User $user)
    {
        return $user->can('referral_other_master_menu');
    }
    public function health_coordinator_master_menu(?User $user)
    {
        return $user->can('health_coordinator_master_menu');
    }
    public function country_master_menu(?User $user)
    {
        return $user->can('country_master_menu');
    }
    public function state_master_menu(?User $user)
    {
        return $user->can('state_master_menu');
    }
    public function district_master_menu(?User $user)
    {
        return $user->can('district_master_menu');
    }
    public function block_master_menu(?User $user)
    {
        return $user->can('block_master_menu');
    }
    public function village_master_menu(?User $user)
    {
        return $user->can('village_master_menu');
    }
    public function abnormal_master_menu(?User $user)
    {
        return $user->can('abnormal_master_menu');
    }
    public function equipment_group_master_menu(?User $user)
    {
        return $user->can('equipment_group_master_menu');
    }
    public function equipment_master_menu(?User $user)
    {
        return $user->can('equipment_master_menu');
    }
    public function ot_type_master_menu(?User $user)
    {
        return $user->can('ot_type_master_menu');
    }
    public function ot_master_menu(?User $user)
    {
        return $user->can('ot_master_menu');
    }
    public function surgery_type_master_menu(?User $user)
    {
        return $user->can('surgery_type_master_menu');
    }
    public function surgery_master_menu(?User $user)
    {
        return $user->can('surgery_master_menu');
    }
    public function anesthesia_type_master_menu(?User $user)
    {
        return $user->can('anesthesia_type_master_menu');
    }
    public function case_type_master_menu(?User $user)
    {
        return $user->can('case_type_master_menu');
    }
    public function admission_type_master_menu(?User $user)
    {
        return $user->can('admission_type_master_menu');
    }
    public function admission_purpose_master_menu(?User $user)
    {
        return $user->can('admission_purpose_master_menu');
    }
    public function bag_type_master_menu(?User $user)
    {
        return $user->can('bag_type_master_menu');
    }
    public function pharmacy_master_menu(?User $user)
    {
        return $user->can('pharmacy_master_menu');
    }
    public function type_master_menu(?User $user)
    {
        return $user->can('type_master_menu');
    }
    public function stock_point_master_menu(?User $user)
    {
        return $user->can('stock_point_master_menu');
    }
    public function item_group_master_menu(?User $user)
    {
        return $user->can('item_group_master_menu');
    }
    public function generic_master_menu(?User $user)
    {
        return $user->can('generic_master_menu');
    }
    public function form_UOM_master_menu(?User $user)
    {
        return $user->can('form_UOM_master_menu');
    }
    public function category_pharmacy_master_menu(?User $user)
    {
        return $user->can('category_pharmacy_master_menu');
    }
    public function specialization_menu(?User $user)
    {
        return $user->can('specialization_menu');
    }
    public function manufacturer_menu(?User $user)
    {
        return $user->can('manufacturer_menu');
    }
    public function add_item_menu(?User $user)
    {
        return $user->can('add_item_menu');
    }
    public function bin_menu(?User $user)
    {
        return $user->can('bin_menu');
    }
    public function bin_group_menu(?User $user)
    {
        return $user->can('bin_group_menu');
    }
    public function add_item_to_bin_menu(?User $user)
    {
        return $user->can('add_item_to_bin_menu');
    }
    public function purchase_and_issue_menu(?User $user)
    {
        return $user->can('purchase_and_issue_menu');
    }
    public function add_vendor_menu(?User $user)
    {
        return $user->can('add_vendor_menu');
    }
    public function purchase_indent_menu(?User $user)
    {
        return $user->can('purchase_indent_menu');
    }
    public function purchase_order_menu(?User $user)
    {
        return $user->can('purchase_order_menu');
    }
    public function goods_receipt_notes_menu(?User $user)
    {
        return $user->can('goods_receipt_notes_menu');
    }
    public function all_mrq_menu(?User $user)
    {
        return $user->can('all_mrq_menu');
    }
    public function gin_menu(?User $user)
    {
        return $user->can('gin_menu');
    }
    public function central_pharmacy_medicine_sale_menu(?User $user)
    {
        return $user->can('central_pharmacy_medicine_sale_menu');
    }
    public function inventory_menu(?User $user)
    {
        return $user->can('inventory_menu');
    }
    public function sales_stores_menu(?User $user)
    {
        return $user->can('sales_stores_menu');
    }
    public function purchase_report_menu(?User $user)
    {
        return $user->can('purchase_report_menu');
    }
    public function all_cancel_receipts_menu(?User $user)
    {
        return $user->can('all_cancel_receipts_menu');
    }
    public function nurse_patients_menu(?User $user)
    {
        return $user->can('nurse_patients_menu');
    }
    public function nurse_patient_list_menu(?User $user)
    {
        return $user->can('nurse_patient_list_menu');
    }
    public function drug_managements_menu(?User $user)
    {
        return $user->can('drug_managements_menu');
    }
    public function drug_indents_menu(?User $user)
    {
        return $user->can('drug_indents_menu');
    }
    public function service_lab_indents_menu(?User $user)
    {
        return $user->can('service_lab_indents_menu');
    }
    public function lab_indents_menu(?User $user)
    {
        return $user->can('lab_indents_menu');
    }
    public function consultation_menu(?User $user)
    {
        return $user->can('consultation_menu');
    }
    public function assign_doctor_menu(?User $user)
    {
        return $user->can('assign_doctor_menu');
    }
    public function refer_patient_menu(?User $user)
    {
        return $user->can('refer_patient_menu');
    }
    public function mrq_menu(?User $user)
    {
        return $user->can('mrq_menu');
    }
    public function op_pharmacy_all_mrq_menu(?User $user)
    {
        return $user->can('op_pharmacy_all_mrq_menu');
    }
    public function create_mrq_menu(?User $user)
    {
        return $user->can('create_mrq_menu');
    }
    public function internal_transfer_GIN_menu(?User $user)
    {
        return $user->can('internal_transfer_GIN_menu');
    }
    public function all_gin_menu(?User $user)
    {
        return $user->can('all_gin_menu');
    }
    public function scrap_transfer_menu(?User $user)
    {
        return $user->can('scrap_transfer_menu');
    }
    public function scrap_transfer_create_menu(?User $user)
    {
        return $user->can('scrap_transfer_create_menu');
    }
    public function scrap_transfer_list_menu(?User $user)
    {
        return $user->can('scrap_transfer_list_menu');
    }
    public function op_pharmacy_inventory_menu(?User $user)
    {
        return $user->can('op_pharmacy_inventory_menu');
    }
    public function new_issued_items_menu(?User $user)
    {
        return $user->can('new_issued_items_menu');
    }
    public function all_items_menu(?User $user)
    {
        return $user->can('all_items_menu');
    }
    public function medicine_sale_menu(?User $user)
    {
        return $user->can('medicine_sale_menu');
    }
    public function cancel_medicine_sale_menu(?User $user)
    {
        return $user->can('cancel_medicine_sale_menu');
    }
    public function op_pharmacy_all_cancel_receipts_menu(?User $user)
    {
        return $user->can('op_pharmacy_all_cancel_receipts_menu');
    }
    public function return_medicine_sale_menu(?User $user)
    {
        return $user->can('return_medicine_sale_menu');
    }
    public function central_lab_menu(?User $user)
    {
        return $user->can('central_lab_menu');
    }
    public function sample_collection_menu(?User $user)
    {
        return $user->can('sample_collection_menu');
    }
    public function diagnostic_result_entry_menu(?User $user)
    {
        return $user->can('diagnostic_result_entry_menu');
    }
    public function diagnostic_result_list_menu(?User $user)
    {
        return $user->can('diagnostic_result_list_menu');
    }
    public function ipd_sample_collection_menu(?User $user)
    {
        return $user->can('ipd_sample_collection_menu');
    }
    public function ipd_diagnostic_result_entry_menu(?User $user)
    {
        return $user->can('ipd_diagnostic_result_entry_menu');
    }
    public function ipd_diagnostic_result_list_menu(?User $user)
    {
        return $user->can('ipd_diagnostic_result_list_menu');
    }
    public function ot_menu(?User $user)
    {
        return $user->can('ot_menu');
    }
    public function ot_scheduling_menu(?User $user)
    {
        return $user->can('ot_scheduling_menu');
    }
    public function ot_pre_booking_menu(?User $user)
    {
        return $user->can('ot_pre_booking_menu');
    }
    public function ot_booking_menu(?User $user)
    {
        return $user->can('ot_booking_menu');
    }
    public function day_care_menu(?User $user)
    {
        return $user->can('day_care_menu');
    }
    public function pre_operartion_menu(?User $user)
    {
        return $user->can('pre_operartion_menu');
    }
    public function pre_operartion_checklist_menu(?User $user)
    {
        return $user->can('pre_operartion_checklist_menu');
    }
    public function post_operartion_menu(?User $user)
    {
        return $user->can('post_operartion_menu');
    }
    public function blood_requisition_menu(?User $user)
    {
        return $user->can('blood_requisition_menu');
    }
    public function blood_requisition_request_menu(?User $user)
    {
        return $user->can('blood_requisition_request_menu');
    }
    public function donor_menu(?User $user)
    {
        return $user->can('donor_menu');
    }
    public function donor_registration_menu(?User $user)
    {
        return $user->can('donor_registration_menu');
    }
    public function donor_questionnaire_consent_menu(?User $user)
    {
        return $user->can('donor_questionnaire_consent_menu');
    }
    public function donor_bleeding_menu(?User $user)
    {
        return $user->can('donor_bleeding_menu');
    }
    public function transfusion_reaction_menu(?User $user)
    {
        return $user->can('transfusion_reaction_menu');
    }
    public function transfusion_reaction_return_menu(?User $user)
    {
        return $user->can('transfusion_reaction_return_menu');
    }
    public function consultation_charges_menu(?User $user)
    {
        return $user->can('consultation_charges_menu');
    }
    public function department_fee_menu(?User $user)
    {
        return $user->can('department_fee_menu');
    }
    public function doctor_fee_menu(?User $user)
    {
        return $user->can('doctor_fee_menu');
    }
    public function change_consultation_fee_menu(?User $user)
    {
        return $user->can('change_consultation_fee_menu');
    }
    public function service_charges_menu(?User $user)
    {
        return $user->can('service_charges_menu');
    }
    public function billing_head_master_menu(?User $user)
    {
        return $user->can('billing_head_master_menu');
    }
    public function location_master_menu(?User $user)
    {
        return $user->can('location_master_menu');
    }
    public function teriff_master_menu(?User $user)
    {
        return $user->can('teriff_master_menu');
    }
    public function service_group_master_menu(?User $user)
    {
        return $user->can('service_group_master_menu');
    }
    public function service_master_menu(?User $user)
    {
        return $user->can('service_master_menu');
    }
    public function package_master_menu(?User $user)
    {
        return $user->can('package_master_menu');
    }
    public function opd_patient_menu(?User $user)
    {
        return $user->can('opd_patient_menu');
    }
    public function new_patient_reg_menu(?User $user)
    {
        return $user->can('new_patient_reg_menu');
    }
    public function reg_with_consultation_menu(?User $user)
    {
        return $user->can('reg_with_consultation_menu');
    }
    public function all_patients_menu(?User $user)
    {
        return $user->can('all_patients_menu');
    }
    public function all_consultations_menu(?User $user)
    {
        return $user->can('all_consultations_menu');
    }
    public function old_consultations_menu(?User $user)
    {
        return $user->can('old_consultations_menu');
    }
    public function opd_billing_menu(?User $user)
    {
        return $user->can('opd_billing_menu');
    }
    public function cancel_bill_menu(?User $user)
    {
        return $user->can('cancel_bill_menu');
    }
    public function all_opd_billing_menu(?User $user)
    {
        return $user->can('all_opd_billing_menu');
    }
    public function today_cash_collection_menu(?User $user)
    {
        return $user->can('today_cash_collection_menu');
    }
    public function cash_collection_menu(?User $user)
    {
        return $user->can('cash_collection_menu');
    }
    public function ipd_menu(?User $user)
    {
        return $user->can('ipd_menu');
    }
    public function nurse_station_master_menu(?User $user)
    {
        return $user->can('nurse_station_master_menu');
    }
    public function ward_teriff_master_menu(?User $user)
    {
        return $user->can('ward_teriff_master_menu');
    }
    public function ward_group_master_menu(?User $user)
    {
        return $user->can('ward_group_master_menu');
    }
    public function ward_master_menu(?User $user)
    {
        return $user->can('ward_master_menu');
    }
    public function room_master_menu(?User $user)
    {
        return $user->can('room_master_menu');
    }
    public function ipd_registration_menu(?User $user)
    {
        return $user->can('ipd_registration_menu');
    }
    public function ipd_list_menu(?User $user)
    {
        return $user->can('ipd_list_menu');
    }
    public function corporate_menu(?User $user)
    {
        return $user->can('corporate_menu');
    }
    public function corporate_registration_menu(?User $user)
    {
        return $user->can('corporate_registration_menu');
    }
    public function all_corporate_registration_menu(?User $user)
    {
        return $user->can('all_corporate_registration_menu');
    }
    public function organization_master_menu(?User $user)
    {
        return $user->can('organization_master_menu');
    }
    public function corporate_relation_master_menu(?User $user)
    {
        return $user->can('corporate_relation_master_menu');
    }
    public function organization_tariff_master_menu(?User $user)
    {
        return $user->can('organization_tariff_master_menu');
    }
    public function wallet_menu(?User $user)
    {
        return $user->can('wallet_menu');
    }
    public function doctor_menu(?User $user)
    {
        return $user->can('doctor_menu');
    }
    public function doctor_registration_menu(?User $user)
    {
        return $user->can('doctor_registration_menu');
    }
    public function central_lab_master_menu(?User $user)
    {
        return $user->can('central_lab_master_menu');
    }
    public function parameter_master_menu(?User $user)
    {
        return $user->can('parameter_master_menu');
    }
    public function test_format_setup_menu(?User $user)
    {
        return $user->can('test_format_setup_menu');
    }
    public function template_setup_menu(?User $user)
    {
        return $user->can('template_setup_menu');
    }
    public function antibiotic_master_menu(?User $user)
    {
        return $user->can('antibiotic_master_menu');
    }
    public function organism_master_menu(?User $user)
    {
        return $user->can('organism_master_menu');
    }
    public function specimen_master_menu(?User $user)
    {
        return $user->can('specimen_master_menu');
    }
    public function vacutaine_master_menu(?User $user)
    {
        return $user->can('vacutaine_master_menu');
    }
    public function specimen_setup_menu(?User $user)
    {
        return $user->can('specimen_setup_menu');
    }
    public function reports_menu(?User $user)
    {
        return $user->can('reports_menu');
    }
    public function op_consultation_report_menu(?User $user)
    {
        return $user->can('op_consultation_report_menu');
    }
    public function op_register_report_menu(?User $user)
    {
        return $user->can('op_register_report_menu');
    }
    public function medicine_issues_menu(?User $user)
    {
        return $user->can('medicine_issues_menu');
    }
    public function ip_pharmacy_billing_menu(?User $user)
    {
        return $user->can('ip_pharmacy_billing_menu');
    }
    public function all_ip_pharmacy_billing_menu(?User $user)
    {
        return $user->can('all_ip_pharmacy_billing_menu');
    }
    public function adt_menu(?User $user)
    {
        return $user->can('adt_menu');
    }
    public function ip_service_create_menu(?User $user)
    {
        return $user->can('ip_service_create_menu');
    }
    public function ip_services_menu(?User $user)
    {
        return $user->can('ip_services_menu');
    }
    public function patient_wise_credit_limit_menu(?User $user)
    {
        return $user->can('patient_wise_credit_limit_menu');
    }
    public function discharge_type_master_menu(?User $user)
    {
        return $user->can('discharge_type_master_menu');
    }
    public function in_patient_enquiry_menu(?User $user)
    {
        return $user->can('in_patient_enquiry_menu');
    }
    public function bed_status_enquiry_menu(?User $user)
    {
        return $user->can('bed_status_enquiry_menu');
    }
    public function discharge_menu(?User $user)
    {
        return $user->can('discharge_menu');
    }
    public function in_patient_pre_refund_menu(?User $user)
    {
        return $user->can('in_patient_pre_refund_menu');
    }
    public function ip_final_bill_menu(?User $user)
    {
        return $user->can('ip_final_bill_menu');
    }
    public function ip_discharge_menu(?User $user)
    {
        return $user->can('ip_discharge_menu');
    }
}
