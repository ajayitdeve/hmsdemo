@extends('layouts.admin')

@section('content')
    @can('dashboard_admin', \App\Models\Sidebar::class)
        @include('partials.dashboard.admin')
    @endcan

    @can('dashboard_cental_pharmacy', \App\Models\Sidebar::class)
        @include('partials.dashboard.pharmacy')
    @endcan

    @can('dashboard_op_pharmacy', \App\Models\Sidebar::class)
        @include('partials.dashboard.op-pharmacy')
    @endcan

    @can('dashboard_opd_coordinator', \App\Models\Sidebar::class)
        @include('partials.dashboard.opd-coordinator')
    @endcan

    @can('dashboard_front_desk', \App\Models\Sidebar::class)
        @include('partials.dashboard.front-desk')
    @endcan

    @can('dashboard_lab', \App\Models\Sidebar::class)
        @include('partials.dashboard.lab')
    @endcan

    @can('dashboard_nurse', \App\Models\Sidebar::class)
        @include('partials.dashboard.nurse')
    @endcan

    @can('dashboard_ot', \App\Models\Sidebar::class)
        @include('partials.dashboard.ot')
    @endcan

    @can('dashboard_blood_bank', \App\Models\Sidebar::class)
        @include('partials.dashboard.blood-bank')
    @endcan

    {{-- =========================================================================================== --}}

    @can('superadminadmin', \App\Models\Sidebar::class)
        @include('partials.dashboard.superadmin')
    @endcan

    @can('dashboard_ot_pharmacy', \App\Models\Sidebar::class)
        @include('partials.dashboard.ot-pharmacy')
    @endcan

    @can('dashboard_emg_pharmacy', \App\Models\Sidebar::class)
        @include('partials.dashboard.emg-pharmacy')
    @endcan
@endsection
