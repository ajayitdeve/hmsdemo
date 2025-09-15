@extends('layouts.admin')
@section('content')
    <style>
        .permission-cell {
            white-space: normal;
            word-break: break-word;
        }
    </style>
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        {{-- <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome Admin!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div> --}}
        <!-- /Page Header -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>Roles</h3>
                        <a href="{{ route('admin.roles.create') }}" class="text-primary text-bold float-right mr-4">Add
                            New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dt-mant-table">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">Id</th>
                                        <th style="width: 150px;">Name</th>
                                        <th style="width: 300px;">Permissions</th>
                                        <th style="width: 100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td class="permission-cell">
                                                @foreach ($row->permissions()->pluck('name') as $permission)
                                                    <span
                                                        class="badge badge-warning">{{ ucfirst(str_replace('_', ' ', $permission)) }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div style="display:flex;">
                                                    <a href="{{ route('admin.roles.edit', $row->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    &nbsp;
                                                    <form id="delete_form{{ $row->id }}" method="POST"
                                                        action="{{ route('admin.roles.destroy', $row->id) }}"
                                                        onclick="return confirm('Are you sure?')">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
