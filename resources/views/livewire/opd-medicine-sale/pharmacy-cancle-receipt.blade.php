<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pharmacy Cancled Receipts</h3>
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pharmacy Cancled Receipts</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->
        {{-- <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control mb-2" wire:model.live.debounce.300mx="search" placeholder="search">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table data-order='[[ 0, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Type</th>
                                <th>Stock Point</th>
                                <th>Cancle Date</th>
                                <th>Calclled By</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opdMedicineReceipts as $opdMedicineReceipt)
                            <tr>
                                <td>{{$opdMedicineReceipt->id}}</td>
                               <td><a href="{{route('admin.pharmacy.pharmacy-cancle-transaction',$opdMedicineReceipt->id)}}" >{{$opdMedicineReceipt->code}}</a></td>
                                <td>{{$opdMedicineReceipt->patient!=null?$opdMedicineReceipt->patient->registration_no:null}}</td>
                                <td>{{$opdMedicineReceipt->patient!=null?$opdMedicineReceipt->patient->name:null}}</td>
                                <td>{{strtoupper($opdMedicineReceipt->patient_type)}}</td>
                                <td>{{$opdMedicineReceipt->stockPoint->name}}</td>
                                <td>{{$opdMedicineReceipt->cancled_date}}</td>

                                <td> {{$opdMedicineReceipt->cancleBy->name }}</td>


                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <a  class="dropdown-item" href="{{route('admin.pharmacy.pharmacy-cancle-transaction',$opdMedicineReceipt->id)}}"  ><i class="fa fa-eye m-r-5"></i> View</a>
                                        </div>
                                    </div>
                                </td>




                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


</div>


