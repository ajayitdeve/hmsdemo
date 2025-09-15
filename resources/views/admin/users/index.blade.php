@extends('layouts.admin')

@section('content')
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All User</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All User</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.users.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add User
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 6, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>User ID</th>
                                <th>Department</th>
                                <th>User Profile</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user?->department?->name }}</td>
                                    <td>{{ $user?->team?->name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>

                                        {{-- <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="btn btn-primary btn-sm">Roles</a> --}}

                                        <a href="{{ route('admin.users.sync_team_role', $user->id) }}"
                                            class="btn btn-success btn-sm">Sync Team Roles</a>

                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.users.destroy', $user->id) }}"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script></script>
    @endpush
@endsection
