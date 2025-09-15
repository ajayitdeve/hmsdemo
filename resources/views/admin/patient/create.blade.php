@extends('layouts.admin')
@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    {{-- <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Patient Registration</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <!-- /Page Header -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-user p-2">
                <div class="card-header">
                  <h5 class="card-title">Patient Registration</h5>
                </div>
                <div class="card-body">
                  @livewire('patient-registration')
                  </div>
              </div>
        </div>
    </div>

</div>
@endsection
