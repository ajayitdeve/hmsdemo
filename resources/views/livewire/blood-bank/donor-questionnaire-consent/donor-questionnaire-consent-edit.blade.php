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
                                <h3>Donor Questionnaire & Consent Edit</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="text-right">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="voluntary"
                                                    value="1" wire:model="voluntary">
                                                <label class="custom-control-label" for="voluntary">Voluntary</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Donor Reg. No<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="donor_id"
                                                data-placeholder="Select Donor Reg. No" wire:model="donor_id">
                                                <option value=""></option>
                                                @foreach ($donors as $donor)
                                                    <option value="{{ $donor->id }}">
                                                        {{ $donor->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('donor_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="donor_title">
                                            @error('donor_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Donor Name</label>
                                            <input class="form-control" type="text" readonly wire:model="donor_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="donor_father_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="donor_age">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="donor_gender">
                                            @error('donor_gender')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UMR No</label>
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

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="patient_title">
                                            @error('patient_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_father_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_age">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="patient_gender">
                                            @error('patient_gender')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>IPD No</label>
                                            <select class="form-control select2" name="ipd_id"
                                                data-placeholder="Select" wire:model="ipd_id">
                                                <option value=""></option>
                                                @foreach ($ipds as $ipd)
                                                    <option value="{{ $ipd->id }}">
                                                        {{ $ipd->ipdcode }}</option>
                                                @endforeach
                                            </select>
                                            @error('ipd_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Blood Bag No</label>
                                            <input class="form-control" type="text" wire:model="blood_bag_no">
                                            @error('blood_bag_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Would you like us to call you on mobile / क्या आप चाहते हैं
                                                            कि
                                                            हम आपको मोबाइल पर कॉल करें?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="call_status_yes" name="call_status"
                                                                    value="1" wire:model="call_status">
                                                                <label class="form-check-label"
                                                                    for="call_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="call_status_no" name="call_status"
                                                                    value="0" wire:model="call_status">
                                                                <label class="form-check-label"
                                                                    for="call_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($call_status == 0)
                                                        <tr>
                                                            <td>
                                                                If No, Why / अगर नहीं, तो क्यों?
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="call_status_remarks">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>
                                                            Have you donated previously / क्या आपने पहले कभी रक्तदान
                                                            किया
                                                            है?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="donation_status_yes" name="donation_status"
                                                                    value="1" wire:model="donation_status">
                                                                <label class="form-check-label"
                                                                    for="donation_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="donation_status_no" name="donation_status"
                                                                    value="0" wire:model="donation_status">
                                                                <label class="form-check-label"
                                                                    for="donation_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($donation_status == 1)
                                                        <tr>
                                                            <td>
                                                                If Yes, How many occasion / अगर हाँ, तो कितनी बार?
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="donation_occasion">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>
                                                            When last meal / आपने आखिरी बार खाना कब खाया था?
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="last_meal">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            When last blood donated / आपने आखिरी बार रक्तदान कब किया था?
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="last_blood_donated">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Time of last meal / आखिरी भोजन का समय?
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="last_meal_time">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Did you have any discomfort during/after donation / क्या
                                                            रक्तदान के समय या बाद में आपको कोई परेशानी हुई?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="discomfort_status_yes"
                                                                    name="discomfort_status" value="1"
                                                                    wire:model="discomfort_status">
                                                                <label class="form-check-label"
                                                                    for="discomfort_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="discomfort_status_no" name="discomfort_status"
                                                                    value="0" wire:model="discomfort_status">
                                                                <label class="form-check-label"
                                                                    for="discomfort_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($discomfort_status == 1)
                                                        <tr>
                                                            <td>
                                                                If Yes, What / अगर हाँ, तो क्या?
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="discomfort_status_remarks">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td colspan="2">
                                                            2003* National AIDS Control Organization :<br>
                                                            <strong>An Action Plan For Blood Safety</strong> रक्त
                                                            सुरक्षा के लिए कार्य योजना :
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            1. Do you feel well today / क्या आप आज ठीक महसूस कर रहे हैं?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="well_status_yes" name="well_status"
                                                                    value="1" wire:model="well_status">
                                                                <label class="form-check-label"
                                                                    for="well_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="well_status_no" name="well_status"
                                                                    value="0" wire:model="well_status">
                                                                <label class="form-check-label"
                                                                    for="well_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($well_status == 0)
                                                        <tr>
                                                            <td>
                                                                If No, Why / यदि नहीं, तो कृपया कारण बताएं।
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="well_status_remarks">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>
                                                            2. Did you have something to eat the last 4 hours / क्या
                                                            आपने पिछले 4 घंटों में कुछ खाया है?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="eat_status_yes" name="eat_status"
                                                                    value="1" wire:model="eat_status">
                                                                <label class="form-check-label"
                                                                    for="eat_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="eat_status_no" name="eat_status"
                                                                    value="0" wire:model="eat_status">
                                                                <label class="form-check-label"
                                                                    for="eat_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($eat_status == 1)
                                                        <tr>
                                                            <td>
                                                                If Yes, What / अगर हाँ, तो क्या?
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="eat_status_remarks">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>
                                                            3. Do you sleep well last night / क्या आप ने कल रात अच्छी
                                                            नींद ली?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="sleep_status_yes" name="sleep_status"
                                                                    value="1" wire:model="sleep_status">
                                                                <label class="form-check-label"
                                                                    for="sleep_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="sleep_status_no" name="sleep_status"
                                                                    value="0" wire:model="sleep_status">
                                                                <label class="form-check-label"
                                                                    for="sleep_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($sleep_status == 0)
                                                        <tr>
                                                            <td>
                                                                If No, Why / यदि नहीं, तो कृपया कारण बताएं।
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="sleep_status_remarks">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>
                                                            4. Have you any reason to belive that you may be infected by
                                                            other Hepatitis, Malaria, HIV, AIDS, and/or venereal
                                                            disease / क्या आपके पास ऐसा कोई कारण है जिससे आपको विश्वास
                                                            हो कि आप हेपेटाइटिस, मलेरिया, HIV, AIDS, और/या यौन संचारित
                                                            रोग से संक्रमित हो सकते हैं?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="reason_status_yes" name="reason_status"
                                                                    value="1" wire:model="reason_status">
                                                                <label class="form-check-label"
                                                                    for="reason_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="reason_status_no" name="reason_status"
                                                                    value="0" wire:model="reason_status">
                                                                <label class="form-check-label"
                                                                    for="reason_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if ($reason_status == 1)
                                                        <tr>
                                                            <td>
                                                                If Yes, What / अगर हाँ, तो क्या?
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    wire:model="reason_status_remarks">
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>
                                                            5. In the last 6 months have you had any history of the
                                                            following / पिछले 6 महीने में क्या आपको इनमें से किसी भी
                                                            बीमारी का सामना करना पड़ा है.
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1"
                                                                            id="unexplained_weight_loss"
                                                                            wire:model="unexplained_weight_loss">
                                                                        <label class="custom-control-label"
                                                                            for="unexplained_weight_loss">Unexplained
                                                                            weight loss</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="swollen_gland"
                                                                            wire:model="swollen_gland">
                                                                        <label class="custom-control-label"
                                                                            for="swollen_gland">Swollen
                                                                            gland</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="repeated_diarrhoea"
                                                                            wire:model="repeated_diarrhoea">
                                                                        <label class="custom-control-label"
                                                                            for="repeated_diarrhoea">Repeated
                                                                            Diarrhoea</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1"
                                                                            id="continuous_low_grade_fever"
                                                                            wire:model="continuous_low_grade_fever">
                                                                        <label class="custom-control-label"
                                                                            for="continuous_low_grade_fever">Continuous
                                                                            Low-grade fever</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            6. In the last 6 months have you had any / क्या आपने पिछले 6
                                                            महीनों में कोई.
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="tattooing"
                                                                            wire:model="tattooing">
                                                                        <label class="custom-control-label"
                                                                            for="tattooing">Tattooing</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="ear_piarcing"
                                                                            wire:model="ear_piarcing">
                                                                        <label class="custom-control-label"
                                                                            for="ear_piarcing">Ear Piarcing</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="dental_extration"
                                                                            wire:model="dental_extration">
                                                                        <label class="custom-control-label"
                                                                            for="dental_extration">Dental
                                                                            Extration</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            7. Do you suffer from or have suffered from any of the
                                                            following disease / क्या आप निम्नलिखित किसी भी बीमारी से
                                                            पीड़ित हैं या पहले पीड़ित रह चुके हैं?
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="heart_disease"
                                                                            wire:model="heart_disease">
                                                                        <label class="custom-control-label"
                                                                            for="heart_disease">Heart Disease</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="lung_disease"
                                                                            wire:model="lung_disease">
                                                                        <label class="custom-control-label"
                                                                            for="lung_disease">Lung Disease</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="kedney_disease"
                                                                            wire:model="kedney_disease">
                                                                        <label class="custom-control-label"
                                                                            for="kedney_disease">
                                                                            Kedney Disease
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="cancer_disease"
                                                                            wire:model="cancer_disease">
                                                                        <label class="custom-control-label"
                                                                            for="cancer_disease">
                                                                            Cancer/Maliganant Disease
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="epilepsy"
                                                                            wire:model="epilepsy">
                                                                        <label class="custom-control-label"
                                                                            for="epilepsy">
                                                                            Epilepsy
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="diabetes"
                                                                            wire:model="diabetes">
                                                                        <label class="custom-control-label"
                                                                            for="diabetes">
                                                                            Diabetes
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="tuberculosis"
                                                                            wire:model="tuberculosis">
                                                                        <label class="custom-control-label"
                                                                            for="tuberculosis">
                                                                            Tuberculosis
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1"
                                                                            id="abnormal_bleeding_tendency"
                                                                            wire:model="abnormal_bleeding_tendency">
                                                                        <label class="custom-control-label"
                                                                            for="abnormal_bleeding_tendency">
                                                                            Abnormal bleeding tendency
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="hepatitis_bc"
                                                                            wire:model="hepatitis_bc">
                                                                        <label class="custom-control-label"
                                                                            for="hepatitis_bc">
                                                                            Hepatitis B/C
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="allergic_disease"
                                                                            wire:model="allergic_disease">
                                                                        <label class="custom-control-label"
                                                                            for="allergic_disease">
                                                                            Allergic Disease
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="jaundice"
                                                                            wire:model="jaundice">
                                                                        <label class="custom-control-label"
                                                                            for="jaundice">
                                                                            Jaundice (Last 1 Yr.)
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1"
                                                                            id="sexual_transmitted_disease"
                                                                            wire:model="sexual_transmitted_disease">
                                                                        <label class="custom-control-label"
                                                                            for="sexual_transmitted_disease">
                                                                            Sexual Transmitted Disease
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="malaria"
                                                                            wire:model="malaria">
                                                                        <label class="custom-control-label"
                                                                            for="malaria">
                                                                            Malaria (6 Months)
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="typhoid"
                                                                            wire:model="typhoid">
                                                                        <label class="custom-control-label"
                                                                            for="typhoid">
                                                                            Typhoid (1 Yr.)
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="fainting_spells"
                                                                            wire:model="fainting_spells">
                                                                        <label class="custom-control-label"
                                                                            for="fainting_spells">
                                                                            Fainting spells
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            8. Are you taking or have taken any of these in the past 72
                                                            hours / क्या आप पिछले 72 घंटों से निम्नलिखित में से कोई सेवन
                                                            किया है?
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="antibiotics"
                                                                            wire:model="antibiotics">
                                                                        <label class="custom-control-label"
                                                                            for="antibiotics">Antibiotics</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="aspirin"
                                                                            wire:model="aspirin">
                                                                        <label class="custom-control-label"
                                                                            for="aspirin">Aspirin</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="alcohol"
                                                                            wire:model="alcohol">
                                                                        <label class="custom-control-label"
                                                                            for="alcohol">
                                                                            Alcohol
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="steroids"
                                                                            wire:model="steroids">
                                                                        <label class="custom-control-label"
                                                                            for="steroids">
                                                                            Steroids
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="vaccinations"
                                                                            wire:model="vaccinations">
                                                                        <label class="custom-control-label"
                                                                            for="vaccinations">
                                                                            Vaccinations
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1"
                                                                            id="dog_bites_rabies_vaccine"
                                                                            wire:model="dog_bites_rabies_vaccine">
                                                                        <label class="custom-control-label"
                                                                            for="dog_bites_rabies_vaccine">
                                                                            Dog Bites/Rabies Vaccine (1 Yr.)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            9. Is there any history of surgery or blood transfusion in
                                                            the past 6 months / क्या आपके पिछले 6 महीनों में किसी सर्जरी
                                                            या रक्त संचारण का इतिहास रहा है?
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="major"
                                                                            wire:model="major">
                                                                        <label class="custom-control-label"
                                                                            for="major">Major</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="minor"
                                                                            wire:model="minor">
                                                                        <label class="custom-control-label"
                                                                            for="minor">Minor</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            value="1" id="bt"
                                                                            wire:model="bt">
                                                                        <label class="custom-control-label"
                                                                            for="bt">
                                                                            B.T.
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            FOR WOMEN / महिलाओं के लिए
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            10. Are you pregnant क्या आप गर्भवती हैं?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="pregnant_status_yes" name="pregnant_status"
                                                                    value="1" wire:model="pregnant_status">
                                                                <label class="form-check-label"
                                                                    for="pregnant_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="pregnant_status_no" name="pregnant_status"
                                                                    value="0" wire:model="pregnant_status">
                                                                <label class="form-check-label"
                                                                    for="pregnant_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Have you had an aberration in the last 3 months / क्या पिछले
                                                            3 महीनों में आपका गर्भपात हुआ है?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="aberration_status_yes"
                                                                    name="aberration_status" value="1"
                                                                    wire:model="aberration_status">
                                                                <label class="form-check-label"
                                                                    for="aberration_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="aberration_status_no" name="aberration_status"
                                                                    value="0" wire:model="aberration_status">
                                                                <label class="form-check-label"
                                                                    for="aberration_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Do you have a child less than one year old / क्या आपका एक
                                                            वर्ष से कम उम्र का बच्चा है?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="child_status_yes" name="child_status"
                                                                    value="1" wire:model="child_status">
                                                                <label class="form-check-label"
                                                                    for="child_status_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="child_status_no" name="child_status"
                                                                    value="0" wire:model="child_status">
                                                                <label class="form-check-label"
                                                                    for="child_status_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            2003* National AIDS Control Organization
                                                            <br>
                                                            <strong>An Action Plan For Blood Safety</strong> / रक्त
                                                            सुरक्षा के लिए कार्य योजना
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            11. Would you like to be informed about any abnormal test
                                                            result
                                                            as furnished by you / क्या आप द्वारा प्रदान किए गए किसी भी
                                                            असामान्य परीक्षण परिणाम के बारे में सूचित किए जाना चाहेंगे?
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="abnormal_test_result_yes"
                                                                    name="abnormal_test_result" value="1"
                                                                    wire:model="abnormal_test_result">
                                                                <label class="form-check-label"
                                                                    for="abnormal_test_result_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="abnormal_test_result_no"
                                                                    name="abnormal_test_result" value="0"
                                                                    wire:model="abnormal_test_result">
                                                                <label class="form-check-label"
                                                                    for="abnormal_test_result_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            Have you read and understood all the information presented
                                                            and answered all the questions truthfully,<br>
                                                            as any incorrect statement or concealment may affect your
                                                            health or may harm the recipient / क्या आपने प्रस्तुत की गई
                                                            सभी जानकारी पढ़ी और समझी है, तथा सभी प्रश्नों का
                                                            सत्यनिष्ठापूर्वक उत्तर दिया है? क्योंकि किसी भी गलत विवरण या
                                                            जानकारी छिपाने से आपके स्वास्थ्य पर प्रभाव पड़ सकता है या
                                                            रक्त प्राप्तकर्ता को नुकसान हो सकता है?
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            I Understand that / मैं समझता हूँ कि:
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="read_and_understand_yes"
                                                                    name="read_and_understand" value="1"
                                                                    wire:model="read_and_understand">
                                                                <label class="form-check-label"
                                                                    for="read_and_understand_yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    id="read_and_understand_no"
                                                                    name="read_and_understand" value="0"
                                                                    wire:model="read_and_understand">
                                                                <label class="form-check-label"
                                                                    for="read_and_understand_no">No</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <ol type="a">
                                                                <li>
                                                                    Blood donation is a totally voluntary act and no
                                                                    inducement or remuneration has been offered.
                                                                    <br>
                                                                    रक्तदान पूरी तरह से स्वैच्छिक क्रिया है और इसके लिए
                                                                    कोई प्रोत्साहन या पारिश्रमिक प्रदान नहीं किया गया
                                                                    है।
                                                                </li>

                                                                <li>
                                                                    Donation of blood/components is a medical procedure
                                                                    and that by donating voluntarily, I accept the risk
                                                                    associated with this procedure.
                                                                    <br>
                                                                    रक्त/घटक का दान एक चिकित्सीय प्रक्रिया है, और
                                                                    स्वैच्छिक रूप से दान करके, मैं इस प्रक्रिया से जुड़े
                                                                    जोखिम को स्वीकार करता/करती हूँ।
                                                                </li>

                                                                <li>
                                                                    My blood will be tested for Hepatitis B, Hepatitis
                                                                    C, malaria parasite, HIV/AIDS, and venereal disease
                                                                    in addition to any other screening tests required to
                                                                    ensure blood safety.
                                                                    <br>
                                                                    मेरे रक्त का परीक्षण हेपेटाइटिस बी, हेपेटाइटिस सी,
                                                                    मलेरिया परजीवी, HIV/AIDS, और यौन संचारित रोगों के
                                                                    लिए किया जाएगा, साथ ही रक्त सुरक्षा सुनिश्चित करने
                                                                    के लिए आवश्यक अन्य सभी जांच भी की जाएंगी।

                                                                    <br>
                                                                    I prohibit any information provided by me or about
                                                                    my donation to be disclosed to any individual or
                                                                    government agency without my prior permission.
                                                                    <br>
                                                                    मैं अपने द्वारा दी गई जानकारी या मेरे दान से संबंधित
                                                                    किसी भी जानकारी को मेरी पूर्व अनुमति के बिना किसी भी
                                                                    व्यक्ति या सरकारी संस्था को प्रकट करने से मना
                                                                    करता/करती हूँ।
                                                                </li>
                                                            </ol>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            General Physical Examination / सामान्य शारीरिक परीक्षण:
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="weight">Weight</label>
                                                                    <input type="text" class="form-control"
                                                                        id="weight" wire:model="weight">
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="pulse">Pulse</label>
                                                                    <input type="text" class="form-control"
                                                                        id="pulse" wire:model="pulse">
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="hb">Hb/Hemoglobin</label>
                                                                    <input type="text" class="form-control"
                                                                        id="hb" wire:model="hb">
                                                                </div>

                                                                <div class="form-group col">
                                                                    <label for="bp-input">B.P./Blood Pressure</label>
                                                                    <input type="text" class="form-control"
                                                                        id="bp-input" wire:model="bp">
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="temperature">Temperature</label>
                                                                    <input type="text" class="form-control"
                                                                        id="temperature"wire:model="temperature">
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-2">
                                                                    <div class="mt-4">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio" id="accept"
                                                                                name="accept_terms" value="1"
                                                                                wire:model="accept_terms">
                                                                            <label class="form-check-label"
                                                                                for="accept">Accept</label>
                                                                        </div>

                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio" id="defer"
                                                                                name="accept_tearm" value="0"
                                                                                wire:model="accept_terms">
                                                                            <label class="form-check-label"
                                                                                for="defer">Defer</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-10">
                                                                    <label for="reason">Reason (if deferred)</label>
                                                                    <input type="text" class="form-control"
                                                                        id="reason" wire:model="reason">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
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

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });

            $(document).on("change", "select[name='donor_id']", function() {
                @this.call("donorChanged");
            });

            document.addEventListener("DOMContentLoaded", function() {
                Inputmask("999/999").mask("#bp-input");
            });
        </script>
    @endpush
</div>
