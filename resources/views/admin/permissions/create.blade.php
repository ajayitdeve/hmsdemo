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
                <div class="card card-user p-2">
                    <div class="card-header">
                        <h5 class="card-title">Permission</h5>
                    </div>
                    <div class="card-body">
                        <form id="form_validation" method="POST" action="{{ route('admin.permissions.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-line">
                                    <label class="form-label">Permission Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <label id="name-error" class="error text-danger"
                                            for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
