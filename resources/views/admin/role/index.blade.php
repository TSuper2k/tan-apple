@extends('layouts.admin')

@section('title')
    <title>Trang quản lý vai trò</title>
@endsection

@section('css')
    <link rel="stylesheet" href="">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.components.content-header', ['name' => 'Role', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('role-add')
                            <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-2">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên vai trò</th>
                                    <th scope="col">Mô tả vai trò</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ $role->id }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>
                                            @can('role-edit')
                                                <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                                    class="btn btn-primary">Edit</a>
                                            @endcan

                                            @can('role-delete')
                                                <a href="" data-url="{{ route('roles.delete', ['id' => $role->id]) }}"
                                                    class="btn btn-danger action_delete">Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $roles->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
