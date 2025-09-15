@extends('layouts.admin')
@section('content')
    <div class="content container-fluid">
        @include('partials.alert-message')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card p-2">
                    <div class="">
                        <h3>
                            User Role
                        </h3>
                        <a href="{{ route('admin.users.index') }}" class="text-primary text-bold float-right mr-4">User
                            Index</a>
                    </div>
                    <div class="body">
                        <p class="text-bold">User Name: {{ $user->name }}</p>
                        <p>User Email: {{ $user->email }}</p>
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
                        @if ($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form class="d-inline" method="POST"
                                    action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-success d-inline" type="submit">{{ $user_role->name }} <i
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

                        <form method="POST" class="form-inline" action="{{ route('admin.users.roles', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="role" class="form-label mr-4">Roles</label>
                                <select id="role" name="role" autocomplete="role-name" class="form-control"
                                    autofocus>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-4 d-inline">Assign</button>
                            </div>
                            @error('role')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--row 4 -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card p-2">
                <div class="">
                    <h3>
                        Permissions
                    </h3>
                </div>
                <div class="body">
                    @if ($user->permissions)
                        @foreach ($user->permissions as $user_permission)
                            <form class="" method="POST"
                                action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn  btn-primary">{{ $user_permission->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- row 5 -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card p-2">
                <div class="">
                    <h3>

                    </h3>
                </div>
                <div class="body">
                    <form method="POST" class="form-inline" action="{{ route('admin.users.permissions', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="permission" class="form-label">Permission</label>
                            <select id="permission" name="permission" autocomplete="permission-name" class="form-control">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary d-inline">Assign</button>
                        </div>
                        @error('name')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                </div>



                </form>

            </div>
        </div>
    </div>
    </div>

    </div>
@endsection
