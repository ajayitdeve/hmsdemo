<div id="sidebar-menu" class="sidebar-menu">
    <ul>

        <li class="menu-title">
            <span>OPD Coordinator</span>
        </li>

        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Consultation </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.patient.consultation-list')) active @endif" href="{{route('admin.patient.consultation-list')}}">Consultations</a></li>
                <li><a class="@if (request()->routeIs('admin.opd-coordinator.assign-doctor')) active @endif" href="{{route('admin.opd-coordinator.assign-doctor')}}">Assign Doctor</a></li>
                <li><a class="@if (request()->routeIs('admin.patient.consultation-list')) active @endif" href="{{route('admin.refer-patient')}}">Refer Patient</a></li>




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

                        <li><a class="@if (request()->routeIs('admin.opd-billing')) active @endif"
                            href="{{ route('admin.opd-billing') }}">OPD Billing</a></li>
                            <li><a class="@if (request()->routeIs('admin.all-opd-bill')) active @endif"
                                href="{{ route('admin.all-opd-bill') }}">All OPD Billing</a></li>

            </ul>
        </li>


    </ul>
</div>
