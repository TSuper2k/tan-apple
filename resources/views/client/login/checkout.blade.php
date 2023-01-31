@extends('layouts.client')

@section('title')
    <title>Thanh toán</title>
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
                <!--/breadcrums-->

                <div class="review-payment">
                    <h2>Xem lại giỏ hàng</h2>
                </div>
                @if (\Session::has('error'))
                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">{{ \Session::get('success') }}</div>
                    {{ \Session::forget('success') }}
                @endif
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
                                                @if (session()->get('success_paypal')) readonly @endif
                                                value="{{ $details['quantity'] }}" />
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{ number_format($details['price'] * $details['quantity']) }} VNĐ</p>
                                    </td>

                                    <td class="cart_delete">
                                        @if (!session()->get('success_paypal'))
                                            <button class="btn btn-danger btn-sm remove-from-cart"><i
                                                    class="fa fa-trash-o"></i></button>
                                        @endif
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
                        <div class="payment-options">
                            <h4>Chọn hình thức thanh toán</h4>
                            <form action="{{ route('order') }}" method="POST">
                                @csrf
                                @if (!session()->get('success_paypal'))
                                    <span>
                                        <label><input name="payment_option" value="1" type="radio"> Thanh toán bằng
                                            thẻ
                                            ATM</label>
                                    </span>
                                    <span>
                                        <label><input name="payment_option" value="2" type="radio" checked> Thanh
                                            toán
                                            bằng tiền
                                            mặt</label>
                                    </span>
                                @else
                                    <label><input name="payment_option" value="4" type="radio" checked> Đã thanh toán bằng
                                        Paypal</label>
                                @endif
                                <span>
                                    @php
                                        $vnd_to_usd = $total / 23625;
                                        $total_paypal = round($vnd_to_usd);
                                        session()->put('total_paypal', $total_paypal);
                                    @endphp
                                    {{-- <div id="paypal-button"></div> --}}
                                    @if (!session()->get('success_paypal'))
                                        <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Thanh toán
                                            bằng
                                            Paypal</a>
                                        <input type="hidden" id="vnd_to_usd" name=""
                                            value="{{ round($vnd_to_usd, 2) }}">
                                    @endif
                                </span>
                                <div>
                                <input class="btn btn-primary btn-sm" type="submit" name="send_order_place"
                                    value="Đặt hàng">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng giá trị giỏ hàng <span>{{ number_format($total) }} VNĐ</span></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#do_action-->
    @else
        <h4 style="height: 200px">
            <center>Thêm vào giỏ hàng trước mới thanh toán được nhé :)</center>
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
    {{-- <script>
        var usd = document.getElementById("vnd_to_usd").value;
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AUd5KBSP8uRIY_hRjkufj4S6QyQ2BJB_1B2irSyr4FAEFYlCSNvMDm35hyem6-8gvzo2jWXdhH67TeIG',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: `${usd}`,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    window.alert('Cảm ơn bạn đã mua hàng của chúng tôi!');
                });
            }
        }, '#paypal-button');
    </script> --}}
@endsection
