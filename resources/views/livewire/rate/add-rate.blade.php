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
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Change Rate</h3>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
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

                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Item <span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="item_id" wire:change.live="itemChanged">
                                <option value="-1">Select </option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->code }}</option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                @if ($hideForm == false)
                    <div class="row">
                        <div class="col-md-12 col-sm-12 m-0 p-0 ">

                            @if (sizeof($rates) > 0)
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0">

                                        <thead>
                                            <tr>

                                                <th>Code</th>
                                                <th>Batch No</th>
                                                <th>Purchase Rate </th>
                                                <th>Sale Rate </th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            @endif
                            @forelse($rates as $rate)
                                <tr>
                                    <td>{{ $rate->item->code }}</td>
                                    <td>{{ $rate->batch_no }}</td>
                                    <td>{{ $rate->new_purchase_rate }}</td>
                                    <td>{{ $rate->new_sale_rate }}</td>
                                    <td>{{ $rate->doc }}</td>
                                    <td>{{ $rate->status }}</td>
                                </tr>

                                </tbody>
                                </table>
                            @empty

                                <form wire:submit.prevent='save'>
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="row">
                                                <label class="col-md-4">Batch No <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" wire:model='batch_no' class="form-control">

                                                    @error('batch_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label class="col-md-4">Purchase Rate<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" wire:model='new_purchase_rate'
                                                        class="form-control">

                                                    @error('new_purchase_rate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label class="col-md-4">Sale Rate<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" wire:model='new_sale_rate'
                                                        class="form-control">

                                                    @error('new_sale_rate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="ubmit-section mt-2 pt-2 text-center">
                                        <input type="submit" class="btn btn-primary submit-btn" value="Submit" />
                                    </div>
                                </form>
                            @endforelse
                        </div>


                    </div>
            </div>

            @endif
        </div>
    </div>
    <!-- List of Indents-->
    <!-- List of Invoices-->




</div>
</div>
<!-- /Page Content -->
</div>
