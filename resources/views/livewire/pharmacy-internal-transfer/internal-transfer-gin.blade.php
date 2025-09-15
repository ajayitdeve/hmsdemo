<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Goods Issue Notes</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Good Issue Notes</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add GIN</a>
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
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>

                                <th>Code</th>
                                <th>Stock Point From</th>
                                <th>Stock Point</th>
                                <th>MRQ Code</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gins as $gin)
                                <tr>

                                    <td>
                                        <a
                                            href="{{ route('admin.pharmacy.pharmacy-internal-transfer-gin-items', $gin->id) }}">
                                            {{ $gin->code }}
                                        </a>
                                    </td>

                                    <td>{{ $gin->stockpointfrom->name }}</td>
                                    <td>{{ $gin->stockpoint->name }}</td>
                                    <td>{{ $gin->mrq->code }}</td>
                                    <td>
                                        {{ $gin->status ? 'Approved' : 'Not Approved' }}
                                    </td>
                                    <td>{{ $gin->remarks }}</td>


                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                {{-- <button wire:click="edit({{$gin->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button> --}}
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.pharmacy.pharmacy-internal-transfer-gin-items', $gin->id) }}"><i
                                                        class="fa fa-plus"></i> View</a>
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
    @include('livewire.gin.modal')

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
