<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Patient</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Patient</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->
        <form wire:submit.prevent='update'>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ $patient->relation->name }}<span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-4 mr-0 pr-0">
                                <select class="form-control" wire:model="relation_id" tabindex="17">

                                    @foreach ($relations as $relation)
                                        <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                    @endforeach
                                </select>
                                @error('relation_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-8 ml-0 pl-0">
                                <input class="form-control " type="text" wire:model="father_name" tabindex="18">
                                @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" wire:model="mobile" class="form-control">
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" wire:model="email" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>DOB <span class="text-danger">*</span></label>
                        <input class="form-control" type="date" wire:model.lazy="dob" wire:change.lazy='calculateAge'
                            max="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-100 year', time())) }}"
                            tabindex="3">
                        @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Enter Age<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" wire:model.live="rawage"
                            wire:change.live='changeRwaAge' tabindex="4">
                        <span class="text-danger">{{ $ageError }}</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Calculated Age</label>
                        <input class="form-control" type="text" wire:model="age" max="99" disabled
                            tabindex="5">
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Search Village"
                            wire:model.live="village_text" wire:change="villageChanged">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control" wire:model="village_id" wire:change="villageSelectionChanged"
                        tabindex="14">
                        <option value="-1">Select Village</option>
                        @foreach ($villages as $village)
                            <option value="{{ $village->id }}">{{ $village->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">

                        <input class="form-control" type="text" wire:model="address" tabindex="15">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Pin Code</label>
                        <input class="form-control" wire:model="pincode"
                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                            type="tel" maxlength="6" pattern="[0-9]{6}" title="6 Digit Pincode">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" submit-section">
                        <button class="btn btn-primary submit-btn">Update Details</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- /Page Content -->


</div>
