<div id="sidebar-menu" class="sidebar-menu">
    <ul>
        <li class="submenu">
            <a href="#"><i class="la la-user-plus"></i> <span> Role</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.roles.index')) active @endif" href="{{ route('admin.roles.index') }}">All
                        Roles</a></li>
                <li><a class="@if (request()->routeIs('admin.roles.create') || request()->routeIs('admin.roles.edit')) active @endif"
                        href="{{ route('admin.roles.create') }}">Create Role</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-key"></i> <span> Permession</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.permissions.index')) active @endif"
                        href="{{ route('admin.permissions.index') }}">All Permissions</a></li>
                <li><a class="@if (request()->routeIs('admin.permissions.create') || request()->routeIs('admin.permissions.edit')) active @endif"
                        href="{{ route('admin.permissions.create') }}">Create Permission</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-user"></i> <span> User</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.users.index') || request()->routeIs('admin.users.roles')) active @endif"
                        href="{{ route('admin.users.index') }}">All Users</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Master</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.title-master')) active @endif"
                        href="{{ route('admin.title-master') }}">Title</a></li>
                <li><a class="@if (request()->routeIs('admin.gender-master')) active @endif"
                        href="{{ route('admin.gender-master') }}">Gender</a></li>
                <li><a class="@if (request()->routeIs('admin.relation-master')) active @endif"
                        href="{{ route('admin.relation-master') }}">Relation</a></li>
                <li><a class="@if (request()->routeIs('admin.marital-master')) active @endif"
                        href="{{ route('admin.marital-master') }}">Marital</a></li>
                <li><a class="@if (request()->routeIs('admin.bloodgroup-master')) active @endif"
                        href="{{ route('admin.bloodgroup-master') }}">Bloodgroup</a></li>
                <li><a class="@if (request()->routeIs('admin.religion-master')) active @endif"
                        href="{{ route('admin.religion-master') }}">Religion</a></li>
                <li><a class="@if (request()->routeIs('admin.occupation-master')) active @endif"
                        href="{{ route('admin.occupation-master') }}">Occupation</a></li>

                <li><a class="@if (request()->routeIs('admin.department')) active @endif"
                        href="{{ route('admin.department') }}">Department</a></li>
                <li><a class="@if (request()->routeIs('admin.unit')) active @endif"
                        href="{{ route('admin.unit-master') }}">Unit</a></li>
                <li><a class="@if (request()->routeIs('admin.doctor-specialization-master')) active @endif"
                        href="{{ route('admin.doctor-specialization-master') }}">Doctor Specialization</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.referral-other')) active @endif"
                        href="{{ route('admin.referral-other') }}">Referral Other</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.health-coordinator')) active @endif"
                        href="{{ route('admin.health-coordinator') }}">Health Coordinator</a>
                </li>
                {{-- Address Master --}}
                <li><a class="@if (request()->routeIs('admin.country-master')) active @endif"
                        href="{{ route('admin.country-master') }}">Country</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.state-master')) active @endif"
                        href="{{ route('admin.state-master') }}">State</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.district-master')) active @endif"
                        href="{{ route('admin.district-master') }}">District</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.block-master')) active @endif"
                        href="{{ route('admin.block-master') }}">Block</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.village-master')) active @endif"
                        href="{{ route('admin.village-master') }}">Village</a>
                </li>



            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Consultation Charges</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.department-consultation-fee')) active @endif"
                        href="{{ route('admin.department-consultation-fee') }}">Department Fee</a></li>

                <li><a class="@if (request()->routeIs('admin.doctor-fee')) active @endif"
                        href="{{ route('admin.doctor-fee') }}">Doctor Fee</a></li>
                <li><a class="@if (request()->routeIs('admin.change-department-consultation-fee')) active @endif"
                        href="{{ route('admin.change-department-consultation-fee') }}">Change Consultation Fee</a></li>

            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Service Charges</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.billing-head-master')) active @endif"
                        href="{{ route('admin.billing-head-master') }}">Billing Head Master</a></li>
                <li><a class="@if (request()->routeIs('admin.location-master')) active @endif"
                        href="{{ route('admin.location-master') }}">Location Master</a></li>
                <li><a class="@if (request()->routeIs('admin.teriff-master')) active @endif"
                        href="{{ route('admin.teriff-master') }}">Teriff Master</a></li>
                <li><a class="@if (request()->routeIs('admin.service-group-master')) active @endif"
                        href="{{ route('admin.service-group-master') }}">Service Group Master</a></li>
                <li><a class="@if (request()->routeIs('admin.service-master')) active @endif"
                        href="{{ route('admin.service-master') }}">Service Master</a></li>
                <li><a class="@if (request()->routeIs('admin.package-master')) active @endif"
                        href="{{ route('admin.package-master') }}">Package Master</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-user-injured"></i></i><span> OPD Patient</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.patient.create')) active @endif"
                        href="{{ route('admin.patient.create') }}">New Patient Reg.</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.registration-with-consultation')) active @endif"
                        href="{{ route('admin.patient.registration-with-consultation') }}">Registration With
                        Consultation</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.list')) active @endif"
                        href="{{ route('admin.patient.list') }}">All Patients</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.consultation-list')) active @endif"
                        href="{{ route('admin.patient.consultation-list') }}">All Consultations</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.new-consultation-list')) active @endif"
                        href="{{ route('admin.patient.new-consultation-list') }}">New Consultations</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.old-consultation-list')) active @endif"
                        href="{{ route('admin.patient.old-consultation-list') }}">Old Consultations</a></li>

                <li><a class="@if (request()->routeIs('admin.opd-billing')) active @endif"
                        href="{{ route('admin.opd-billing') }}">OPD Billing</a></li>
                <li><a class="@if (request()->routeIs('admin.opd-bill-cancellation')) active @endif"
                        href="{{ route('admin.opd-bill-cancellation') }}">Cancel Bill</a></li>
                <li><a class="@if (request()->routeIs('admin.all-opd-bill')) active @endif"
                        href="{{ route('admin.all-opd-bill') }}">All OPD Billing</a></li>
                <li><a class="@if (request()->routeIs('admin.front-desk.today-user-wise-cash-collection')) active @endif"
                        href="{{ route('admin.front-desk.today-user-wise-cash-collection') }}">Today Cash
                        Collection</a></li>
                <li><a class="@if (request()->routeIs('admin.front-desk.user-wise-cash-collection')) active @endif"
                        href="{{ route('admin.front-desk.user-wise-cash-collection') }}">Cash Collection</a></li>

            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-user-injured"></i></i><span> IPD </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.ipd.nurse-station-master')) active @endif"
                        href="{{ route('admin.ipd.nurse-station-master') }}">Nurse Station Master</a></li>
                <li><a class="@if (request()->routeIs('admin.ipd.ward-tariff-master')) active @endif"
                        href="{{ route('admin.ipd.ward-tariff-master') }}">Ward Teriff Master</a></li>
                <li><a class="@if (request()->routeIs('admin.ipd.ward-group-master')) active @endif"
                        href="{{ route('admin.ipd.ward-group-master') }}">Ward Group Master</a></li>
                <li><a class="@if (request()->routeIs('admin.ipd.ward-master')) active @endif"
                        href="{{ route('admin.ipd.ward-master') }}">Ward Master</a></li>
                <li><a class="@if (request()->routeIs('admin.ipd.room-master')) active @endif"
                        href="{{ route('admin.ipd.room-master') }}">Room Master</a></li>
                <li><a class="@if (request()->routeIs('admin.ipd.admission')) active @endif"
                        href="{{ route('admin.ipd.admission') }}">IPD Registration</a></li>





            </ul>
        </li>


        <li class="submenu">
            <a href="#"><i class="la la-stethoscope"></i> <span> Doctor</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.doctor-registration')) active @endif"
                        href="{{ route('admin.doctor-registration') }}">Doctor Registration</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-capsules"></i> <span> Pharmacy Master</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.pharmacy.type-master')) active @endif"
                        href="{{ route('admin.pharmacy.type-master') }}">Type Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.stock-point-master')) active @endif"
                        href="{{ route('admin.pharmacy.stock-point-master') }}">Stock Point Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-group-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-group-master') }}">Item Group Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.generic-master')) active @endif"
                        href="{{ route('admin.pharmacy.generic-master') }}">Generic Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.form-master')) active @endif"
                        href="{{ route('admin.pharmacy.form-master') }}">Form (UOM) Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.category-master')) active @endif"
                        href="{{ route('admin.pharmacy.category-master') }}">Category Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-specialization-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-specialization-master') }}">Specialization</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.manufacturer-master')) active @endif"
                        href="{{ route('admin.pharmacy.manufacturer-master') }}">Manufacturer</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-master') }}">Add Item</a></li>

            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-shopping-basket"></i> <span> Bin</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.pharmacy.bin-group-master')) active @endif"
                        href="{{ route('admin.pharmacy.bin-group-master') }}">Bin Group</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.bin-master')) active @endif"
                        href="{{ route('admin.pharmacy.bin-master') }}">Bin</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.bin-item')) active @endif"
                        href="{{ route('admin.pharmacy.bin-item') }}">Add Item to Bin</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-vial"></i> <span> Lab</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-shopping-cart"></i><span>Purchase </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">

                <li><a class="@if (request()->routeIs('admin.pharmacy.vendor-registration')) active @endif"
                        href="{{ route('admin.pharmacy.vendor-registration') }}">Add Vendor</a></li>
                <li><a class="@if (request()->routeIs('admin.po.create-purchase-indent')) active @endif"
                        href="{{ route('admin.po.create-purchase-indent') }}">Purchase Indent</a></li>
                <li><a class="@if (request()->routeIs('admin.po.list-purchase-order')) active @endif"
                        href="{{ route('admin.po.list-purchase-order') }}">Purchase Order</a></li>
                <li><a class="@if (request()->routeIs('admin.grn.create-grn')) active @endif"
                        href="{{ route('admin.grn.create-grn') }}">Goods Receipt Notes</a></li>
                <li><a class="@if (request()->routeIs('admin.mrq.list-mrq')) active @endif"
                        href="{{ route('admin.mrq.list-mrq') }}">All MRQ</a></li>
                <li><a class="@if (request()->routeIs('admin.gin.create-gin')) active @endif"
                        href="{{ route('admin.gin.create-gin') }}">GIN</a></li>
                <li><a class="@if (request()->routeIs('admin.opd-medicine-sale.sale')) active @endif"
                        href="{{ route('admin.opd-medicine-sale.sale') }}">Medicine Sale</a></li>
                <li><a class="@if (request()->routeIs('admin.inventory.index')) active @endif"
                        href="{{ route('admin.inventory.index') }}">Inventory</a></li>
                <li><a class="@if (request()->routeIs('admin.salestore.index')) active @endif"
                        href="{{ route('admin.salestore.index') }}">Sales Stores</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.medicine-purchase-report')) active @endif"
                        href="{{ route('admin.pharmacy.medicine-purchase-report') }}">Purchase Report</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.pharmacy-cancle-receipt')) active @endif"
                        href="{{ route('admin.pharmacy.pharmacy-cancle-receipt') }}">All Cancle Receipts</a></li>


            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="fa fa-flask"></i><span>Central Lab </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">

                <li><a class="@if (request()->routeIs('admin.parameter-master')) active @endif"
                        href="{{ route('admin.parameter-master') }}">Parameter Master</a></li>
                <li><a class="@if (request()->routeIs('admin.format-setup')) active @endif"
                        href="{{ route('admin.format-setup') }}">Test Format Setup</a></li>
                <li><a class="@if (request()->routeIs('admin.template-setup')) active @endif"
                        href="{{ route('admin.template-setup') }}">Template Setup</a></li>
                <li><a class="@if (request()->routeIs('admin.antibiotic-master')) active @endif"
                        href="{{ route('admin.antibiotic-master') }}">Antibiotic Master</a></li>
                <li><a class="@if (request()->routeIs('admin.organism-master')) active @endif"
                        href="{{ route('admin.organism-master') }}">Organism Master</a></li>
                <li><a class="@if (request()->routeIs('admin.specimen-master')) active @endif"
                        href="{{ route('admin.specimen-master') }}">Specimen Master</a></li>
                <li><a class="@if (request()->routeIs('admin.vacutaine-master')) active @endif"
                        href="{{ route('admin.vacutaine-master') }}">Vacutaine Master</a></li>
                <li><a class="@if (request()->routeIs('admin.specimen-setup')) active @endif"
                        href="{{ route('admin.specimen-setup') }}">Specimen SetUp</a></li>
                <li><a class="@if (request()->routeIs('admin.sample-collection')) active @endif"
                        href="{{ route('admin.sample-collection') }}">Sample Collection</a></li>
                <li><a class="@if (request()->routeIs('admin.diagnostic-result-entry')) active @endif"
                        href="{{ route('admin.diagnostic-result-entry') }}">Diagnostic Result Entry</a></li>
                <li><a class="@if (request()->routeIs('admin.diagnostic-result-list')) active @endif"
                        href="{{ route('admin.diagnostic-result-list') }}">Diagnostic Result List</a></li>
            </ul>
        </li>

    </ul>
</div>
