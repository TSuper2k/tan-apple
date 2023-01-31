@extends('layouts.client')

@section('title')
    <title>Giỏ hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('clients/home/home.js') }}"></script>
@endsection

@section('content')

    @php $total = 0 @endphp
    @if (session('cart'))
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
                                <td class="image">Ảnh</td>
                                <td class="description">Tên</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng giá</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="cart_product">
                                        <img style="height: 100px" src="{{ $details['image'] }}" alt="">
                                    </td>
                                    <td class="cart_description">
                                        <p>{{ $details['name'] }}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ number_format($details['price']) }} VNĐ</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <input class="form-control quantity update-cart" type="number"
                                                value="{{ $details['quantity'] }}" />
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{ number_format($details['price'] * $details['quantity']) }} VNĐ</p>
                                    </td>
                                    <td class="cart_delete">
                                        <button class="btn btn-danger btn-sm remove-from-cart"><i
                                                class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
        <!--/#cart_items-->

        <section id="do_action">
            <div class="container">

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng giá trị giỏ hàng <span>{{ number_format($total) }} VNĐ</span></li>
                            </ul>

                            <?php
                                    $customer_id = session()->get('id');
                                    if ($customer_id != null) {
                                ?>
                            <a class="btn btn-default update" href="{{ route('checkout') }}">Thanh toán</a>
                            <?php
                                    } else {
                                        ?>
                            <a class="btn btn-default update" href="{{ route('login-checkout') }}">Thanh toán</a>
                            <?php
                                    }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#do_action-->
    @else
        <h4 style="height: 200px">
            <center>Giỏ hàng trống, hãy quay lại mua thêm sản phẩm nào :)</center>
        </h4>
        <div class="container" style="width: 80%">
            <!--recommended_items-->
            @include('client.home.components.recommend_product')
            <!--/recommended_items-->
        </div>
    @endif


@endsection

@section('scripts')
    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
