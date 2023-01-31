@extends('layouts.admin')

@section('title')
    <title>Trang quản lý setting</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/setting/index/index.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.components.content-header', ['name' => 'Setting', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            @can('setting-add')
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    Add setting
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('settings.create') . '?type=Text' }}">Text</a></li>
                                    <li><a href="{{ route('settings.create') . '?type=Textarea' }}">Textarea</a></li>
                                </ul>
                            @endcan
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Config key</th>
                                    <th scope="col">Config value</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settings as $setting)
                                    <tr>
                                        <th scope="row">{{ $setting->id }}</th>
                                        <td>{{ $setting->config_key }}</td>
                                        <td>{{ $setting->config_value }}</td>
                                        <td>
                                            @can('setting-edit')
                                                <a href="{{ route('settings.edit', ['id' => $setting->id]) . '?type=' . $setting->type }}"
                                                    class="btn btn-primary">Edit</a>
                                            @endcan

                                            @can('setting-delete')
                                                <a href=""
                                                    data-url="{{ route('settings.delete', ['id' => $setting->id]) }}"
                                                    class="btn btn-danger action_delete">Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $settings->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
