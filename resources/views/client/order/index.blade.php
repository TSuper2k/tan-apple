@extends('layouts.client')

@section('title')
    <title>Đơn hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('clients/home/home.js') }}"></script>
@endsection

@section('content')

    {{-- @if () --}}
        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">

                    </ol>
                </div>

                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
								<td class="description">#Thời gian tạo đơn</td>
                                <td class="description">Tên người nhận hàng</td>
                                <td class="price">Tổng giá trị đơn hàng</td>
                                <td class="quantity">Tình trạng</td>
                                <td class="total">Thao tác</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($allOrder as $order)
                                @if(session()->get('id') == $order->customer_id)
                                    <tr style="height: 75px">
										<td>{{ $order->created_at }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ number_format($order->order_total) }} VNĐ</td>

                                        @if($order->order_status == 1)
                                            <td>Chưa xử lí</td>
                                        @endif

                                        @if($order->order_status == 2)
                                            <td>Đang giao hàng</td>
                                        @endif

                                        @if($order->order_status == 3)
                                            <td>Bị hủy</td>
                                        @endif

                                        <td>
                                            <a href="{{ route('order-status-detail', ['id' => $order->id]) }}"
                                                    class="btn btn-default">Xem chi tiết</a>
                                                
                                            
                                            {{-- <a href=""
                                                data-url="{{ route('orders.delete', ['id' => $order->id]) }}"
                                                class="btn btn-danger action_delete">Delete</a>  --}}

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!--/#cart_items-->
    {{-- @else
        <h4 style="height: 200px">
            <center>Bạn chưa có đơn hàng nào</center>
        </h4>
        <div class="container" style="width: 80%">
            <!--recommended_items-->
            @include('client.home.components.recommend_product')
            <!--/recommended_items-->
        </div>
    @endif --}}


@endsection
