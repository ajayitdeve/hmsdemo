@extends('layouts.admin')
@section('content')
<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-stats p-2">
                <div class="">
                    <h3>Pharmacy-Purchase Report</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">From </label>
                                <input type="date" class="form-control" name="from">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">To </label>
                                <input type="date" class="form-control" name="to">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Item</label>
                                <select class="form-control" name="" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Batch No</label>
                                <select class="form-control" name="" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Vendor</label>
                                <select class="form-control" name="" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
