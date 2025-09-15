@extends('layouts.admin')
@section('content')
<div class="content container-fluid">

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
                    <h3>Consultation Charges</h3>
                    <a href="{{route('admin.patient.list')}}"  class="text-primary text-bold float-right mr-4">Patient List</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dt-mant-table">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>UMR</th>
                                    <th>Consultation Code</th>
                                    <th>Patient Name</th>
                                    <th>Department</th>
                                    <th>Unit</th>
                                    <th>Doctor</th>
                                    <th>Amount</th>
                                    <th>Received By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultationCharges as $consultationCharge)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $consultationCharge->patient->registration_no }}</td>
                                    <td>{{ $consultationCharge->patientvisit->visit_no}}</td>
                                    <td>{{$consultationCharge->patient->name}}</td>
                                    <td>{{ $consultationCharge->patientvisit->department->name}}</td>
                                    <td>{{ $consultationCharge->patientvisit->unit->name}}</td>
                                    <td>{{ isset($consultationCharge->patientvisit->doctor->name) ? $consultationCharge->patientvisit->doctor->name:'Not Assigned'}}
                                    <td>{{ $consultationCharge->amount }}</td>
                                    <td>{{ $consultationCharge->user->name }}</td>

                                </tr>
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
