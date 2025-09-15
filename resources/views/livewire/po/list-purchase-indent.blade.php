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
                    <h3 class="page-title">All Purchase Indents </h3>
                    {{-- <ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Dashboard</a></li>
									<li class="breadcrumb-item active">Purchase Indent</li>
								</ul> --}}
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.po.list-purchase-indent') }}" class="btn add-btn"><i class="fa fa-plus"></i>
                        Create Purchase Indents</a>
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
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Code</th>
                                <th>Stock Point</th>
                                <th>Vendor </th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>


                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentIndents as $indent)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $indent->code }}</td>
                                    <td>{{ $indent->stockpoint->name }}</td>
                                    <td>{{ $indent->vendor != null ? $indent->vendor->name : null }}</td>
                                    <td>{{ $indent->type->name }}</td>
                                    <td>{{ $indent->request_date }}</td>
                                    <td>
                                        @if ($indent->status == 1)
                                            <span class="badge bg-inverse-success">PO Created</span>
                                        @else
                                            <span class="badge bg-inverse-danger">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($indent->status == 1)
                                            <a style="display:inline;" class="btn btn-xs text-info" target="_blank"
                                                href="{{ route('admin.po.print', $indent->purchaseorder->first()?->id) }}"><i
                                                    class="fa fa-print "></i>View PO</a>
                                        @else
                                            <a style="display:inline;" class="btn btn-xs text-info"
                                                href="{{ route('admin.po.create-po-new', ['purchase_indent_id' => $indent->id]) }}"><i
                                                    class="fa fa-print "></i> Create PO</a>
                                        @endif
                                        <button style="display:inline;float:right"
                                            wire:click="delete({{ $indent->id }})" class="btn btn-xs  text-danger"
                                            href="#" data-toggle="modal" data-target="#delete"><i
                                                class="fa fa-trash-o m-r-5"></i> Delete</button>
                                        <a style="display:inline;float:right" class="btn btn-xs  text-success"
                                            href="{{ route('admin.po.show-purchase-indent', $indent->id) }}"><i
                                                class="fa fa-eye m-r-5"></i> View</button>
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
