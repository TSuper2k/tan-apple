@extends('layouts.admin')

@section('title')
    <title>Trang quản lý chi tiết đơn hàng</title>
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
        @include('admin.components.content-header', ['name' => 'Order', 'key' => 'View'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Thông tin khách hàng</h4>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Hình thức thanh toán</th>
                                    <th scope="col">Địa chỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($orderById as $content) --}}
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{ $customers[0]->name }}</td>
                                    <td>{{ $orderById[0]->phone }}</td>

                                    <?php 
                                        if($orderById[0]->payment_method == 1){ ?>
                                    <td>Thẻ ATM</td>
                                    <?php }elseif($orderById[0]->payment_method == 2){ ?>
                                    <td>Tiền mặt</td>
                                    <?php }else{ ?>
                                    <td>Đã thanh toán bằng Paypal</td>
                                    <?php } ?>

                                    <td>{{ $orderById[0]->address }}</td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <h4>Chi tiết đơn hàng</h4>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Số lượng tồn</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền/sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderById as $content)
                                    <tr class="color_qty_{{ $content->product_id }}">
                                        <th scope="row"></th>
                                        <td>{{ $content->product_name }}</td>
                                        <td>{{ $content->quantity }}</td>
                                        <td>{{ number_format($content->product_price) }}</td>
                                        <td>
                                            <input type="number" min="1"
                                                {{ $content->order_status == 2 ? 'disabled' : '' }}
                                                class="order_qty_{{ $content->product_id }}" name="product_quantity"
                                                value="{{ $content->product_quantity }}">
                                            <input type="hidden" class="order_id" name="order_id"
                                                value="{{ $content->order_id }}">
                                            <input type="hidden" class="order_qty_storage_{{ $content->product_id }}"
                                                name="order_qty_storage" value="{{ $content->product->quantity }}">
                                            <input type="hidden" class="order_product_id" name="order_product_id"
                                                value="{{ $content->product_id }}">
                                            @if ($content->order_status != 2)
                                                <button class="btn btn-default update_quantity_order"
                                                    data-product_id="{{ $content->product_id }}"
                                                    name="update_quantity_order">Cập nhật</button>
                                            @endif
                                        </td>
                                        <td>{{ number_format($content->product_price * $content->product_quantity) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row"></th>
                                    <th scope="row">Thời gian tạo đơn: {{ $content->created_at }}</th>
                                    <th scope="row"></th>
                                    <th scope="row"></th>
                                    <th scope="row"></th>
                                    <th scope="col">Tổng giá trị đơn hàng:
                                        {{ number_format($orderById[0]->order_total) }}</th>
                                </tr>
                                <tr>
                                    <td>
                                        @foreach ($orders as $order)
                                            @if ($order->order_status == 1)
                                                <form action="">
                                                    @csrf
                                                    <select class="form-control order_details">
                                                        <option value="" >Chọn tình trạng đơn hàng</option>
                                                        <option id="{{ $order->id }}" value="1" selected>Chưa xử lí
                                                        </option>
                                                        <option id="{{ $order->id }}" value="2">Đang giao hàng
                                                        </option>
                                                        <option id="{{ $order->id }}" value="3">Giao hàng thành công
                                                        </option>
                                                        <option id="{{ $order->id }}" value="4">Hủy đơn</option>
                                                    </select>
                                                </form>
                                            @elseif($order->order_status == 2)
                                                <form action="">
                                                    @csrf
                                                    <select class="form-control order_details">
                                                        <option value="">Chọn tình trạng đơn hàng</option>
                                                        <option id="{{ $order->id }}" value="1">Chưa xử lí</option>
                                                        <option id="{{ $order->id }}" value="2" selected>Đang giao
                                                            hàng</option>
                                                        <option id="{{ $order->id }}" value="3">Giao hàng thành công
                                                        </option> 
                                                        <option id="{{ $order->id }}" value="4">Hủy đơn</option>
                                                    </select>
                                                </form>
                                            @elseif($order->order_status == 3)
                                            <form action="">
                                                @csrf
                                                <select class="form-control order_details">
                                                    {{-- <option value="">Chọn tình trạng đơn hàng</option>
                                                    <option id="{{ $order->id }}" value="1">Chưa xử lí</option>
                                                    <option id="{{ $order->id }}" value="2">Đã giao hàng
                                                    </option> --}}
                                                    <option id="{{ $order->id }}" value="3" selected>Giao hàng thành công
                                                    </option>
                                                </select>
                                            </form>
                                            @else
                                                <form action="">
                                                    @csrf
                                                    <select class="form-control order_details">
                                                        {{-- <option value="">Chọn tình trạng đơn hàng</option>
                                                        <option id="{{ $order->id }}" value="1">Chưa xử lí</option>
                                                        <option id="{{ $order->id }}" value="2">Đã giao hàng
                                                        </option> --}}
                                                        <option id="{{ $order->id }}" value="4" selected>Đã hủy đơn
                                                        </option>
                                                    </select>
                                                </form>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
