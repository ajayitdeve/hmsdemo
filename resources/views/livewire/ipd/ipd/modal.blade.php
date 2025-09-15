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

<!-- Bed Chart Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="bedChart" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bed</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($roomBeds as $bed)
                        @if ($bed->bed_status == 'used')
                            <div class="card col-md-2 bg-danger  rounded"
                                style="backgroud-color:white; background-image: url('{{ asset('assets/img/bed_patient.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
                                <div class="card-body">
                                    <p style="font-size:14px;text-align:center;">{{ $bed->code }}</p>


                                    <h4 style="text-align:center;"> {{ $bed->ipds->first()->patient->name }}</h4>
                                    <p style="text-align:center;">{{ $bed->ipds->first()->ipdcode }} <br />
                                        {{ $bed->ipds->first()->patient->gender->name }}/
                                        {{ date_diff(date_create($bed->ipds->first()->patient->dob), date_create('today'))->y }}
                                        Yrs.
                                    <p>
                                    <p style="text-align:center;">
                                        {{ \Carbon\Carbon::parse($bed->ipds->first()->created_at)->format('M d Y') }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="card col-md-2 bg-success rounded cursor-pointer"
                                wire:click="selectBed({{ $bed->id }})"
                                style="backgroud-color:white; background-image: url('{{ asset('assets/img/hospital-bed.png') }}'); background-size: 100% 100%; background-repeat: no-repeat; min-height:208px;">
                                <div class="card-body">
                                    <p style="font-size:12px;">{{ $bed->code }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->
