@extends('layouts.admin')

@section('title')
    <title>Trang quản lý đơn hàng</title>
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
        @include('admin.components.content-header', ['name' => 'Order', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{-- @can('product-add')
                            <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add</a>
                        @endcan --}}
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Tổng giá tiền</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Thời gian tạo đơn</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allOrder as $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ number_format($order->order_total) }}</td>

                                        @if($order->order_status == 1)
                                            <td>Chưa xử lý</td>
                                        @endif

                                        @if($order->order_status == 2)
                                            <td>Đang giao hàng</td>
                                        @endif

                                        @if($order->order_status == 3)
                                            <td>Giao hàng thành công</td>
                                        @endif

                                        @if($order->order_status == 4)
                                            <td>Bị hủy</td>
                                        @endif
                                        
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            @can('order-edit')
                                            <a href="{{ route('orders.view', ['id' => $order->id]) }}"
                                                class="btn btn-default">View</a>
                                            @endcan

                                            {{-- @can('product-edit')
                                                <a href="{{ route('product.edit', ['id' => $productItem->id]) }}"
                                                    class="btn btn-default">Edit</a>
                                            @endcan --}}

                                            @can('order-delete')
                                                <a href=""
                                                    data-url="{{ route('orders.delete', ['id' => $order->id]) }}"
                                                    class="btn btn-danger action_delete">Delete</a>
                                            @endcan 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $allOrder->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
