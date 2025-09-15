<div>
    @push('page-css')
        <style>
            .form-control {
                font-size: 13px;
                height: 30px !important;
            }

            label {
                display: inline-block;
                margin-bottom: 0px;
                font-size: 13px;
            }
        </style>
    @endpush

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Purchase Orders </h3>

                    {{-- <ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Dashboard</a></li>
									<li class="breadcrumb-item active">Purchase Indent</li>
								</ul> --}}
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.po.list-purchase-indent') }}" class="btn add-btn"><i class="fa fa-list"></i>
                        All Purchase Indents</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif



        <div class="row">
            <div class="col-md-12 text-center">
                <hr />
                <h3>Purchase Orders</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Code</th>
                                <th>Vendor</th>
                                <th>Stock Point</th>
                                <th>Indent Code</th>
                                <th>Remarks</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseOrders as $purchaseOrder)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $purchaseOrder->code }}</td>
                                    <td>{{ $purchaseOrder->stockpoint->name }}</td>
                                    <td>{{ $purchaseOrder->vendor ? $purchaseOrder->vendor->name : null }}</td>
                                    <td>{{ $purchaseOrder->purchaseindent->code }}</td>
                                    <td>{{ $purchaseOrder->remarks }}</td>
                                    <td>{{ $purchaseOrder->created_at }}</td>
                                    <td>{{ $purchaseOrder->status == 0 ? 'Not Approved' : 'Approved' }}
                                        @if ($purchaseOrder->status == 0 && $currentRole == 'admin')
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="approve({{ $purchaseOrder->id }})">Approve</button>
                                        @endif
                                    </td>


                                    <td>

                                        <a class="btn btn-xs text-success"
                                            href="{{ route('admin.po.print', $purchaseOrder->id) }}"><i
                                                class="fa fa-print m-r-5"></i> Print PO</button>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{-- {{  $vendorInvoices->links('pagination::bootstrap-5')}} --}}
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Content -->
</div>
