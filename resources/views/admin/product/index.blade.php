@extends('layouts.admin')

@section('title')
    <title>Trang sản phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.components.content-header', ['name' => 'Product', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('product-add')
                            <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Số lượng tồn</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $productItem)
                                    <tr>
                                        <th scope="row">{{ $productItem->id }}</th>
                                        <td>{{ $productItem->name }}</td>
                                        <td>{{ $productItem->quantity }}</td>
                                        <td>{{ number_format($productItem->price) }}</td>
                                        <td>
                                            <img class="product_image_150_100" src="{{ $productItem->feature_image_path }}"
                                                alt="">
                                        </td>
                                        <td>{{ optional($productItem->category)->name }}</td>
                                        <td>
                                            @can('product-edit')
                                                <a href="{{ route('product.edit', ['id' => $productItem->id]) }}"
                                                    class="btn btn-primary">Edit</a>
                                            @endcan

                                            @can('product-delete')
                                                <a href=""
                                                    data-url="{{ route('product.delete', ['id' => $productItem->id]) }}"
                                                    class="btn btn-danger action_delete">Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
