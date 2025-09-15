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
                                <h3>Lab Indent</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
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
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
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
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="age">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input class="form-control" type="text" readonly wire:model="gender">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
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
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Consultant</label>
                                            <input class="form-control" type="text" readonly wire:model="consultant">
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
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Indent No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="indent_no">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Indent Date</label>
                                            <input class="form-control" type="date" readonly
                                                wire:model="indent_date">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Consultant Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="consultant_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Consultant Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="consultant_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" wire:model="remarks"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Instructions</label>
                                            <textarea class="form-control" wire:model="instructions"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Clinical Summary & Diagnosis</label>
                                            <textarea class="form-control" wire:model="clinical_summary_diagnosis"></textarea>
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
                                                <th>Sr. No.</th>
                                                <th>Service Name</th>
                                                <th>Service Code</th>
                                                <th>Service Date</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Service Group/Dept.</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                                <th>Total</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($arrCart as $index => $service)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $service['service_name'] }}
                                                    </td>
                                                    <td>{{ $service['service_code'] }}</td>
                                                    <td>
                                                        <input type="date" class="form-control"
                                                            wire:model="arrCart.{{ $index }}.service_date"
                                                            wire:change="serviceDateChanged({{ $index }}, $event.target.value)" />
                                                    </td>
                                                    <td>{{ $service['unit_service_price'] }}</td>
                                                    <td>{{ $service['quantity'] }}</td>
                                                    <td>{{ $service['service_group_department'] }}</td>
                                                    <td>{{ $service['discount'] }}</td>
                                                    <td>{{ $service['amount'] }}</td>
                                                    <td>{{ $service['total'] }}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn-primary"
                                                            wire:click="deleteCart({{ $index }})">
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
                                                <td>{{ $payableAmount }}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row ">
                                            <label class="col-md-4">Service Name<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <div>
                                                    <select class="form-control select2" name="service_id"
                                                        data-placeholder="Select service" wire:model="service_id">
                                                        <option value=""></option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('service_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label class="col-md-4">Quantity<span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control" wire:model="quantity"
                                                    wire:change='quantityChanged' min="1" />

                                                @error('quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label class="col-md-4">Rate<span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control"
                                                    wire:model="calculatedRate" min="1" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-4">Dis.(%)<span class="text-danger">*</span></label>
                                            <div class="col-md-8 ">
                                                <input type="number" maxlength="99" class="form-control"
                                                    wire:model='discount' wire:change="discountChanged" min="0" max="100" />
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-4">Dis. Amt.<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-8 ">
                                                <input type="number" class="form-control"
                                                    wire:model='discountAmount' wire:change="discountAmountChanged" />
                                                @error('discountAmount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row pt-2">
                                            <label class="col-md-4">Total<span class="text-danger">*</span></label>
                                            <div class="col-md-8 ">
                                                <input type="number" class="form-control" readonly
                                                    wire:model='total' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button type="button" class="btn btn-primary btn-sm d-block "
                                            wire:click="addToCart">
                                            Add
                                        </button>
                                    </div>
                                </div>

                                @if ($discount != 0 || $discountAmount != 0)
                                    <div class="row p-2 m-2 bg-info">
                                        <div class="col-md-12">
                                            <label class="col-md-4">Discount Approved By <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <select wire:model='discount_approved_by_id' class="form-control">
                                                    <option value="" disabled selected>Select one</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Payment Section --}}
                                <div class="row mt-4 pt-4 border-top border-primary">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-6">Payable Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly
                                                        wire:model="payableAmount" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-6">Paying Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        wire:model="payingAmount" wire:change='payingAmountChanged' />
                                                    @error('payingAmount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-6">Due Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly
                                                        wire:model="dueAmount" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary">Save</button>

                                        <a href="{{ route('admin.nurse.service-lab-indent.lab-indent', ['ipd' => $admn_no]) }}"
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
    <div wire:ignore.self class="modal custom-modgal fade" id="view-latest-lab-indent" data-backdrop="static"
        data-keyboard="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Indent Information</h3>
                        <p>
                            Indent No.
                            @if (Session::has('lab_indent_no'))
                                <span id="lab-indent-number">
                                    {{ session()->get('lab_indent_no') }}
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
                                <a href="{{ route('admin.nurse.service-lab-indent.lab-indent') }}"
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
                const labIndentNumber = document.getElementById('lab-indent-number').innerText;
                navigator.clipboard.writeText(labIndentNumber).then(() => {
                    let result = confirm("Copied to clipboard");
                    if (result) {
                        window.location.href = "{{ route('admin.nurse.service-lab-indent.lab-indent') }}";
                    }

                }).catch(err => {
                    console.error('Failed to copy: ', err);
                });
            }

            window.addEventListener('open-lab-indent-no-modal', event => {
                $("#view-latest-lab-indent").modal('show');
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

            $(document).on("change", "select[name='service_id']", function() {
                @this.call("serviceChanged");
            });
        </script>
    @endpush
</div>
