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
                <div class="card p-2">
                    <div class="">
                        <h3>
                            Add New Role
                        </h3>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST" action="{{ route('admin.roles.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <label id="name-error" class="text-danger error" for="email">{{ $message }}</label>
                                @enderror
                            </div>

                            <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
