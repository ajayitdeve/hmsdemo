<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Employee</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.employee.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Employee
                    </a>
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>Relation Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        <a
                                            href="{{ route('admin.employee.edit', $employee->id) }}">{{ $employee?->employee_code }}</a>
                                    </td>
                                    <td>
                                        {{ $employee?->title?->name }} {{ $employee?->employee_name }}
                                    </td>
                                    <td>{{ $employee?->relation?->name }}</td>
                                    <td>{{ $employee?->father_name }}</td>
                                    <td>{{ $employee?->mobile }}</td>
                                    <td>{{ $employee?->email }}</td>
                                    <td>{{ $employee?->department?->name }}</td>
                                    <td>{{ $employee?->designation?->name }}</td>
                                    <td>{{ $employee?->created_by?->name }}</td>
                                    <td>{{ $employee?->updated_by?->name }}</td>
                                    <td>{{ $employee->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @push('page-script')
        <script></script>
    @endpush

</div>
