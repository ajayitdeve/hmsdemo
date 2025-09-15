<div id="sidebar-menu" class="sidebar-menu">
    <ul>



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
                            href="{{ route('admin.front-desk.today-user-wise-cash-collection') }}">Today  Cash Collection</a></li>
                            <li><a class="@if (request()->routeIs('admin.front-desk.user-wise-cash-collection')) active @endif"
                                href="{{ route('admin.front-desk.user-wise-cash-collection') }}">Cash Collection</a></li>

            </ul>
        </li>


    </ul>
</div>
