@extends('layouts.admin')

@section('title')
    <title>Trang thêm vai trò</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}">
@endsection

@section('js')
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.components.content-header', ['name' => 'Role', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data" style="width: 100%">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nhập tên vai trò" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <textarea class="form-control @error('display_name') is-invalid @enderror" name="display_name" rows="4">
                                {{ old('display_name') }}
                                </textarea>
                                @error('display_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="checkall" class="checkall">
                                    <label for="checkall">&nbsp;Check all</label>
                                </div>
                                @foreach ($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12" style="padding: 0">
                                        <div class="card-header">
                                            <label for="">
                                                <input type="checkbox" class="checkbox_wrapper" value="">
                                            </label>
                                            &nbsp;Module {{ $permissionsParentItem->name }}
                                        </div>
                                        <div class="row">
                                            @foreach ($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label for="">
                                                            <input type="checkbox" class="checkbox_childrent" name="permission_id[]"
                                                                value="{{ $permissionsChildrentItem->id }}">
                                                        </label>
                                                        &nbsp;{{ $permissionsChildrentItem->name }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
