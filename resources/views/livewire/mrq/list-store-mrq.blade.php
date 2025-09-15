<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ $stockPoint?->name }} MRQ </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $stockPoint?->name }} MRQ</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header ------>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>

                                <th>MRQ Code</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mrqs as $mrq)
                                <tr>
                                    <td><a href="{{ route('admin.mrq.show-mrq', $mrq->id) }}">{{ $mrq->code }}</a>
                                    </td>
                                    <td>{{ $mrq->stockpointfrom->name }}</td>
                                    <td>{{ $mrq->stockpointto->name }}</td>
                                    <td>{{ $mrq->request_date }}</td>
                                    <td>{{ $mrq->status ? 'Appproved' : 'Not Approved' }}</td>
                                    <td>{{ $mrq->remarks }}</td>


                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if (!$mrq->status)
                                                    <button wire:click="edit({{ $mrq->id }})"
                                                        class="dropdown-item" href="#" href="#"
                                                        data-toggle="modal" data-target="#edit"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</button>
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.mrq.add-mrq-items', $mrq->id) }}"><i
                                                        class="fa fa-plus"></i> View</a>
                                                @if ($mrq->status)
                                                    <a target="_blank" class="dropdown-item"
                                                        href="{{ route('admin.mrq.print', $mrq->id) }}"><i
                                                            class="fa fa-print"></i> Print</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $grns->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('livewire.mrq.modal')

    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add").modal('hide');
                $("#edit").modal('hide');
                $("#delete").modal('hide');
            })
        </script>
    @endpush

</div>
