<?php
$route = Route::current()->getName();
$prefix = Request::route()->getPrefix();
//echo $prefix;
// echo $route;
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscrol">

        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>

                <li class="@if (request()->routeIs('admin.dashboard')) active @endif">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="la la-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @can('op_pharmacy_all_cancel_receipts_menu', \App\Models\Sidebar::class)
                    <li class="@if (request()->routeIs('admin.pharmacy.pharmacy-cancle-receipt')) active @endif">
                        <a class="" href="{{ route('admin.pharmacy.pharmacy-cancle-receipt') }}">
                            <i class="fa fa-close"></i>
                            <span>All Cancle Receipts</span>
                        </a>
                    </li>
                @endcan

                @can('bin_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-shopping-basket"></i>
                            <span> Bin</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('bin_group_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.bin-group-master')) active @endif"
                                        href="{{ route('admin.pharmacy.bin-group-master') }}">
                                        Bin Group
                                    </a>
                                </li>
                            @endcan

                            @can('bin_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.bin-master')) active @endif"
                                        href="{{ route('admin.pharmacy.bin-master') }}">
                                        Bin
                                    </a>
                                </li>
                            @endcan

                            @can('add_item_to_bin_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.bin-item')) active @endif"
                                        href="{{ route('admin.pharmacy.bin-item') }}">
                                        Add Item to Bin
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('blood_requisition_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-tint"></i>
                            <span>Blood Bank Manag.</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('blood_requisition_request_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.blood-requisition-request') ||
                                            request()->routeIs('admin.blood-requisition-request.create') ||
                                            request()->routeIs('admin.blood-requisition-request.edit')) active @endif"
                                        href="{{ route('admin.blood-requisition-request') }}">
                                        Blood Requisition
                                    </a>
                                </li>
                            @endcan

                            @can('donor_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-dashboard"></i> --}}
                                        <span>Donor</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('donor_registration_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.blood-bank.donor-registration') ||
                                                        request()->routeIs('admin.blood-bank.donor-registration.create') ||
                                                        request()->routeIs('admin.blood-bank.donor-registration.edit')) active @endif"
                                                    href="{{ route('admin.blood-bank.donor-registration') }}">
                                                    Donor Registration
                                                </a>
                                            </li>
                                        @endcan

                                        @can('donor_questionnaire_consent_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.blood-bank.donor-questionnaire-and-consent') ||
                                                        request()->routeIs('admin.blood-bank.donor-questionnaire-and-consent.create') ||
                                                        request()->routeIs('admin.blood-bank.donor-questionnaire-and-consent.edit')) active @endif"
                                                    href="{{ route('admin.blood-bank.donor-questionnaire-and-consent') }}">
                                                    Donor Questionnaire & Consent
                                                </a>
                                            </li>
                                        @endcan

                                        @can('donor_bleeding_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.blood-bank.donor-bleeding') ||
                                                        request()->routeIs('admin.blood-bank.donor-bleeding.create') ||
                                                        request()->routeIs('admin.blood-bank.donor-bleeding.edit')) active @endif"
                                                    href="{{ route('admin.blood-bank.donor-bleeding') }}">
                                                    Donor Bleeding
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('transfusion_reaction_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-dashboard"></i> --}}
                                        <span>Transfusion Reaction</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('transfusion_reaction_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.transfusion-reaction') ||
                                                        request()->routeIs('admin.transfusion-reaction.create') ||
                                                        request()->routeIs('admin.transfusion-reaction.edit')) active @endif"
                                                    href="{{ route('admin.transfusion-reaction') }}">
                                                    Transfusion Reaction
                                                </a>
                                            </li>
                                        @endcan

                                        @can('transfusion_reaction_return_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.transfusion-return')) active @endif"
                                                    href="{{ route('admin.transfusion-return') }}">
                                                    Transfusion Reaction Return
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('bed_status_enquiry_menu', \App\Models\Sidebar::class)
                    <li class="{{ $route == 'admin.front-desk.bed-status-enquiry' ? 'active' : '' }}">
                        <a href="{{ route('admin.front-desk.bed-status-enquiry') }}">
                            <i class="la la-procedures"></i>
                            <span>Bed Status Enquiry</span>
                        </a>
                    </li>
                @endcan

                @can('cancel_medicine_sale_menu', \App\Models\Sidebar::class)
                    <li class="@if (request()->routeIs('admin.pharmacy.cancle-medicine-sale')) active @endif">
                        <a href="{{ route('admin.pharmacy.cancle-medicine-sale') }}">
                            <i class="fa fa-close"></i>
                            <span>Cancel Medicine Sale</span>
                        </a>
                    </li>
                @endcan

                @can('central_lab_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="fa fa-flask"></i>
                            <span>Central Lab </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">

                            @can('sample_collection_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.sample-collection')) active @endif"
                                        href="{{ route('admin.sample-collection') }}">
                                        Sample Collection
                                    </a>
                                </li>
                            @endcan

                            @can('diagnostic_result_entry_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.diagnostic-result-entry')) active @endif"
                                        href="{{ route('admin.diagnostic-result-entry') }}">
                                        Diagnostic Result Entry
                                    </a>
                                </li>
                            @endcan

                            @can('diagnostic_result_list_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.diagnostic-result-list')) active @endif"
                                        href="{{ route('admin.diagnostic-result-list') }}">
                                        Diagnostic Result List
                                    </a>
                                </li>
                            @endcan


                            @can('ipd_sample_collection_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.sample-collection')) active @endif"
                                        href="{{ route('admin.ipd.sample-collection') }}">
                                        IPD Sample Collection
                                    </a>
                                </li>
                            @endcan

                            @can('ipd_diagnostic_result_entry_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.diagnostic-result-entry')) active @endif"
                                        href="{{ route('admin.ipd.diagnostic-result-entry') }}">
                                        IPD Diagnostic Result Entry
                                    </a>
                                </li>
                            @endcan

                            @can('ipd_diagnostic_result_list_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.diagnostic-result-list')) active @endif"
                                        href="{{ route('admin.ipd.diagnostic-result-list') }}">
                                        IPD Diagnostic Result List
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('drug_managements_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-capsules"></i>
                            <span>Drug Managements</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('drug_indents_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.nurse.drug-management.drug-indent')) active @endif"
                                        href="{{ route('admin.nurse.drug-management.drug-indent') }}">
                                        Drug Indents
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('discharge_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user-lock"></i>
                            <span> Discharge </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('in_patient_pre_refund_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a href="{{ route('admin.ipd.in-patient-pre-refund') }}"
                                        class="@if (request()->routeIs('admin.ipd.in-patient-pre-refund') ||
                                                request()->routeIs('admin.ipd.in-patient-pre-refund.create')) active @endif">
                                        In Patient Pre Refund
                                    </a>
                                </li>
                            @endcan

                            @can('ip_final_bill_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a href="{{ route('admin.ipd.ip-final-bill-master') }}"
                                        class="@if (request()->routeIs('admin.ipd.ip-final-bill-master') || request()->routeIs('admin.ipd.ip-final-bill.create')) active @endif">
                                        IP Final Bill
                                    </a>
                                </li>
                            @endcan

                            @can('ip_discharge_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a href="{{ route('admin.ipd.ip-discharge-master') }}"
                                        class="@if (request()->routeIs('admin.ipd.ip-discharge-master') || request()->routeIs('admin.ipd.ip-discharge.create')) active @endif">
                                        IP Discharge
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('ipd_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user-injured"></i>
                            <span> IPD </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('nurse_station_master_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.nurse-station-master')) active @endif"
                                        href="{{ route('admin.ipd.nurse-station-master') }}">
                                        Nurse Station Master
                                    </a>
                                </li>
                            @endcan

                            @can('ward_teriff_master_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.ward-tariff-master')) active @endif"
                                        href="{{ route('admin.ipd.ward-tariff-master') }}">
                                        Ward Teriff Master
                                    </a>
                                </li>
                            @endcan

                            @can('ward_group_master_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.ward-group-master')) active @endif"
                                        href="{{ route('admin.ipd.ward-group-master') }}">
                                        Ward Group Master
                                    </a>
                                </li>
                            @endcan

                            @can('ward_master_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.ward-master')) active @endif"
                                        href="{{ route('admin.ipd.ward-master') }}">
                                        Ward Master
                                    </a>
                                </li>
                            @endcan

                            @can('room_master_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.room-master')) active @endif"
                                        href="{{ route('admin.ipd.room-master') }}">
                                        Room Master
                                    </a>
                                </li>
                            @endcan

                            @can('ipd_registration_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.admission')) active @endif"
                                        href="{{ route('admin.ipd.admission') }}">
                                        IPD Registration
                                    </a>
                                </li>
                            @endcan

                            @can('ipd_list_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ipd.ipd-list')) active @endif"
                                        href="{{ route('admin.ipd.ipd-list') }}">
                                        IPD List
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('adt_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-dashboard"></i>
                            <span> IPD Service </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('ip_service_create_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.front-desk.adt.ip-service.create')) active @endif"
                                        href="{{ route('admin.front-desk.adt.ip-service.create') }}">
                                        IP Service Create
                                    </a>
                                </li>
                            @endcan

                            @can('ip_services_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.front-desk.adt.ip-service.list')) active @endif"
                                        href="{{ route('admin.front-desk.adt.ip-service.list') }}">
                                        IP Services
                                    </a>
                                </li>
                            @endcan

                            @can('patient_wise_credit_limit_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.front-desk.adt.patient.credit-limit')) active @endif"
                                        href="{{ route('admin.front-desk.adt.patient.credit-limit') }}">
                                        Patient Wise Credit Limit
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('internal_transfer_GIN_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-dashboard"></i>
                            <span> Internal Transfer (GIN) </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            @can('all_gin_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.pharmacy.pharmacy-internal-transfer-gin' ? 'active' : '' }}"
                                        href="{{ route('admin.pharmacy.pharmacy-internal-transfer-gin') }}">
                                        ALL GIN
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('op_pharmacy_inventory_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-dashboard"></i>
                            <span> Inventory </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('new_issued_items_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.sale-store.new-gin' ? 'active' : '' }}"
                                        href="{{ route('admin.sale-store.new-gin') }}">
                                        New Issued Items
                                    </a>
                                </li>
                            @endcan

                            @can('all_items_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.sale-store.list-sale-store-by-stock-point' ? 'active' : '' }}"
                                        href="{{ route('admin.sale-store.list-sale-store-by-stock-point') }}">
                                        All Items
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('in_patient_enquiry_menu', \App\Models\Sidebar::class)
                    <li class="{{ $route == 'admin.front-desk.in-patient-enquiry' ? 'active' : '' }}">
                        <a href="{{ route('admin.front-desk.in-patient-enquiry') }}">
                            <i class="lab la-searchengin"></i>
                            <span>In Patient Enquiry</span>
                        </a>
                    </li>
                @endcan

                @can('master_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-sitemap"></i>
                            <span> Master</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('consultation_charges_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        <span> Consultation Charges</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('department_fee_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.department-consultation-fee')) active @endif"
                                                    href="{{ route('admin.department-consultation-fee') }}">
                                                    Department Fee
                                                </a>
                                            </li>
                                        @endcan

                                        <li>
                                            <a class="@if (request()->routeIs('admin.department-corporate-fee')) active @endif"
                                                href="{{ route('admin.department-corporate-fee') }}">
                                                Department Corporate Fee
                                            </a>
                                        </li>

                                        @can('doctor_fee_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.doctor-fee')) active @endif"
                                                    href="{{ route('admin.doctor-fee') }}">Doctor Fee</a>
                                            </li>
                                        @endcan

                                        @can('change_consultation_fee_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.change-department-consultation-fee')) active @endif"
                                                    href="{{ route('admin.change-department-consultation-fee') }}">
                                                    Change Consultation Fee
                                                </a>
                                            </li>
                                        @endcan

                                        <li>
                                            <a class="@if (request()->routeIs('admin.corporate-service-fee')) active @endif"
                                                href="{{ route('admin.corporate-service-fee') }}">
                                                Corporate Service Fee
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @can('central_lab_master_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="fa fa-flask"></i> --}}
                                        <span>Central Lab Master</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('parameter_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.parameter-master')) active @endif"
                                                    href="{{ route('admin.parameter-master') }}">
                                                    Parameter Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('test_format_setup_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.format-setup')) active @endif"
                                                    href="{{ route('admin.format-setup') }}">
                                                    Test Format Setup
                                                </a>
                                            </li>
                                        @endcan

                                        @can('template_setup_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.template-setup')) active @endif"
                                                    href="{{ route('admin.template-setup') }}">
                                                    Template Setup
                                                </a>
                                            </li>
                                        @endcan

                                        @can('antibiotic_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.antibiotic-master')) active @endif"
                                                    href="{{ route('admin.antibiotic-master') }}">
                                                    Antibiotic Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('organism_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.organism-master')) active @endif"
                                                    href="{{ route('admin.organism-master') }}">
                                                    Organism Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('specimen_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.specimen-master')) active @endif"
                                                    href="{{ route('admin.specimen-master') }}">
                                                    Specimen Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('vacutaine_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.vacutaine-master')) active @endif"
                                                    href="{{ route('admin.vacutaine-master') }}">
                                                    Vacutaine Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('specimen_setup_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.specimen-setup')) active @endif"
                                                    href="{{ route('admin.specimen-setup') }}">
                                                    Specimen Setup
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('doctor_registration_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.doctor-registration')) active @endif"
                                        href="{{ route('admin.doctor-registration') }}">
                                        Doctor
                                    </a>
                                </li>
                            @endcan

                            @can('all_employees_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.employee') ||
                                            request()->routeIs('admin.employee.create') ||
                                            request()->routeIs('admin.employee.edit')) active @endif"
                                        href="{{ route('admin.employee') }}">
                                        Employees
                                    </a>
                                </li>
                            @endcan

                            <li class="submenu">
                                <a href="#" class="">
                                    {{-- <i class="la la-dashboard"></i> --}}
                                    <span> Master</span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <ul style="display: none;">
                                    @can('gender_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.gender-master')) active @endif"
                                                href="{{ route('admin.gender-master') }}">
                                                Gender
                                            </a>
                                        </li>
                                    @endcan

                                    @can('title_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.title-master')) active @endif"
                                                href="{{ route('admin.title-master') }}">
                                                Title
                                            </a>
                                        </li>
                                    @endcan

                                    @can('relation_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.relation-master')) active @endif"
                                                href="{{ route('admin.relation-master') }}">
                                                Relation
                                            </a>
                                        </li>
                                    @endcan

                                    @can('marital_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.marital-master')) active @endif"
                                                href="{{ route('admin.marital-master') }}">
                                                Marital
                                            </a>
                                        </li>
                                    @endcan

                                    @can('bloodgroup_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.bloodgroup-master')) active @endif"
                                                href="{{ route('admin.bloodgroup-master') }}">
                                                Bloodgroup
                                            </a>
                                        </li>
                                    @endcan

                                    @can('religion_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.religion-master')) active @endif"
                                                href="{{ route('admin.religion-master') }}">
                                                Religion
                                            </a>
                                        </li>
                                    @endcan

                                    @can('occupation_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.occupation-master')) active @endif"
                                                href="{{ route('admin.occupation-master') }}">
                                                Occupation
                                            </a>
                                        </li>
                                    @endcan

                                    @can('department_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.department')) active @endif"
                                                href="{{ route('admin.department') }}">
                                                Department
                                            </a>
                                        </li>
                                    @endcan

                                    @can('unit_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.unit-master')) active @endif"
                                                href="{{ route('admin.unit-master') }}">
                                                Unit
                                            </a>
                                        </li>
                                    @endcan

                                    @can('category_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.category-master')) active @endif"
                                                href="{{ route('admin.category-master') }}">
                                                Category
                                            </a>
                                        </li>
                                    @endcan

                                    @can('designation_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.designation-master')) active @endif"
                                                href="{{ route('admin.designation-master') }}">
                                                Designation
                                            </a>
                                        </li>
                                    @endcan

                                    @can('doctor_specialization_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.doctor-specialization-master')) active @endif"
                                                href="{{ route('admin.doctor-specialization-master') }}">
                                                Doctor Specialization
                                            </a>
                                        </li>
                                    @endcan

                                    @can('referral_other_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.referral-other')) active @endif"
                                                href="{{ route('admin.referral-other') }}">
                                                Referral Other
                                            </a>
                                        </li>
                                    @endcan

                                    @can('health_coordinator_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.health-coordinator')) active @endif"
                                                href="{{ route('admin.health-coordinator') }}">
                                                Health Coordinator
                                            </a>
                                        </li>
                                    @endcan

                                    @can('country_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.country-master')) active @endif"
                                                href="{{ route('admin.country-master') }}">
                                                Country
                                            </a>
                                        </li>
                                    @endcan

                                    @can('state_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.state-master')) active @endif"
                                                href="{{ route('admin.state-master') }}">
                                                State
                                            </a>
                                        </li>
                                    @endcan

                                    @can('district_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.district-master')) active @endif"
                                                href="{{ route('admin.district-master') }}">
                                                District
                                            </a>
                                        </li>
                                    @endcan

                                    @can('block_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.block-master')) active @endif"
                                                href="{{ route('admin.block-master') }}">
                                                Block
                                            </a>
                                        </li>
                                    @endcan

                                    @can('village_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.village-master')) active @endif"
                                                href="{{ route('admin.village-master') }}">
                                                Village
                                            </a>
                                        </li>
                                    @endcan

                                    @can('abnormal_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.abnormal-master')) active @endif"
                                                href="{{ route('admin.abnormal-master') }}">
                                                Abnormal
                                            </a>
                                        </li>
                                    @endcan

                                    @can('equipment_group_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.equipment-group-master')) active @endif"
                                                href="{{ route('admin.equipment-group-master') }}">
                                                Equipment Group
                                            </a>
                                        </li>
                                    @endcan

                                    @can('equipment_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.equipment-master')) active @endif"
                                                href="{{ route('admin.equipment-master') }}">
                                                Equipment
                                            </a>
                                        </li>
                                    @endcan

                                    @can('ot_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.ot-type-master')) active @endif"
                                                href="{{ route('admin.ot-type-master') }}">
                                                OT Type
                                            </a>
                                        </li>
                                    @endcan

                                    @can('ot_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.ot-master')) active @endif"
                                                href="{{ route('admin.ot-master') }}">
                                                OT
                                            </a>
                                        </li>
                                    @endcan

                                    @can('surgery_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.surgery-type-master')) active @endif"
                                                href="{{ route('admin.surgery-type-master') }}">
                                                Surgery Type
                                            </a>
                                        </li>
                                    @endcan

                                    @can('surgery_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.surgery-master')) active @endif"
                                                href="{{ route('admin.surgery-master') }}">
                                                Surgery
                                            </a>
                                        </li>
                                    @endcan

                                    @can('anesthesia_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.anesthesia-type-master')) active @endif"
                                                href="{{ route('admin.anesthesia-type-master') }}">
                                                Anesthesia Type
                                            </a>
                                        </li>
                                    @endcan

                                    @can('case_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.case-type-master')) active @endif"
                                                href="{{ route('admin.case-type-master') }}">
                                                Case Type
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admission_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.admission-type-master')) active @endif"
                                                href="{{ route('admin.admission-type-master') }}">
                                                Admission Type
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admission_purpose_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.admission-purpose-master')) active @endif"
                                                href="{{ route('admin.admission-purpose-master') }}">
                                                Admission Purpose
                                            </a>
                                        </li>
                                    @endcan

                                    @can('bag_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.bag-type-master')) active @endif"
                                                href="{{ route('admin.bag-type-master') }}">
                                                Bag Type
                                            </a>
                                        </li>
                                    @endcan

                                    @can('discharge_type_master_menu', \App\Models\Sidebar::class)
                                        <li>
                                            <a class="@if (request()->routeIs('admin.discharge-type-master')) active @endif"
                                                href="{{ route('admin.discharge-type-master') }}">
                                                Discharge Type
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>

                            @can('pharmacy_master_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-capsules"></i> --}}
                                        <span> Pharmacy Master</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('type_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.type-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.type-master') }}">
                                                    Type Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('stock_point_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.stock-point-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.stock-point-master') }}">
                                                    Stock Point Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('item_group_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.item-group-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.item-group-master') }}">
                                                    Item Group Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('generic_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.generic-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.generic-master') }}">
                                                    Generic Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('form_UOM_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.form-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.form-master') }}">
                                                    Form (UOM) Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('category_pharmacy_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.category-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.category-master') }}">
                                                    Category Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('specialization_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.item-specialization-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.item-specialization-master') }}">
                                                    Specialization
                                                </a>
                                            </li>
                                        @endcan

                                        @can('manufacturer_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.manufacturer-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.manufacturer-master') }}">
                                                    Manufacturer
                                                </a>
                                            </li>
                                        @endcan

                                        @can('add_item_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.pharmacy.item-master')) active @endif"
                                                    href="{{ route('admin.pharmacy.item-master') }}">
                                                    Add Item
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('permission_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-key"></i> --}}
                                        <span>Permission</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('all_permissions_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.permissions.index') ||
                                                        request()->routeIs('admin.permissions.create') ||
                                                        request()->routeIs('admin.permissions.edit')) active @endif"
                                                    href="{{ route('admin.permissions.index') }}">
                                                    All Permissions
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('role_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-user-plus"></i> --}}
                                        <span> Role</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('all_user_profile_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.user-profile.index')) active @endif"
                                                    href="{{ route('admin.user-profile.index') }}">
                                                    All User Profile
                                                </a>
                                            </li>

                                            <li>
                                                <a class="@if (request()->routeIs('admin.user-profile.stock-point')) active @endif"
                                                    href="{{ route('admin.user-profile.stock-point') }}">
                                                    User Profile Stock Point
                                                </a>
                                            </li>
                                        @endcan


                                        @can('all_roles_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.roles.index') ||
                                                        request()->routeIs('admin.roles.create') ||
                                                        request()->routeIs('admin.roles.edit')) active @endif"
                                                    href="{{ route('admin.roles.index') }}">
                                                    All Roles
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('service_charges_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-dashboard"></i> --}}
                                        <span> Service Charges</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('billing_head_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.billing-head-master')) active @endif"
                                                    href="{{ route('admin.billing-head-master') }}">
                                                    Billing Head Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('location_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.location-master')) active @endif"
                                                    href="{{ route('admin.location-master') }}">
                                                    Location Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('teriff_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.teriff-master')) active @endif"
                                                    href="{{ route('admin.teriff-master') }}">
                                                    Teriff Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('service_group_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.service-group-master')) active @endif"
                                                    href="{{ route('admin.service-group-master') }}">
                                                    Service Group Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('service_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.service-master')) active @endif"
                                                    href="{{ route('admin.service-master') }}">
                                                    Service Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('package_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.package-master')) active @endif"
                                                    href="{{ route('admin.package-master') }}">
                                                    Package Master
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('all_users_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.users.index') ||
                                            request()->routeIs('admin.users.create') ||
                                            request()->routeIs('admin.users.edit') ||
                                            request()->routeIs('admin.users.roles')) active @endif"
                                        href="{{ route('admin.users.index') }}">
                                        Users
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('mrq_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-dashboard"></i>
                            <span> MRQ </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            @can('op_pharmacy_all_mrq_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.mrq.list-store-mrq' ? 'active' : '' }}"
                                        href="{{ route('admin.mrq.list-store-mrq') }}">
                                        All MRQ
                                    </a>
                                </li>
                            @endcan

                            @can('create_mrq_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.mrq.create-mrq' ? 'active' : '' }}"
                                        href="{{ route('admin.mrq.create-mrq') }}">
                                        Create MRQ
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('medicine_issues_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-ambulance"></i>
                            <span> Medicine Issues </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('ip_pharmacy_billing_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.issues.ip-pharmacy-billing.create')) active @endif"
                                        href="{{ route('admin.pharmacy.issues.ip-pharmacy-billing.create') }}">
                                        IP Pharmacy Billing
                                    </a>
                                </li>
                            @endcan

                            @can('all_ip_pharmacy_billing_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.issues.ip-pharmacy-billing')) active @endif"
                                        href="{{ route('admin.pharmacy.issues.ip-pharmacy-billing') }}">
                                        All IP Pharmacy Billing
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('medicine_sale_menu', \App\Models\Sidebar::class)
                    <li class="@if (request()->routeIs('admin.opd-medicine-sale.sale')) active @endif">
                        <a href="{{ route('admin.opd-medicine-sale.sale') }}">
                            <i class="la la-capsules"></i>
                            <span>Medicine Sale</span>
                        </a>
                    </li>
                @endcan

                @can('nurse_patients_menu', \App\Models\Sidebar::class)
                    <li class="@if (request()->routeIs('admin.nurse.nurse-station')) active @endif">
                        <a href="{{ route('admin.nurse.nurse-station') }}">
                            <i class="las la-user-nurse"></i>
                            <span>Nurse Station</span>
                        </a>
                    </li>
                @endcan

                @can('opd_patient_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user-injured"></i>
                            <span> OPD</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            <li class="">
                                <a href="https://abha.abdm.gov.in/abha/v3/register/aadhaar" target="_blank">
                                    {{-- <i class="la la-link"></i> --}}
                                    <span>ABHA ID Creation</span>
                                </a>
                            </li>

                            @can('consultation_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-dashboard"></i> --}}
                                        <span> Consultation </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul style="display: none;">
                                        @can('assign_doctor_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.opd-coordinator.assign-doctor')) active @endif"
                                                    href="{{ route('admin.opd-coordinator.assign-doctor') }}">
                                                    Assign Doctor
                                                </a>
                                            </li>
                                        @endcan

                                        @can('refer_patient_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.refer-patient')) active @endif"
                                                    href="{{ route('admin.refer-patient') }}">
                                                    Refer Patient
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('corporate_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-stethoscope"></i> --}}
                                        <span> Corporate</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('corporate_registration_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.ipd.corporate-registration')) active @endif"
                                                    href="{{ route('admin.ipd.corporate-registration') }}">
                                                    Corporate Registration
                                                </a>
                                            </li>
                                        @endcan

                                        @can('all_corporate_registration_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.ipd.corporate-registration-list')) active @endif"
                                                    href="{{ route('admin.ipd.corporate-registration-list') }}">
                                                    All Corporate Registration
                                                </a>
                                            </li>
                                        @endcan

                                        @can('organization_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.ipd.organization-master')) active @endif"
                                                    href="{{ route('admin.ipd.organization-master') }}">
                                                    Organization Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('corporate_relation_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.ipd.corporate-relation-master')) active @endif"
                                                    href="{{ route('admin.ipd.corporate-relation-master') }}">
                                                    Corporate Relation Master
                                                </a>
                                            </li>
                                        @endcan

                                        @can('organization_tariff_master_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.ipd.organization-tariff-master')) active @endif"
                                                    href="{{ route('admin.ipd.organization-tariff-master') }}">
                                                    Organization Tariff Master
                                                </a>
                                            </li>
                                        @endcan

                                        {{-- <li>
                                <a class="@if (request()->routeIs('admin.ipd.organization-pharmacy-discount-master')) active @endif"
                                    href="{{ route('admin.ipd.organization-pharmacy-discount-master') }}">
                                    Organization Pharmacy Discount Master
                                </a>
                            </li> --}}
                                    </ul>
                                </li>
                            @endcan

                            @can('opd_patient_menu', \App\Models\Sidebar::class)
                                <li class="submenu">
                                    <a href="#">
                                        {{-- <i class="la la-user-injured"></i> --}}
                                        <span> OPD Patient</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <ul style="display: none;">
                                        @can('new_patient_reg_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.patient.create')) active @endif"
                                                    href="{{ route('admin.patient.create') }}">
                                                    New Patient Reg.
                                                </a>
                                            </li>
                                        @endcan

                                        @can('reg_with_consultation_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.patient.registration-with-consultation')) active @endif"
                                                    href="{{ route('admin.patient.registration-with-consultation') }}">
                                                    Registration With Consultation
                                                </a>
                                            </li>
                                        @endcan

                                        @can('all_patients_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.patient.list')) active @endif"
                                                    href="{{ route('admin.patient.list') }}">
                                                    All Patients
                                                </a>
                                            </li>
                                        @endcan

                                        @can('all_consultations_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.patient.consultation-list')) active @endif"
                                                    href="{{ route('admin.patient.consultation-list') }}">
                                                    All Consultations
                                                </a>
                                            </li>
                                        @endcan

                                        @can('new_consultation_menu', \App\Models\Sidebar::class)
                                            {{-- <li>
                                    <a class="@if (request()->routeIs('admin.patient.new-consultation-list')) active @endif"
                                        href="{{ route('admin.patient.new-consultation-list') }}">
                                        New Consultations
                                    </a>
                                </li> --}}
                                        @endcan

                                        @can('old_consultations_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.patient.old-consultation-list')) active @endif"
                                                    href="{{ route('admin.patient.old-consultation-list') }}">
                                                    Old Consultations
                                                </a>
                                            </li>
                                        @endcan

                                        @can('opd_billing_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.opd-billing')) active @endif"
                                                    href="{{ route('admin.opd-billing') }}">
                                                    OPD Billing
                                                </a>
                                            </li>
                                        @endcan

                                        @can('cancel_bill_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.opd-bill-cancellation')) active @endif"
                                                    href="{{ route('admin.opd-bill-cancellation') }}">
                                                    Cancel Bill
                                                </a>
                                            </li>
                                        @endcan

                                        @can('all_opd_billing_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.all-opd-bill')) active @endif"
                                                    href="{{ route('admin.all-opd-bill') }}">
                                                    All OPD Billing
                                                </a>
                                            </li>
                                        @endcan

                                        @can('today_cash_collection_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.front-desk.today-user-wise-cash-collection')) active @endif"
                                                    href="{{ route('admin.front-desk.today-user-wise-cash-collection') }}">
                                                    Today Cash Collection
                                                </a>
                                            </li>
                                        @endcan

                                        @can('cash_collection_menu', \App\Models\Sidebar::class)
                                            <li>
                                                <a class="@if (request()->routeIs('admin.front-desk.user-wise-cash-collection')) active @endif"
                                                    href="{{ route('admin.front-desk.user-wise-cash-collection') }}">
                                                    Cash Collection
                                                </a>
                                            </li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('ot_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-procedures"></i>
                            <span>OT</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('ot_scheduling_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.ot-scheduling')) active @endif"
                                        href="{{ route('admin.ot.ot-scheduling') }}">
                                        OT Scheduling
                                    </a>
                                </li>
                            @endcan

                            @can('ot_pre_booking_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.ot-pre-booking') ||
                                            request()->routeIs('admin.ot.ot-pre-booking.create') ||
                                            request()->routeIs('admin.ot.ot-pre-booking.edit')) active @endif"
                                        href="{{ route('admin.ot.ot-pre-booking') }}">
                                        OT Pre Booking
                                    </a>
                                </li>
                            @endcan

                            @can('ot_booking_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.ot-booking') ||
                                            request()->routeIs('admin.ot.ot-booking.create') ||
                                            request()->routeIs('admin.ot.ot-booking.edit')) active @endif"
                                        href="{{ route('admin.ot.ot-booking') }}">
                                        OT Booking
                                    </a>
                                </li>
                            @endcan

                            @can('day_care_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.day-care') ||
                                            request()->routeIs('admin.ot.day-care.create') ||
                                            request()->routeIs('admin.ot.day-care.edit')) active @endif"
                                        href="{{ route('admin.ot.day-care') }}">
                                        Day Care OT
                                    </a>
                                </li>
                            @endcan

                            @can('pre_operartion_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.pre-operation') ||
                                            request()->routeIs('admin.ot.pre-operation.create') ||
                                            request()->routeIs('admin.ot.pre-operation.edit')) active @endif"
                                        href="{{ route('admin.ot.pre-operation') }}">
                                        Pre Operation
                                    </a>
                                </li>
                            @endcan

                            @can('pre_operartion_checklist_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.pre-operation-checklist') ||
                                            request()->routeIs('admin.ot.pre-operation-checklist.create') ||
                                            request()->routeIs('admin.ot.pre-operation-checklist.edit')) active @endif"
                                        href="{{ route('admin.ot.pre-operation-checklist') }}">
                                        Pre Operation Check List
                                    </a>
                                </li>
                            @endcan

                            @can('post_operartion_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.ot.post-operation') ||
                                            request()->routeIs('admin.ot.post-operation.create') ||
                                            request()->routeIs('admin.ot.post-operation.edit')) active @endif"
                                        href="{{ route('admin.ot.post-operation') }}">
                                        Post Operation
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('nurse_patients_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-stethoscope"></i>
                            <span> Patients</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('nurse_patient_list_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.nurse.patient-list')) active @endif"
                                        href="{{ route('admin.nurse.patient-list') }}">
                                        Patient List
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('purchase_and_issue_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-shopping-cart"></i>
                            <span>Purchase & Issue</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('add_vendor_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.vendor-registration')) active @endif"
                                        href="{{ route('admin.pharmacy.vendor-registration') }}">
                                        Add Vendor
                                    </a>
                                </li>
                            @endcan

                            @can('purchase_indent_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.po.create-purchase-indent')) active @endif"
                                        href="{{ route('admin.po.create-purchase-indent') }}">
                                        Purchase Indent
                                    </a>
                                </li>
                            @endcan

                            @can('purchase_order_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.po.list-purchase-order')) active @endif"
                                        href="{{ route('admin.po.list-purchase-order') }}">
                                        Purchase Order
                                    </a>
                                </li>
                            @endcan

                            @can('goods_receipt_notes_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.grn.create-grn')) active @endif"
                                        href="{{ route('admin.grn.create-grn') }}">
                                        Goods Receipt Notes
                                    </a>
                                </li>
                            @endcan

                            @can('all_mrq_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.mrq.list-mrq')) active @endif"
                                        href="{{ route('admin.mrq.list-mrq') }}">
                                        All MRQ
                                    </a>
                                </li>
                            @endcan

                            @can('gin_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.gin.create-gin')) active @endif"
                                        href="{{ route('admin.gin.create-gin') }}">
                                        GIN
                                    </a>
                                </li>
                            @endcan

                            @can('central_pharmacy_medicine_sale_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.opd-medicine-sale.sale')) active @endif"
                                        href="{{ route('admin.opd-medicine-sale.sale') }}">
                                        Medicine Sale
                                    </a>
                                </li>
                            @endcan

                            @can('inventory_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.inventory.index')) active @endif"
                                        href="{{ route('admin.inventory.index') }}">
                                        Inventory
                                    </a>
                                </li>
                            @endcan

                            @can('sales_stores_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.salestore.index')) active @endif"
                                        href="{{ route('admin.salestore.index') }}">
                                        Sales Stores
                                    </a>
                                </li>
                            @endcan

                            @can('purchase_report_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.medicine-purchase-report')) active @endif"
                                        href="{{ route('admin.pharmacy.medicine-purchase-report') }}">
                                        Purchase Report
                                    </a>
                                </li>
                            @endcan

                            @can('all_cancel_receipts_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.pharmacy.pharmacy-cancle-receipt')) active @endif"
                                        href="{{ route('admin.pharmacy.pharmacy-cancle-receipt') }}">
                                        All Cancel Receipts
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('return_medicine_sale_menu', \App\Models\Sidebar::class)
                    <li class="@if (request()->routeIs('admin.pharmacy.pharmacy-return')) active @endif">
                        <a href="{{ route('admin.pharmacy.pharmacy-return') }}">
                            <i class="fa fa-undo"></i>
                            <span>Return Medicine Sale</span>
                        </a>
                    </li>
                @endcan

                @can('reports_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-chalkboard"></i>
                            <span>Reports</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('op_consultation_report_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.report.op-consultation-report')) active @endif"
                                        href="{{ route('admin.report.op-consultation-report') }}">
                                        OP Consultation Report
                                    </a>
                                </li>

                                <li>
                                    <a class="@if (request()->routeIs('admin.report.receipt-wise-shift-collection')) active @endif"
                                        href="{{ route('admin.report.receipt-wise-shift-collection') }}">
                                        Receipt Wise Shift Collection
                                    </a>
                                </li>

                                {{-- <li>
                                    <a class="@if (request()->routeIs('admin.report.change-patient-report')) active @endif"
                                        href="{{ route('admin.report.change-patient-report') }}">
                                        Change Patient Report
                                    </a>
                                </li> --}}

                                <li>
                                    <a class="@if (request()->routeIs('admin.report.cancellation-report')) active @endif"
                                        href="{{ route('admin.report.cancellation-report') }}">
                                        Cancellation Report
                                    </a>
                                </li>

                                <li>
                                    <a class="@if (request()->routeIs('admin.report.month-day-wise-report')) active @endif"
                                        href="{{ route('admin.report.month-day-wise-report') }}">
                                        Month Day Wise Report
                                    </a>
                                </li>

                                <li>
                                    <a class="@if (request()->routeIs('admin.report.ip-admission-report')) active @endif"
                                        href="{{ route('admin.report.ip-admission-report') }}">
                                        IP Admission Report
                                    </a>
                                </li>

                                <li>
                                    <a class="@if (request()->routeIs('admin.report.ip-advance-report')) active @endif"
                                        href="{{ route('admin.report.ip-advance-report') }}">
                                        IP Advance Report
                                    </a>
                                </li>

                                {{-- <li>
                                    <a class="@if (request()->routeIs('admin.report.ip-expenditure-report')) active @endif"
                                        href="{{ route('admin.report.ip-expenditure-report') }}">
                                        IP Expenditure Report
                                    </a>
                                </li> --}}
                            @endcan

                            {{-- @can('op_register_report_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.report.opd-register-report')) active @endif"
                                        href="{{ route('admin.report.opd-register-report') }}">
                                        OPD Register Report
                                    </a>
                                </li>
                            @endcan --}}
                        </ul>
                    </li>
                @endcan

                @can('service_lab_indents_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-flask"></i>
                            <span>Service & Lab Indents</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('lab_indents_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.nurse.service-lab-indent.lab-indent')) active @endif"
                                        href="{{ route('admin.nurse.service-lab-indent.lab-indent') }}">
                                        Lab Indents
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('scrap_transfer_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-exchange-alt"></i>
                            <span> Scrap Transfer </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('scrap_transfer_create_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.pharmacy.scrap.scrap-transfer' ? 'active' : '' }}"
                                        href="{{ route('admin.pharmacy.scrap.scrap-transfer') }}">
                                        Scrap Transfer
                                    </a>
                                </li>
                            @endcan

                            @can('scrap_transfer_list_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="{{ $route == 'admin.pharmacy.scrap.list-scrap' ? 'active' : '' }}"
                                        href="{{ route('admin.pharmacy.scrap.list-scrap') }}">
                                        Scrap Transfer List
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('choose_stock_point_menu', \App\Models\Sidebar::class)
                    <li class="@if (request()->routeIs('admin.stock-point')) active @endif">
                        <a href="{{ route('admin.stock-point') }}">
                            <i class="las la-warehouse"></i>
                            <span>Stock Point</span>
                        </a>
                    </li>
                @endcan

                @can('wallet_menu', \App\Models\Sidebar::class)
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-money"></i>
                            <span> Wallet</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('wallet_menu', \App\Models\Sidebar::class)
                                <li>
                                    <a class="@if (request()->routeIs('admin.front-desk.wallet')) active @endif"
                                        href="{{ route('admin.front-desk.wallet') }}">
                                        Wallet
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>

        @role('admin')
            {{-- @include('partials.sidebar.admin-sidebar') --}}
        @endrole

        @role('superadmin')
            {{-- @include('partials.sidebar.superadmin-sidebar') --}}
        @endrole


        @role('pharmacy')
            {{-- @include('partials.sidebar.pharmacy-sidebar') --}}
        @endrole
        @role('op-pharmacy')
            {{-- @include('partials.sidebar.oppharmacy-sidebar') --}}
        @endrole
        @role('ot-pharmacy')
            {{-- @include('partials.sidebar.otpharmacy-sidebar') --}}
        @endrole
        @role('emg-pharmacy')
            {{-- @include('partials.sidebar.emgpharmacy-sidebar') --}}
        @endrole
        @role('opd-coordinator')
            {{-- @include('partials.sidebar.opdco-sidebar') --}}
        @endrole
        @role('front-desk')
            {{-- @include('partials.sidebar.front-desk-sidebar') --}}
        @endrole
        @role('lab')
            {{-- @include('partials.sidebar.lab-sidebar') --}}
        @endrole
    </div>
</div>
