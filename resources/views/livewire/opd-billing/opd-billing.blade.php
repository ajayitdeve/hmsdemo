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
    <div>
        @include('partials.alert-message')
        {{-- <form wire:submit.prevent='save'> --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h2>OPD Service Billing</h2>

                        <a href="{{ route('admin.opd-billing-overall-discount') }}">Overall Discount Opd Billing</a>
                    </div>
                    {{-- <div class="col-md-2">
                        {{ $patient_type }}
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" wire:model="patient_type"
                                    value="op">OP
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" wire:model="patient_type"
                                    value="ip">IP
                            </label>
                        </div>
                        <div class="form-check-inline disabled">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" wire:model="patient_type" value="outside"
                                    wire:change='is_outside'>Out Side Patient
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body">

                <div class="row">
                    @if ($patient_type == 'op')
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">UMR No</label>
                                <select class="form-control select2" name="umr" data-placeholder="Select"
                                    wire:model="umr">
                                    <option value=""></option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->registration_no }}">{{ $patient->registration_no }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('umr')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    @if ($patient_type == 'ip')
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">IPD No</label>
                                <select class="form-control select2" name="ipd" data-placeholder="Select"
                                    wire:model="ipd">
                                    <option value=""></option>
                                    @foreach ($ipds as $ipd)
                                        <option value="{{ $ipd->ipdcode }}">{{ $ipd->ipdcode }}</option>
                                    @endforeach
                                </select>
                                @error('ipd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Patient's Name</label>
                                            <input type="text" class="form-control" readonly wire:model="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ $relation }} Of</label>
                                            <input type="text" class="form-control" readonly wire:model="fatherName">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age</label>
                                            <input type="text" class="form-control" readonly wire:model="age">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Doctor's Name</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Department</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_department">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Unit</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_unit">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" class="form-control" readonly wire:model="address">
                                        </div>
                                    </div>
                                </div>
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
                                    <th>Service</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($arrCart as $service)
                                    <tr>
                                        <td>{{ $service['id'] }}</td>
                                        <td>{{ $service['service_name'] }} ({{ $service['service_code'] }})</td>
                                        <td>{{ $service['unit_service_price'] }}</td>
                                        <td>{{ $service['quantity'] }}</td>
                                        <td>{{ $service['discount'] }}</td>
                                        <td>{{ $service['amount'] }}</td>
                                        <td>{{ $service['total'] }}</td>
                                        <td>
                                            <button type="button" class="btn-primary"
                                                wire:click="editCart({{ $service['id'] }})">
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
                                    <td>{{ $payableAmount }}</td>
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
                        <div class="col-md-3">
                            <div class="row ">
                                <label class="col-md-4">Service Name<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control" wire:model="service_id"
                                        wire:change="serviceChanged">
                                        <option value="">Select Service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-4">Quantity<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" wire:model="quantity" min="1"
                                        wire:change='quantityChanged' />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-4">Rate<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" wire:model="calculatedRate" min="1"
                                        readonly />
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-4">Dis.(%)<span class="text-danger">*</span></label>
                                <div class="col-md-8 ">
                                    <input type="number" maxlength="99" class="form-control" wire:model='discount' min="0" max="100"
                                        wire:change="discountChanged" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-4">Dis. Amt.<span class="text-danger">*</span></label>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" wire:model='discountAmount' min="0"
                                        wire:change="discountAmountChanged" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-4">Total<span class="text-danger">*</span></label>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" readonly wire:model='total' />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-primary btn-sm d-block "
                                wire:click="addToCart">Add</button>

                        </div>


                    </div>
                    @if ($discount != 0 || $discountAmount != 0)
                        <div class="row p-2 m-2 bg-info">
                            <div class="col-md-12">
                                <label class="col-md-4">Discount Approved By <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select wire:model='discount_approved_by_id' class="form-control">
                                        {{-- <option value="-1">Select </option> --}}
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
                    <div class="row mt-2 border-top border-primary">
                        @if (isset($serviceDue))
                            @if ($serviceDue->where('is_due_cleared', 0)->count())
                                <div class="col-md-3">
                                    <div class="row pt-2">
                                        <label class="col-md-6">Dues<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" readonly
                                                value="{{ $serviceDue->where('is_due_cleared', 0)->sum('due_amount') }}" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Payable Amount<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" readonly wire:model="payableAmount" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Paying Amount<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" wire:model="payingAmount"
                                        wire:change='payingAmountChanged' />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Due Amount<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" wire:model="dueAmount" />
                                </div>
                            </div>
                        </div>

                    </div>
                    @if ($dueAmount > 0)
                        <div class="row p-2 m-2 bg-info">
                            <div class="col-md-12">
                                <label class="col-md-4">Due Approved By <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select wire:model='due_approved_by_id' class="form-control">
                                        {{-- <option value="-1">Select </option> --}}
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-center">

                            {{-- <button type="submit" class="btn btn-primary "> Pay</button> --}}
                            <button class="btn btn-primary m-2" wire:click="confirmation" href="#"
                                data-toggle="modal" data-target="#confirmation">Pay</button>
                        </div>
                    </div>


                </div>
            </div>

        </div>








        {{-- </form> --}}





        <!-- Confirmation  Modal -->
        <div wire:ignore.self class="modal custom-modgal fade" id="confirmation" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form wire:submit.prevent='save'>
                            <div class="form-header">
                                <h3>OPD Billing </h3>
                                <p>Are you sure want to submit ?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn btn-block">Pay</>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Confirmation  Modal -->
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

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='ipd']", function() {
                @this.call("ipdChanged");
            });
        </script>
    @endpush
</div>
