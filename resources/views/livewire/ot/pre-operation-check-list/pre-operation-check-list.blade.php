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

            .custom-control-label::before,
            .custom-control-label::after {
                top: .05rem;
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
                                <h3>OT Pre Operation CheckList</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Check List No</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="check_list_no">
                                            @error('check_list_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Check List Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="check_list_date">
                                            @error('check_list_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="umr"
                                                data-placeholder="Select UMR" wire:model="umr">
                                                <option value=""></option>
                                                @foreach ($patients as $patient)
                                                    <option value="{{ $patient->registration_no }}">
                                                        {{ $patient->registration_no }}</option>
                                                @endforeach
                                            </select>
                                            @error('umr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="age">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input class="form-control" type="text" readonly wire:model="gender">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="admn_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                            @error('admn_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Consultant</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="consultant_name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Corp. Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_code">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Corp. Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'surgery-details') active @endif"
                                            id="pills-surgery-details-tab" data-toggle="pill"
                                            data-target="#pills-surgery-details" type="button" role="tab"
                                            aria-controls="pills-surgery-details" aria-selected="true"
                                            wire:click="setActiveTab('surgery-details')">Surgery
                                            Details</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'patient-check-list') active @endif"
                                            id="pills-patient-check-list-tab" data-toggle="pill"
                                            data-target="#pills-patient-check-list" type="button" role="tab"
                                            aria-controls="pills-patient-check-list" aria-selected="false"
                                            wire:click="setActiveTab('patient-check-list')">
                                            Patient Check List
                                        </button>
                                    </li>
                                </ul>

                                <hr>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade @if ($activeTab === 'surgery-details') show active @endif"
                                        id="pills-surgery-details" role="tabpanel"
                                        aria-labelledby="pills-surgery-details-tab">

                                        <div class="row mb-0 pb-0">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Pre Oper. No</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="pre_operartion_no">
                                                    @error('pre_operartion_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Pre Oper. Date</label>
                                                    <input class="form-control" type="datetime-local" readonly
                                                        wire:model="pre_operartion_date">
                                                    @error('pre_operartion_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="service_id"
                                                        data-placeholder="Select Surgery" wire:model="service_id">
                                                        <option value=""></option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">
                                                                {{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('service_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery Code<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="service_code">
                                                    @error('service_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery Date</label>
                                                    <input class="form-control" type="date"
                                                        wire:model="surgery_date">
                                                    @error('surgery_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Blood Group<span class="text-danger">*</span></label>
                                                    <select class="form-control" wire:model="blood_group_id">
                                                        <option value="">Not Specified</option>
                                                        @foreach ($blood_groups as $bloodGroup)
                                                            <option value="{{ $bloodGroup->id }}">
                                                                {{ $bloodGroup->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('blood_group_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Weight<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            wire:model="weight">

                                                        <div class="input-group-append">
                                                            <span class="input-group-text py-0"
                                                                id="basic-addon2">kgs</span>
                                                        </div>
                                                    </div>
                                                    @error('weight')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Height<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            wire:model="height">

                                                        <div class="input-group-append">
                                                            <span class="input-group-text py-0"
                                                                id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    @error('height')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Last Food Date</label>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="last_food_date">
                                                    @error('last_food_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Last Fluid Date</label>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="last_fluid_date">
                                                    @error('last_fluid_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Escort Nurse<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text"
                                                        wire:model="escort_nurse">
                                                    @error('escort_nurse')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Theater Nurse<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text"
                                                        wire:model="theater_nurse">
                                                    @error('theater_nurse')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'patient-check-list') show active @endif"
                                        id="pills-patient-check-list" role="tabpanel"
                                        aria-labelledby="pills-patient-check-list-tab">

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="name-and-hospital-number-on-wrist-band"
                                                            wire:model="name_and_hospital_number_on_wrist_band">
                                                        <label class="custom-control-label"
                                                            for="name-and-hospital-number-on-wrist-band">
                                                            Name And Hospital Number On Wrist Band
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="surgery-consent-form-completed-and-signed-by-patient-and-wintess"
                                                            wire:model="surgery_consent_form_completed_and_signed_by_patient_and_wintess">
                                                        <label class="custom-control-label"
                                                            for="surgery-consent-form-completed-and-signed-by-patient-and-wintess">
                                                            Surgery Consent Form Completed & Signed By Patient & Wintess
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="pre-medication-given-as-ordered-and-time-given"
                                                            wire:model="pre_medication_given_as_ordered_and_time_given">
                                                        <label class="custom-control-label"
                                                            for="pre-medication-given-as-ordered-and-time-given">
                                                            Pre - Medication Given As Ordered & Time Given
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="correct-area-shaved-and-prepared"
                                                            wire:model="correct_area_shaved_and_prepared">
                                                        <label class="custom-control-label"
                                                            for="correct-area-shaved-and-prepared">
                                                            Correct Area Shaved & Prepared (Check With Patient)
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="weight-trp-bp-recorded-and-allergies-listed"
                                                            wire:model="weight_trp_bp_recorded_and_allergies_listed">
                                                        <label class="custom-control-label"
                                                            for="weight-trp-bp-recorded-and-allergies-listed">
                                                            Weight, TRP, B.P.Recorded And Allergies Listed
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="dentures-removed-or-accompanying-the-patient"
                                                            wire:model="dentures_removed_or_accompanying_the_patient">
                                                        <label class="custom-control-label"
                                                            for="dentures-removed-or-accompanying-the-patient">
                                                            Dentures Removed Or Accompanying The Patient
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="x-rays-ct-scan-and-mri-films-other-reports-sent-including-hiv-hbsag-hsv-and-hcv"
                                                            wire:model="xrays_ct_scan_and_mri_films_other_reports_sent_including_hiv_hbsag_hsv_and_hcv">
                                                        <label class="custom-control-label"
                                                            for="x-rays-ct-scan-and-mri-films-other-reports-sent-including-hiv-hbsag-hsv-and-hcv">
                                                            X-Rays, CT Scan & MRI Films, Other Reports Sent Including
                                                            HIV,
                                                            HbsAg, HSV & HCV
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="total-no-of-films-sent-to-ot"
                                                            wire:model="total_no_of_films_sent_to_ot">
                                                        <label class="custom-control-label"
                                                            for="total-no-of-films-sent-to-ot">
                                                            Total No. Of Films Sent to OT
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>X-Rays</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='x_rays'>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>CT</label>
                                                        <input type="text" class="form-control" wire:model='ct'>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>MRI</label>
                                                        <input type="text" class="form-control" wire:model='mri'>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="bath-given" wire:model="bath_given">
                                                        <label class="custom-control-label" for="bath-given">
                                                            Bath Given
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="nail-polish-removed" wire:model="nail_polish_removed">
                                                        <label class="custom-control-label" for="nail-polish-removed">
                                                            Nail Polish Removed
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="hair-clips-removed" wire:model="hair_clips_removed">
                                                        <label class="custom-control-label" for="hair-clips-removed">
                                                            Hair Clips Removed
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="jewellery-removed" wire:model="jewellery_removed">
                                                        <label class="custom-control-label" for="jewellery-removed">
                                                            Jewellery Removed
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="contact-lens-removed"
                                                            wire:model="contact_lens_removed">
                                                        <label class="custom-control-label"
                                                            for="contact-lens-removed">
                                                            Contact Lens Removed
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="hearing-aid-must-goto-theatre"
                                                            wire:model="hearing_aid_must_goto_theatre">
                                                        <label class="custom-control-label"
                                                            for="hearing-aid-must-goto-theatre">
                                                            Hearing aid + Must goto Theatre
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="rings-nose-and-ear-studs-taped"
                                                            wire:model="rings_nose_and_ear_studs_taped">
                                                        <label class="custom-control-label"
                                                            for="rings-nose-and-ear-studs-taped">
                                                            Rings, Nose & Ear Studs Taped
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="false-eye-mention-which-side"
                                                            wire:model="false_eye_mention_which_side">
                                                        <label class="custom-control-label"
                                                            for="false-eye-mention-which-side">
                                                            False Eye-Mention Which Side
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class="pt-1">
                                                    <input type="text" class="form-control mt-3"
                                                        wire:model='eye_mention_side'>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="old-notes" wire:model="is_old_notes">
                                                        <label class="custom-control-label" for="old-notes">
                                                            Old Notes
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" wire:model="old_notes"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="other-prostheses-specify-if-any"
                                                            wire:model="is_other_prostheses_specify_if_any">
                                                        <label class="custom-control-label"
                                                            for="other-prostheses-specify-if-any">
                                                            Other Prostheses-Specify if any
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" wire:model="other_prostheses_specify_if_any"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="urine-passed-time-and-volume"
                                                            wire:model="is_urine_passed_time_and_volume">
                                                        <label class="custom-control-label"
                                                            for="urine-passed-time-and-volume">
                                                            Urine Passed-Time And Volume
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="datetime-local" class="form-control"
                                                            wire:model="urine_passed_time">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                wire:model="urine_passed_volume">

                                                            <div class="input-group-append">
                                                                <span class="input-group-text py-0">ml</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

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

            $(document).on("change", "select[name='service_id']", function() {
                @this.call("serviceChanged");
            });
        </script>
    @endpush
</div>
