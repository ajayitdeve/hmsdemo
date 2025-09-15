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
                        <h3>Import Beds</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{ route('admin.ipd.import-beds') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" class="form-control " name="file" />
                                        <input type="submit" class="btn btn-primary" value="Upload">
                                        <input type="hidden" name="ward_id" value="{{ $ward_id }}">
                                        <input type="hidden" name="room_id" value="{{ $room_id }}">
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
