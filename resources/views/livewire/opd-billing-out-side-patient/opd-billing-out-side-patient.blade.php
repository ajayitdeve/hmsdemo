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
        <form wire:submit.prevent='save'>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">

                            <h2>OPD Service Billing-Out Side Patient</h2>

                        </div>
                        <div class="col-md-4 p-2 ">
                            <p class="btn btn-primary" wire:click="back_to_opd_billing">Back to OP/IP Billing </p>
                        </div>
                    </div>
                </div>



                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Patient's Name</label>
                                                <div class="row d-flex">
                                                    <select class="form-control  col-md-3" wire:model="title_id" required>
                                                        <option value="">Title</option>
                                                        @foreach ($titles as $title)
                                                            <option value="{{ $title->id }}">{{ $title->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('title_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <input type="text" class="form-control col-md-9"
                                                        wire:model="name">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <select class="form-control" wire:model="gender_id">
                                                    <option>Gender</option>
                                                    @foreach ($genders as $gender)
                                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Mobile No</label>
                                                <input type="number" class="form-control" wire:model="mobile">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="">Age</label>
                                                <input type="text" class="form-control" wire:model="age">
                                                @error('age')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control" wire:model="address">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                            <td> <button type="button" class="btn-primary"
                                                    wire:click="editCart({{ $service['id'] }})"><i
                                                        class="fa fa-trash"></i></button></td>

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
                                        <input type="number" maxlength="99" class="form-control" min="0" max="100"
                                            wire:model='discount' wire:change="discountChanged" />
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
                                        <input type="text" class="form-control" wire:model="payableAmount"
                                            readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row pt-2">
                                    <label class="col-md-6">Paying Amount<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" wire:model="payingAmount"
                                            wire:change='payingAmountChanged' readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row pt-2">
                                    <label class="col-md-6">Due Amount<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" wire:model="dueAmount" readonly />
                                    </div>
                                </div>
                            </div>

                        </div>
                        @if ($dueAmount != 0)
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

                                <button type="submit" class="btn btn-primary"> Pay</button>
                            </div>
                        </div>


                    </div>
                </div>

            </div>








        </form>







    </div>
