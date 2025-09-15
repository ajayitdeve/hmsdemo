@extends('layouts.admin')
@section('content')
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        {{-- <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome Admin!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div> --}}
        <!-- /Page Header -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-stats p-2">
                    <div class="">
                        <h3>All Opd Bills</h3>
                        <a href="{{ route('admin.patient.list') }}" class="text-primary text-bold float-right mr-4">OPD
                            Bills</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table data-order='[[ 4, "desc" ]]' class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Bill No</th>
                                        <th>UMR</th>
                                        <th>Patient Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($opdBillings as $opdBilling)
                                        @if ($opdBilling->patient_type == 'outside')
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $opdBilling->code }}</td>
                                                <td>{{ $opdBilling->outSidePatient->registration_no }}</td>
                                                <td>{{ $opdBilling->outSidePatient->name }}</td>
                                                <td>{{ $opdBilling->created_at }}</td>
                                                <td>
                                                    @if ($opdBilling->is_cancled == 0)
                                                        <a class="text-dark"
                                                            href="{{ route('admin.opd_billing_receipt_osp_print', $opdBilling->id) }}">
                                                            <i class="material-icons">print</i>
                                                        </a>
                                                    @else
                                                        Cancelled
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $opdBilling->code }}</td>
                                                <td>{{ $opdBilling->patient != null ? $opdBilling->patient->registration_no : null }}
                                                </td>
                                                <td>{{ $opdBilling->patient != null ? $opdBilling->patient->name : null }}
                                                </td>
                                                <td>{{ $opdBilling->created_at }}</td>
                                                <td>
                                                    @if ($opdBilling->is_cancled == 0)
                                                        <a class="text-dark"
                                                            href="{{ route('admin.opd_billing_receipt_print', $opdBilling->id) }}">
                                                            <i class="material-icons">print</i>
                                                        </a>
                                                    @else
                                                        Cancelled
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
