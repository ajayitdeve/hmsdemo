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
                                <h3>Drug Indent</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>NRQ No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="nrq_no">
                                            @error('nrq_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>NRQ Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" readonly wire:model="nrq_date">
                                            @error('nrq_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Req By</label>
                                            <input class="form-control" type="text" wire:model="req_by">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" type="text" wire:model="status">
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
                                            <label>Admn Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                            @error('admn_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" wire:model="bed">
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
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Nurse Dept.</label>
                                            <input class="form-control" type="text"
                                                wire:model="nurse_department_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Nurse Dept. Name</label>
                                            <input class="form-control" type="text"
                                                wire:model="nurse_department_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_code">
                                            @error('doctor_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_name">
                                            @error('doctor_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="stock_point_id"
                                                wire:model="stock_point_id" data-placeholder="Select Stock Point">
                                                <option value=""></option>
                                                @foreach ($stock_points as $stockpoint)
                                                    <option value="{{ $stockpoint->id }}">
                                                        {{ $stockpoint->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('stock_point_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="stock_point_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Corp. Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="corporate_name">
                                            @error('corporate_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Doctor Dept.</label>
                                            <input class="form-control" type="text"
                                                wire:model="doctor_department_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Doctor Dept. Name</label>
                                            <input class="form-control" type="text"
                                                wire:model="doctor_department_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input class="form-control" type="text" wire:model="remarks">
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
                                                {{-- <th>Batch No</th> --}}
                                                <th>Qunatity</th>
                                                {{-- <th>Unit Sale Price</th> --}}
                                                {{-- <th>Amount</th> --}}
                                                {{-- <th>Discount</th> --}}
                                                {{-- <th>Taxable Amount</th> --}}
                                                <th>Total</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arrCart as $item)
                                                <tr>
                                                    <td>{{ $item['id'] }}</td>
                                                    <td>{{ $item['item_name'] }}</td>
                                                    {{-- <td>{{ $item['batch_no'] }}</td> --}}
                                                    <td>{{ $item['quantity'] }}</td>
                                                    {{-- <td>{{ $item['unit_sale_price'] }}</td> --}}
                                                    {{-- <td>{{ $item['amount'] }}</td> --}}
                                                    {{-- <td>{{ $item['discount'] }}</td> --}}
                                                    {{-- <td>{{ $item['taxable_amount'] }}</td> --}}
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
                                                {{-- <td></td> --}}
                                                <td></td>
                                                {{-- <td></td> --}}
                                                {{-- <td></td> --}}
                                                {{-- <td></td> --}}
                                                {{-- <td></td> --}}
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

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row ">
                                                <label class="col-md-3">Batch No<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    @if ($batch_nos != null)
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
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Quantity<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" wire:model='quantity'
                                                        wire:change="quantityChanged" min="1" />
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-4">
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
                                    </div> --}}

                                    {{-- <div class="col-md-4">
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
                                    </div> --}}

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">Dis.(%)<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <input type="number" maxlength="99" class="form-control"
                                                        wire:model='discount' wire:change="discountChanged" />
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <label class="col-md-3">Dis. Amt.<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control"
                                                        wire:model='discountAmount'
                                                        wire:change="discountAmountChanged" />
                                                    @error('discountAmount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-4">
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
                                    </div> --}}

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">CGST<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" wire:model="cgst" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}


                                    {{-- @if ($discount != 0 || $discountAmount != 0)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-md-3">Discount Approved By <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <select wire:model='discount_approved_by_id'
                                                            class="form-control">
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
                                    @endif --}}

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3">SGST<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" wire:model="sgst" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-4">
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
                                    </div> --}}

                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-sm btn-block"
                                            wire:click="addToCart">
                                            Add
                                        </button>
                                    </div>
                                </div>


                                {{-- Payment Section --}}
                                <div class="row mt-3 pt-4 border-top border-primary">
                                    @if (isset($pharmacyDue))
                                        @if ($pharmacyDue->where('is_due_cleared', 0)->count())
                                            <div class="col-md-3">
                                                <div class="row pt-2">
                                                    <label class="col-md-6">Dues<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" readonly
                                                            value="{{ $pharmacyDue->where('is_due_cleared', 0)->sum('due_amount') }}" />
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
                                                @error('payingAmount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-6">Due Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" readonly
                                                    wire:model="dueAmount" />
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

                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Save</button>

                                        <a href="{{ route('admin.nurse.drug-management.drug-indent', ['ipd' => $admn_no]) }}"
                                            target="_blank" class="btn btn-info">Previous Indents</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal custom-modgal fade" id="view-latest-drug-indent" data-backdrop="static"
        data-keyboard="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Indent Information</h3>
                        <p>
                            NRQ No.
                            @if (Session::has('nrq_no'))
                                <span id="nrq-number">
                                    {{ session()->get('nrq_no') }}
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" onclick="copyToClipboard()"
                                    class="btn btn-primary continue-btn btn-block">Copy</>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.nurse.drug-management.drug-indent') }}"
                                    class="btn btn-primary cancel-btn">Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            function copyToClipboard() {
                const nrqNumber = document.getElementById('nrq-number').innerText;
                navigator.clipboard.writeText(nrqNumber).then(() => {
                    let result = confirm("Copied to clipboard");
                    if (result) {
                        window.location.href = "{{ route('admin.nurse.drug-management.drug-indent') }}";
                    }

                }).catch(err => {
                    console.error('Failed to copy: ', err);
                });
            }

            window.addEventListener('open-nrq-no-modal', event => {
                $("#view-latest-drug-indent").modal('show');
            });

            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='stock_point_id']", function() {
                @this.call("stockPointChanged");
            });

            $(document).on("change", "select[name='item_id']", function() {
                @this.call("itemChanged");
            });
        </script>
    @endpush
</div>
