<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Test Format Setup</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Test Format Setup</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Format Setup</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 10, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Code </th>
                                <th>Format Desc.</th>
                                <th>Parameters</th>
                                <th>Test Main Group</th>
                                <th>Test</th>
                                <th>Report Title</th>
                                <th>Min Time</th>
                                <th>Max Time</th>
                                <th>Is Active</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formats as $index => $format)
                                <tr>
                                    <td><a href="{{ route('admin.format-setup.edit', $format->id) }}">{{ $index + 1 }}
                                            <span class="fa fa-edit"></span></a></td>
                                    <td>{{ $format->code }}</td>
                                    <td>{{ $format->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($format?->formatParameters as $parameter)
                                                <li> {{ $parameter?->parameter?->code }}
                                                    {{ $parameter?->parameter?->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $format?->serviceGroup?->name }}</td>
                                    <td>{{ $format?->service?->name }}({{ $format?->service?->code }})</td>
                                    <td>{{ $format->report_title }}</td>
                                    <td>{{ $format->min_time }}:{{ $format->time_ins_min }}</td>
                                    <td>{{ $format->max_time }}:{{ $format->time_ins_max }}</td>

                                    <td>
                                        @if ($format->is_active)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ $format->created_at }}</td>

                                    <td class="text-right">
                                        <a href="{{ route('admin.format-setup.edit', $format->id) }}"> <span
                                                class="fa fa-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $parameters->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.pathology.format.modal')

    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add").modal('hide');
                $("#edit").modal('hide');
                $("#delete").modal('hide');
            });
        </script>
    @endpush

</div>
