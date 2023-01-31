@extends('layouts.client')

@section('title')
    <title>Chi tiết đơn hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('clients/home/home.js') }}"></script>
@endsection

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">

                </ol>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <h4>#Thông tin khách hàng</h4>
                    <thead>
                        <tr class="cart_menu">
                            <td class="description">#</td>
                            <td class="description">Tên người nhận hàng</td>
                            <td class="price">Số điện thoại</td>
                            <td class="quantity">Hình thức thanh toán</td>
                            <td class="total">Địa chỉ</td>
                            <td class="total">Thời gian tạo đơn</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 75px">
                            <th scope="row"></th>
                            <td>{{ $nameCustomer[0]->name }}</td>
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
                            <td>{{ $orderById[0]->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <h4>#Chi tiết đơn hàng</h4>
                    <thead>
                        <tr class="cart_menu">
                            <td class="description">#</td>
                            <td class="description">Tên sản phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền/Sản phẩm</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderById as $content)
                            <tr style="height: 75px">
                                <td><img style="width: 100%" src="{{ $content->feature_image_path }}" alt=""></td>
                                <td>{{ $content->product_name }}</td>
                                <td>{{ number_format($content->product_price) }} VNĐ</td>
                                <td>{{ $content->product_quantity }}</td>
                                <td>{{ number_format($content->product_price * $content->product_quantity) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="do_action">
        <div class="container">

            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng giá trị đơn hàng: <span>{{ number_format($orderById[0]->order_total) }} VNĐ</span></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
@endsection
