@extends('layouts.admin')
@section('content')
    <div class="content container-fluid">
        @include('partials.alert-message')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>
                            Edit Permission
                        </h3>
                        <a href="{{ route('admin.permissions.index') }}"
                            class="text-primary text-bold float-right mr-4">Permission Index</a>
                    </div>
                    <div class="body">
                        <form class="form-inline" method="POST"
                            action="{{ route('admin.permissions.update', $permission) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group p-2">
                                <label class="form-label mr-4">Name</label>
                                <input type="text" class="mr-4 form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $permission->name }}" autofocus>
                                @error('name')
                                    <label id="name-error" class="error " for="email">{{ $message }}</label>
                                @enderror
                            </div>

                            <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- row -2---->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>
                            Roles
                        </h3>
                    </div>
                    <div class="body">
                        @if ($permission->roles)
                            @foreach ($permission->roles as $permission_role)
                                <form class="d-inline" method="POST"
                                    action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-primary" type="submit">{{ $permission_role->name }} <i
                                            class="fa fa-close"></i></button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--row 3 -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>

                        </h3>
                    </div>
                    <div class="body">

                        <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="role" class="form-label">Roles</label>
                                <select id="role" name="role" autocomplete="role-name" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                                <span class="btn btn-primary btn-sm">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
