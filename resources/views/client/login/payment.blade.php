{{-- @extends('layouts.client')

@section('title')
    <title>Home page</title>
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
            <!--/breadcrums-->

            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
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
                        @php $total = 0 @endphp
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="cart_product">
                                        <a href=""><img style="height: 100px" src="{{ $details['image'] }}"
                                                alt=""></a>
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
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="payment-options">
                <h4>Chọn hình thức thanh toán</h4>
                <form action="{{ route('order') }}" method="POST">
                  @csrf
                    <span>
                        <label><input name="payment_option" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="2" type="checkbox"> Thanh toán bằng tiền
                            mặt</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="3" type="checkbox"> Thanh toán bằng thẻ ghi
                            nợ</label>
                    </span>
                    <input class="btn btn-primary btn-sm" type="submit" name="send_order_place" value="Đặt hàng">
                </form>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
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
@endsection --}}
