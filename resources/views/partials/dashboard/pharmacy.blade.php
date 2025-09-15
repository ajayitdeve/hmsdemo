<div class="content container-fluid">
    @include('partials.alert-message')

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @include('partials.medicine-expiry-alert')

    <div class="row">

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #2B77B0;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-circle-h" style="color:white;"></i></span>
                    <div class="dash-widget-info">
                        <?php
                        $vendors = \App\Models\Vendor::get();
                        ?>

                        <a href="{{ route('admin.pharmacy.vendor-registration') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ $vendors->count() }}</h3>
                                <span>Vendors</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #C60196;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-suitcase-medical"
                            style="color:white"></i></span>
                    <div class="dash-widget-info">
                        <?php
                        $po = \App\Models\PurchaseOrder::count();
                        ?>

                        <a href="{{ route('admin.po.list-purchase-order') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ $po }}</h3>
                                <span>Purchase Order</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #EC851E;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-hand-holding-medical"
                            style="color:white"></i></span>
                    <div class="dash-widget-info">
                        <?php
                        $totalSale = \App\Models\OpdMedicineTransaction::sum('taxable_amount');
                        $totalDue = \App\Models\PharmacyDue::where('is_due_cleared', 1)->sum('due_amount');
                        $grossSale = $totalSale - $totalDue;
                        
                        ?>

                        <a href="{{ route('admin.opd-medicine-receipt-list') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ $grossSale }}</h3>
                                <span>Total Sale</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #6C330F;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-kit-medical" style="color:white;"></i></span>
                    <div class="dash-widget-info">


                        <a href="{{ route('admin.opd-medicine-receipt-list') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ $totalDue }}</h3>
                                <span>Total Dues</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #FFC107;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-hand-holding-droplet"
                            style="color:white;"></i></span>
                    <div class="dash-widget-info">
                        <?php
                        $grn = \App\Models\Grn::get();
                        
                        ?>

                        <a href="{{ route('admin.grn.create-grn') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ $grn->sum('invoice_value') }}</h3>
                                <span>Total Purchase</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #A6A63B;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-briefcase-medical"
                            style="color:white;"></i></span>
                    <div class="dash-widget-info">

                        <?php
                        $innventoryBonusSum = \App\Models\Inventory::sum('bonus');
                        $innventoryQuantitySum = \App\Models\Inventory::sum('quantity');
                        $ginSumQuantity = \App\Models\GinItem::sum('quantity');
                        ?>
                        <a href="{{ route('admin.inventory.stock') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ $innventoryBonusSum + $innventoryQuantitySum - $ginSumQuantity }}</h3>
                                <span>Stock</span>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent Purchase Orders</h3>
                </div>
                <?php
                $recentPos = \App\Models\PurchaseOrder::orderBy('id', 'DESC')->take(10)->get();
                ?>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>

                                    <th>Code</th>
                                    <th>Vendor</th>

                                    <th>Date</th>
                                    <th>Action</th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentPos as $purchaseOrder)
                                    <tr>

                                        <td>{{ $purchaseOrder->code }}</td>
                                        <td>{{ $purchaseOrder->vendor != null ? $purchaseOrder->vendor->name : null }}
                                        </td>

                                        <td>{{ $purchaseOrder->created_at }}</td>


                                        <td>


                                            <a target="_blank" style="display:inline;float:right"
                                                class="btn btn-xs  text-success"
                                                href="{{ route('admin.po.print', $purchaseOrder->id) }}"><i
                                                    class="fa fa-print m-r-5"></i></button>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.po.list-purchase-order') }}">View all PO</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent GIN</h3>
                </div>
                <?php
                $gins = \App\Models\Gin::orderBy('id', 'DESC')->take(10)->get();
                ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>

                                    <th>Code</th>
                                    <th>Stock Point</th>
                                    <th>Date</th>

                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gins as $gin)
                                    <tr>

                                        <td>{{ $gin->code }}</td>
                                        <td>{{ $gin->stockpoint->name }}</td>
                                        <td>{{ $gin->created_at }}</td>

                                        <td>


                                            <a target="_blank" style="display:inline;float:right"
                                                class="btn btn-xs  text-success"
                                                href="{{ route('admin.gin.create-gin-items', $gin->id) }}"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></button>

                                        </td>


                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.gin.create-gin') }}">View all GIN</a>
                </div>
            </div>
        </div>
    </div>

</div>
