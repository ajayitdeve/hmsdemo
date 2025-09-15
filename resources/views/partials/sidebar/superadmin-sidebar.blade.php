<div id="sidebar-menu" class="sidebar-menu">
    <ul>

        <li class="menu-title">
            <span>Main</span>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Role</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.roles.index')) active @endif" href="{{ route('admin.roles.index') }}">
                        All Roles</a></li>
                <li><a class="@if (request()->routeIs('admin.roles.create') || request()->routeIs('admin.roles.edit')) active @endif"
                        href="{{ route('admin.roles.create') }}">Create Role</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Permession</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.permissions.index')) active @endif"
                        href="{{ route('admin.permissions.index') }}">All Permissions</a></li>
                <li><a class="@if (request()->routeIs('admin.permissions.create') || request()->routeIs('admin.permissions.edit')) active @endif"
                        href="{{ route('admin.permissions.create') }}">Create Permission</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> User</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.users.index') || request()->routeIs('admin.users.roles')) active @endif"
                        href="{{ route('admin.users.index') }}">All Users</a></li>

            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Patient</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.patient.create')) active @endif"
                        href="{{ route('admin.patient.create') }}">New Patient Reg.</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.list')) active @endif"
                        href="{{ route('admin.patient.list') }}">All Patients</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.consultation-list')) active @endif"
                        href="{{ route('admin.patient.consultation-list') }}">All Consultations</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Doctor</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.doctor-registration')) active @endif"
                        href="{{ route('admin.doctor-registration') }}">Doctor Registration</a></li>

            </ul>
        </li>
        {{-- master specialist-master --}}
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Master</span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.title-master')) active @endif"
                        href="{{ route('admin.title-master') }}">Title</a></li>

                <li><a class="@if (request()->routeIs('admin.patient.list')) active @endif"
                        href="{{ route('admin.patient.list') }}">Referral</a></li>
                <li><a class="@if (request()->routeIs('admin.department')) active @endif"
                        href="{{ route('admin.department') }}">Department</a></li>
                <li><a class="@if (request()->routeIs('admin.doctor-specialization-master')) active @endif"
                        href="{{ route('admin.doctor-specialization-master') }}">Doctor Specialization</a></li>

            </ul>
        </li>

        {{-- pharmacy --}}
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Pharmacy Master</span> <span
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
                        href="{{ route('admin.pharmacy.item-specialization-master') }}">Specialization</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.manufacturer-master')) active @endif"
                        href="{{ route('admin.pharmacy.manufacturer-master') }}">Manufacturer</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-master') }}">Add Item</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.manufacturer-master')) active @endif" href="">Purchase Order
                        Terms</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"> <i class="la la-dashboard"></i> <span> Purchase </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">

                <li><a class="">Add Vendor</a></li>
                <li><a class="">Purchase Indent</a></li>
                <li><a class="">Purchase Order Entry</a></li>
                <li><a class="">Goods Receipt Notes</a></li>
            </ul>
        </li>

        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Issue </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="">Product Transfer</a></li>
                <li><a class="">Scrape Transfer Entry</a></li>
                <li><a class="">Goods Receipt Notes</a></li>
            </ul>
        </li>

    </ul>
</div>
