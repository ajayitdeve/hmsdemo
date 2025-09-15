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
    <div class="content container-fluid mb-0 pb-0">
        <div class="row mb-0 pb-0">
            <div class="col-md-12 mb-0 pb-0">
                @include('partials.alert-message')

                <div>
                    <form wire:submit.prevent='save' class="mb-0 pb-0">

                        <div class="card">
                            <div class="card-header">
                                <h3>IP Pharmacy Billing</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bill No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="bill_no">
                                            @error('bill_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bill Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" readonly wire:model="bill_date">
                                            @error('bill_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="umr">
                                            @error('umr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" readonly
                                                value="{{ $stock_point->name }}" />
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Admn No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="admn_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Req. Dept.</label>
                                            <input class="form-control" type="text" readonly wire:model="req_dept">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Indent No.<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="nrq_no" wire:model="nrq_no"
                                                data-placeholder="Select NRQ">
                                                <option value=""></option>
                                                @foreach ($drug_indent_list as $drug_indent)
                                                    <option value="{{ $drug_indent->nrq_code }}">
                                                        {{ $drug_indent->nrq_code }}</option>
                                                @endforeach
                                            </select>
                                            @error('nrq_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Indent By</label>
                                            <input class="form-control" type="text" readonly wire:model="indent_by">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Corp. Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                            @error('corporate_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Drug Destination Name</label>
                                            <input class="form-control" type="text"
                                                wire:model="drug_destination_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Item Name</th>
                                                <th>Batch No</th>
                                                <th>Exp. Date</th>
                                                <th>Qunatity</th>
                                                <th>Unit Sale Price</th>
                                                <th>Amount</th>
                                                <th>Discount</th>
                                                <th>Taxable Amount</th>
                                                <th>Total</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arrCart as $item)
                                                <tr>
                                                    <td>{{ $item['id'] }}</td>
                                                    <td>{{ $item['item_name'] }}</td>
                                                    <td>{{ $item['batch_no'] }}</td>
                                                    <td>{{ $item['exd'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['unit_sale_price'] }}</td>
                                                    <td>{{ $item['amount'] }}</td>
                                                    <td>{{ $item['discount'] }}</td>
                                                    <td>{{ $item['taxable_amount'] }}</td>
                                                    <td>{{ $item['total'] }}</td>
                                                    <td class="text-right">
                                                        <button type="button" class="btn-primary"
                                                            wire:click="editCart({{ $item['id'] }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th>{{ $payableAmount }}</th>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row ">
                                                <label class="col-md-3">Item<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" name="item_id"
                                                        data-placeholder="Select item" wire:model='item_id'>
                                                        <option value=""></option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->description }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('item_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row ">
                                                <label class="col-md-3">Batch No<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select wire:model.lazy='batch_no' class="form-control"
                                                        wire:change="batchNoChanged({{ $batch_no }})">
                                                        <option value="">Select Batch No</option>
                                                        @foreach ($batch_nos as $key => $item)
                                                            <option value="{{ $item['batch_no'] }}">
                                                                {{ $item['batch_no'] }}
                                                                ({{ $item['quantity'] }})
                                                            </option>
                                                        @endforeach
                                                        @error('batch_no')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Quantity<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" wire:model='quantity'
                                                        wire:change="quantityChanged" />
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Sale Price<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        wire:model='unit_sale_price' readonly />

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" wire:model='amount'
                                                        readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Expiry Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" readony
                                                        wire:model='exd' readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Dis.(%)<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <input type="number" maxlength="99" class="form-control"
                                                        wire:model='discount' wire:change="discountChanged" />
                                                </div>

                                                <label class="col-md-3">Dis. Amt.<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control"
                                                        wire:model='discountAmount'
                                                        wire:change="discountAmountChanged" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Taxable Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        wire:model='taxable_amount' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">CGST<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" wire:model="cgst" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    @if ($discount != 0 || $discountAmount != 0)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-md-3">Discount Approved By <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <select wire:model='discount_approved_by_id'
                                                            class="form-control">
                                                            {{-- <option value="-1">Select </option> --}}
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">SGST<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" wire:model="sgst" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Total<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" wire:model='total'
                                                        readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-sm btn-block"
                                            wire:click="addToCart">
                                            Add
                                        </button>
                                    </div>
                                </div>


                                {{-- Payment Section --}}
                                <div class="row mt-3 pt-4 border-top border-primary">
                                    @if (isset($ipPharmacyDue))
                                        @if ($ipPharmacyDue->where('is_due_cleared', 0)->count())
                                            <div class="col-md-3">
                                                <div class="row pt-2">
                                                    <label class="col-md-6">Dues<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" readonly
                                                            value="{{ $ipPharmacyDue->where('is_due_cleared', 0)->sum('due_amount') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-6">Payable Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" readonly
                                                    wire:model="payableAmount" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-6">Paying Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" wire:model="payingAmount"
                                                    wire:change='payingAmountChanged' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-6">Due Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" wire:model="dueAmount" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if ($dueAmount != 0)
                                    <div class="row p-2 m-2 bg-info">
                                        <div class="col-md-12">
                                            <label class="col-md-4">Due Approved By <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <select wire:model='due_approved_by_id' class="form-control">
                                                    {{-- <option value="-1">Select </option> --}}
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#payment-sheet-modal">Save</button>

                                        <a href="{{ route('admin.pharmacy.issues.ip-pharmacy-billing', ['ipd' => $admn_no]) }}"
                                            target="_blank" class="btn btn-info">Previous Indents</a>
                                    </div>
                                </div>

                                @include('partials.modal.payment-sheet-modal')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });


            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='nrq_no']", function() {
                @this.call("nrqNoChanged");
            });

            $(document).on("change", "select[name='item_id']", function() {
                @this.call("itemChanged");
            });
        </script>
    @endpush
</div>
