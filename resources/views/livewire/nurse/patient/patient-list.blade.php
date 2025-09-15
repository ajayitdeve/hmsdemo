<div>
    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Patient List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Patient List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row mb-4">
            <div class="col-md-3">
                <input type="search" class="form-control" wire:model.debounce.500ms="search" placeholder="Search">
            </div>
            <div class="col-md-9"></div>

        </div>


        <div class="row">
            @if ($ipds->count() > 0)
                @foreach ($ipds as $ipd)
                    <div class="col-md-4 col-lg-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-bed"></i>
                                        {{ $ipd?->bed?->display_name }}
                                    </span>

                                    <div class="menu-bar">
                                        <button class="btn btn-secondary" type="button">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                        <ul class="menu-container">
                                            <li class="menu-item">
                                                <a href="#">
                                                    Drug Management
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>

                                                <ul class="sub-menu-bar">
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.drug-management.create-drug-indent', $ipd->ipdcode) }}">
                                                            Drug Indents
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="menu-item">
                                                <a href="#">
                                                    Service & Lab Indents
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>

                                                <ul class="sub-menu-bar">
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.service-lab-indent.create-lab-indent', $ipd->ipdcode) }}">
                                                            Lab Indents
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="menu-item">
                                                <a href="#">
                                                    Bed Management
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>

                                                <ul class="sub-menu-bar">
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.bed-management.bed-transfer', $ipd->ipdcode) }}">
                                                            Bed Transfer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="menu-item">
                                                <a href="#">
                                                    Nursing Process
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>

                                                <ul class="sub-menu-bar">
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.nurse-notes', $ipd->ipdcode) }}">
                                                            Nurse Notes
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.vital-entry', $ipd->ipdcode) }}">
                                                            Vital Entry
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.intake-output', $ipd->ipdcode) }}">
                                                            InTake/OutPut
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.diet-indent', $ipd->ipdcode) }}">
                                                            Diet Indent
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.new-diet-plan', $ipd->ipdcode) }}">
                                                            New Diet Plan
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.diet-sheet', $ipd->ipdcode) }}">
                                                            Diet Sheet
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.nurse.nursing-process.abnormal-entry', $ipd->ipdcode) }}">
                                                            Abnormal Entry
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('admin.nurse.discharge.to-be-discharge', $ipd->ipdcode) }}">
                                                    To Be Discharge
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('admin.nurse.discharge.discharge-process-status', $ipd->ipdcode) }}">
                                                    Discharge Process Status
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a href="{{ route('admin.nurse.doctor-visit', $ipd->ipdcode) }}">
                                                    Doctor Visits
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a href="{{ route('admin.nurse.doctor-msg', $ipd->ipdcode) }}">
                                                    Doctor Msg
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('admin.nurse.equipment.equipment-usage', $ipd->ipdcode) }}">
                                                    Equipment Usage
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('admin.nurse.equipment.equipment-time-entry', $ipd->ipdcode) }}">
                                                    Equipment To Time Entry
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('admin.nurse.patient-approximate-bill', $ipd->ipdcode) }}">
                                                    Patient Approximate Bill
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a href="{{ route('admin.nurse.patient-info', $ipd->ipdcode) }}">
                                                    InPatient Info
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('admin.nurse.patient-medical-details', $ipd->ipdcode) }}">
                                                    Patient Medical Details
                                                </a>
                                            </li>

                                            <li class="menu-item">
                                                <a href="{{ route('admin.nurse.cross-consultation', $ipd->ipdcode) }}">
                                                    Cross Consultation
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ $ipd->ipdcode }}</span>
                                    <span>{{ date('d-M-Y', strtotime($ipd->created_at)) }}</span>
                                </div>

                                <div class="mt-2">
                                    <p class="mb-1">
                                        {{ $ipd->patient?->name }} S/o {{ $ipd->patient?->father_name }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>
                                            Age:
                                            {{ Carbon\Carbon::parse($ipd?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY, %mM, %dD') }}
                                        </span>
                                        <span>Gender: {{ $ipd?->patient?->gender?->name }}</span>
                                    </div>

                                    <p class="mb-0">{{ $ipd?->patient_visit?->doctor?->name }}</p>
                                </div>
                            </div>

                            <div class="card-footer">
                                DR SD
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <p class="text-danger">No result found...</p>
                </div>
            @endif
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    {!! $ipds->links() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @push('page-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuBars = document.querySelectorAll('.menu-bar');

                menuBars.forEach(menuBar => {
                    menuBar.addEventListener('mouseover', function() {
                        const menuContainer = this.querySelector('.menu-container');
                        const menuRect = menuContainer.getBoundingClientRect();
                        const screenWidth = window.innerWidth;

                        // Check if the right edge of the menu exceeds the screen width
                        if (menuRect.right > screenWidth) {
                            menuContainer.classList.add('open-left');
                        } else {
                            menuContainer.classList.remove('open-left');
                        }
                    });

                    menuBar.addEventListener('mouseout', function() {
                        const menuContainer = this.querySelector('.menu-container');
                        menuContainer.classList.remove('open-left');
                    });
                });
            });
        </script>
    @endpush
</div>
