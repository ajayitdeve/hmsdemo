<!-- IPD Details Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="ipdDetails" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IPD Admission Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-center mb-0">
                        <tbody>
                            <tr>
                                <th>UMR No.</th>
                                <td>{{ $ipd_details->patient->registration_no }}</td>

                                <th>Name</th>
                                <td>{{ $ipd_details->patient->name }}</td>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <td>{{ $ipd_details->ipdcode }}</td>

                                <th>Reason</th>
                                <td>{{ $ipd_details->reason }}</td>
                            </tr>
                            <tr>
                                <th>Company</th>
                                <td>{{ $ipd_details->company }}</td>

                                <th>Payment By</th>
                                <td>{{ $ipd_details->payment_by }}</td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td>{{ $ipd_details->payment }}</td>

                                <th>Policy No.</th>
                                <td>{{ $ipd_details->policy_no }}</td>
                            </tr>
                            <tr>
                                <th>Admit Type</th>
                                <td>{{ $ipd_details->admit_type }}</td>

                                <th>Patient Source</th>
                                <td>{{ $ipd_details->patient_source }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
