@extends('layouts.admin')

@push('page-css')
    <style>
        .custom-control-label::before,
        .custom-control-label::after {
            top: .05rem;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        @include('partials.alert-message')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>
                            Edit Role
                        </h3>
                        <a href="{{ route('admin.roles.index') }}" class="text-primary text-bold float-right mr-4">Role
                            Index</a>
                    </div>
                    <div class="body">
                        <form class="form-inline" method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group p-2">
                                <label class="form-label mr-4">Name</label>
                                <input type="text" class="mr-4 form-control" name="name" value="{{ $role->name }}"
                                    autofocus>
                                @error('name')
                                    <label id="name-error" class="error " for="email">{{ $message }}</label>
                                @enderror
                            </div>

                            <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- row -2---->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>
                            Role Permissions
                        </h3>
                    </div>
                    <div class="body">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <form class="btn btn-success btn-sm mb-1" method="POST"
                                    action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-success btn-sm">{{ $role_permission->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--row 3 -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>

                        </h3>

                        <p class="mb-2">Default Permissions</p>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="admin">
                            Admin Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="central-pharmacy">
                            Central Pharmacy Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="op-pharmacy">
                            OP Pharmacy Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="opd-coordinator">
                            OPD Coordinator Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="front-desk">
                            Front Desk Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="lab">
                            Lab Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="nurse">
                            Nurse Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="ot">
                            OT Permissions
                        </button>

                        <button class="btn btn-primary btn-sm mb-2 setDefaultPermission" data-role="blood-bank">
                            Blood Bank Permissions
                        </button>

                        <hr>
                    </div>
                    <div class="body">

                        <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="mb-3">Permissions</label>
                                </div>

                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    value="{{ $permission->name }}" id="permission-{{ $permission->id }}"
                                                    name="permission[]"
                                                    {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="btn btn-primary btn-sm mt-2" type="submit">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        $(document).on('click', '.setDefaultPermission', function() {
            let role = $(this).attr('data-role');
            let permissions = [];

            switch (role) {
                case 'admin':
                    permissions = [
                        'role_menu',
                        'all_user_profile_menu',
                        'all_roles_menu',
                        'permission_menu',
                        'all_permissions_menu',
                        'employee_menu',
                        'all_employees_menu',
                        'user_menu',
                        'all_users_menu',
                        'master_menu',
                        'gender_master_menu',
                        'title_master_menu',
                        'relation_master_menu',
                        'marital_master_menu',
                        'bloodgroup_master_menu',
                        'religion_master_menu',
                        'occupation_master_menu',
                        'department_master_menu',
                        'unit_master_menu',
                        'category_master_menu',
                        'designation_master_menu',
                        'doctor_specialization_master_menu',
                        'referral_other_master_menu',
                        'health_coordinator_master_menu',
                        'country_master_menu',
                        'state_master_menu',
                        'district_master_menu',
                        'block_master_menu',
                        'village_master_menu',
                        'abnormal_master_menu',
                        'equipment_group_master_menu',
                        'equipment_master_menu',
                        'ot_type_master_menu',
                        'ot_master_menu',
                        'surgery_type_master_menu',
                        'surgery_master_menu',
                        'anesthesia_type_master_menu',
                        'case_type_master_menu',
                        'admission_type_master_menu',
                        'admission_purpose_master_menu',
                        'bag_type_master_menu',
                        'pharmacy_master_menu',
                        'type_master_menu',
                        'stock_point_master_menu',
                        'item_group_master_menu',
                        'generic_master_menu',
                        'form_UOM_master_menu',
                        'category_pharmacy_master_menu',
                        'specialization_menu',
                        'manufacturer_menu',
                        'add_item_menu',
                        'bin_menu',
                        'bin_group_menu',
                        'add_item_to_bin_menu',
                        'purchase_and_issue_menu',
                        'add_vendor_menu',
                        'purchase_indent_menu',
                        'purchase_order_menu',
                        'goods_receipt_notes_menu',
                        'all_mrq_menu',
                        'gin_menu',
                        'central_pharmacy_medicine_sale_menu',
                        'inventory_menu',
                        'sales_stores_menu',
                        'purchase_report_menu',
                        'all_cancel_receipts_menu',
                        'nurse_patients_menu',
                        'nurse_patient_list_menu',
                        'drug_managements_menu',
                        'drug_indents_menu',
                        'service_lab_indents_menu',
                        'lab_indents_menu',
                        'consultation_menu',
                        'assign_doctor_menu',
                        'refer_patient_menu',
                        'mrq_menu',
                        'op_pharmacy_all_mrq_menu',
                        'internal_transfer_GIN_menu',
                        'all_gin_menu',
                        'scrap_transfer_menu',
                        'scrap_transfer_list_menu',
                        'op_pharmacy_inventory_menu',
                        'new_issued_items_menu',
                        'all_items_menu',
                        'cancel_medicine_sale_menu',
                        'return_medicine_sale_menu',
                        'central_lab_menu',
                        'sample_collection_menu',
                        'diagnostic_result_entry_menu',
                        'diagnostic_result_list_menu',
                        'ipd_sample_collection_menu',
                        'ipd_diagnostic_result_entry_menu',
                        'ipd_diagnostic_result_list_menu',
                        'ot_menu',
                        'ot_scheduling_menu',
                        'ot_pre_booking_menu',
                        'ot_booking_menu',
                        'day_care_menu',
                        'pre_operartion_menu',
                        'pre_operartion_checklist_menu',
                        'post_operartion_menu',
                        'blood_requisition_menu',
                        'blood_requisition_request_menu',
                        'donor_menu',
                        'donor_registration_menu',
                        'donor_questionnaire_consent_menu',
                        'donor_bleeding_menu',
                        'transfusion_reaction_menu',
                        'transfusion_reaction_return_menu',
                        'consultation_charges_menu',
                        'department_fee_menu',
                        'doctor_fee_menu',
                        'change_consultation_fee_menu',
                        'service_charges_menu',
                        'billing_head_master_menu',
                        'location_master_menu',
                        'teriff_master_menu',
                        'service_group_master_menu',
                        'service_master_menu',
                        'package_master_menu',
                        'opd_patient_menu',
                        'new_patient_reg_menu',
                        'reg_with_consultation_menu',
                        'all_patients_menu',
                        'all_consultations_menu',
                        'old_consultations_menu',
                        'opd_billing_menu',
                        'cancel_bill_menu',
                        'all_opd_billing_menu',
                        'today_cash_collection_menu',
                        'cash_collection_menu',
                        'ipd_menu',
                        'nurse_station_master_menu',
                        'ward_teriff_master_menu',
                        'ward_group_master_menu',
                        'ward_master_menu',
                        'room_master_menu',
                        'ipd_registration_menu',
                        'ipd_list_menu',
                        'corporate_menu',
                        'corporate_registration_menu',
                        'all_corporate_registration_menu',
                        'organization_master_menu',
                        'corporate_relation_master_menu',
                        'organization_tariff_master_menu',
                        'wallet_menu',
                        'doctor_menu',
                        'doctor_registration_menu',
                        'central_lab_master_menu',
                        'parameter_master_menu',
                        'test_format_setup_menu',
                        'template_setup_menu',
                        'antibiotic_master_menu',
                        'organism_master_menu',
                        'specimen_master_menu',
                        'vacutaine_master_menu',
                        'specimen_setup_menu',
                        'reports_menu',
                        'op_consultation_report_menu',
                        'op_register_report_menu',
                        'medicine_issues_menu',
                        'all_ip_pharmacy_billing_menu',
                        'adt_menu',
                        'ip_service_create_menu',
                        'ip_services_menu',
                        'patient_wise_credit_limit_menu',
                        'dashboard_admin',
                        'choose_stock_point_menu',
                    ];
                    break;

                case 'central-pharmacy':
                    permissions = [
                        'type_master_menu',
                        'stock_point_master_menu',
                        'item_group_master_menu',
                        'generic_master_menu',
                        'form_UOM_master_menu',
                        'category_pharmacy_master_menu',
                        'specialization_menu',
                        'manufacturer_menu',
                        'add_item_menu',
                        'bin_menu',
                        'bin_group_menu',
                        'add_item_to_bin_menu',
                        'purchase_and_issue_menu',
                        'add_vendor_menu',
                        'purchase_indent_menu',
                        'purchase_order_menu',
                        'goods_receipt_notes_menu',
                        'all_mrq_menu',
                        'gin_menu',
                        'inventory_menu',
                        'purchase_report_menu',
                        'all_cancel_receipts_menu',
                        'dashboard_cental_pharmacy',
                    ];
                    break;

                case 'op-pharmacy':
                    permissions = [
                        'bin_menu',
                        'bin_group_menu',
                        'add_item_to_bin_menu',
                        'mrq_menu',
                        'op_pharmacy_all_mrq_menu',
                        'create_mrq_menu',
                        'internal_transfer_GIN_menu',
                        'all_gin_menu',
                        'scrap_transfer_menu',
                        'scrap_transfer_create_menu',
                        'scrap_transfer_list_menu',
                        'op_pharmacy_inventory_menu',
                        'new_issued_items_menu',
                        'all_items_menu',
                        'medicine_sale_menu',
                        'cancel_medicine_sale_menu',
                        'op_pharmacy_all_cancel_receipts_menu',
                        'return_medicine_sale_menu',
                        'medicine_issues_menu',
                        'ip_pharmacy_billing_menu',
                        'all_ip_pharmacy_billing_menu',
                        'dashboard_op_pharmacy',
                        'choose_stock_point_menu',
                    ];
                    break;

                case 'opd-coordinator':
                    permissions = [
                        'consultation_menu',
                        'assign_doctor_menu',
                        'refer_patient_menu',
                        'opd_patient_menu',
                        'new_patient_reg_menu',
                        'reg_with_consultation_menu',
                        'all_patients_menu',
                        'all_consultations_menu',
                        'opd_billing_menu',
                        'all_opd_billing_menu',
                        'dashboard_opd_coordinator',
                    ];
                    break;

                case 'front-desk':
                    permissions = [
                        'opd_patient_menu',
                        'new_patient_reg_menu',
                        'reg_with_consultation_menu',
                        'all_patients_menu',
                        'all_consultations_menu',
                        'old_consultations_menu',
                        'opd_billing_menu',
                        'cancel_bill_menu',
                        'all_opd_billing_menu',
                        'today_cash_collection_menu',
                        'cash_collection_menu',
                        'reports_menu',
                        'op_consultation_report_menu',
                        'op_register_report_menu',
                        'adt_menu',
                        'ip_service_create_menu',
                        'ip_services_menu',
                        'patient_wise_credit_limit_menu',
                        'dashboard_front_desk',
                    ];
                    break;

                case 'lab':
                    permissions = [
                        'central_lab_menu',
                        'sample_collection_menu',
                        'diagnostic_result_entry_menu',
                        'diagnostic_result_list_menu',
                        'ipd_sample_collection_menu',
                        'ipd_diagnostic_result_entry_menu',
                        'ipd_diagnostic_result_list_menu',
                        'dashboard_lab',
                    ];
                    break;

                case 'nurse':
                    permissions = [
                        'nurse_patients_menu',
                        'nurse_patient_list_menu',
                        'drug_managements_menu',
                        'drug_indents_menu',
                        'service_lab_indents_menu',
                        'lab_indents_menu',
                        'blood_requisition_menu',
                        'blood_requisition_request_menu',
                        'transfusion_reaction_menu',
                        'dashboard_nurse',
                    ];
                    break;

                case 'ot':
                    permissions = [
                        'ot_menu',
                        'ot_scheduling_menu',
                        'ot_pre_booking_menu',
                        'ot_booking_menu',
                        'day_care_menu',
                        'pre_operartion_menu',
                        'pre_operartion_checklist_menu',
                        'post_operartion_menu',
                        'dashboard_ot',
                    ];
                    break;

                case 'blood-bank':
                    permissions = [
                        'blood_requisition_menu',
                        'blood_requisition_request_menu',
                        'donor_menu',
                        'donor_registration_menu',
                        'donor_questionnaire_consent_menu',
                        'donor_bleeding_menu',
                        'transfusion_reaction_menu',
                        'transfusion_reaction_return_menu',
                        'dashboard_blood_bank',
                    ];
                    break;
            }

            $(`input[type='checkbox']`).prop('checked', false);
            permissions.forEach(permission => {
                $(`input[type='checkbox'][value='${permission}']`).prop('checked', true);
            });
        });
    </script>
@endpush
