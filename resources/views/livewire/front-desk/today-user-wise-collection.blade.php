<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"> {{ $user->name }} , Cash Collection</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cash Collection</li>
                    </ul>
                </div>
                {{-- <div class="col-auto float-right ml-auto">
                    <a href="{{route('admin.patientvisit.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> New Registration</a>
                </div> --}}
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
                <h4>Consultation Charges Rs. {{ $consulationCharges->sum('amount') }} /-</h4>
                <div class="table-responsive">
                    <table data-order='[[ 0, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Patient</th>
                                <th>Consultation</th>
                                <th>Amount</th>
                                <th>Visit Date</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consulationCharges as $consulationCharge)
                                <tr>
                                    <td>{{ $consulationCharge->id }}</td>
                                    <td>{{ $consulationCharge->patient->registration_no }} -
                                        {{ $consulationCharge->patient->name }}</td>
                                    <td>{{ $consulationCharge->patientVisit->visit_no }}</td>
                                    <td>{{ $consulationCharge->amount }}</td>
                                    <td>{{ $consulationCharge->created_at }}</td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Opd Billing : Total Rs. {{ $opdBillings->sum('total') }} /- Paid Rs.
                    {{ $opdBillings->sum('paid') }}/- Balance Rs. {{ $opdBillings->sum('balance') }}/- </h4>
                <div class="table-responsive">
                    <table data-order='[[ 0, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Patient</th>
                                <th>Biill No</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Date</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opdBillings as $opdBilling)
                                <tr>
                                    <td>{{ $opdBilling->id }}</td>
                                    <td>
                                        @if ($opdBilling->patient != null)
                                            {{ $opdBilling->patient->registration_no }} -
                                            {{ $opdBilling->patient->name }}
                                        @endif
                                    </td>
                                    <td>{{ $opdBilling->code }}</td>
                                    <td>{{ $opdBilling->total }}</td>
                                    <td>{{ $opdBilling->paid }}</td>
                                    <td>{{ $opdBilling->balance }}</td>
                                    <td>{{ $opdBilling->created_at }}</td>


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
