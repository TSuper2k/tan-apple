<header id="header">
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i>
                                    {{ getConfigValueFromSettingTable('phone') }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>
                                    {{ getConfigValueFromSettingTable('mail') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ getConfigValueFromSettingTable('facebook') }}"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ getConfigValueFromSettingTable('twitter') }}"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ getConfigValueFromSettingTable('instagram') }}"><i
                                        class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <!--/header-middle-->
    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('home') }}"><img src="{{ asset('eshopper/images/home/logo.png') }}"
                                alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8" style="padding: 30px 0 0 15px">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            {{-- Tình trạng đơn hàng --}}
                            <?php
                                $customer_id = session()->get('id');
                                if ($customer_id != null 
                                ) {
                            ?>
                            <li><a href="{{ route('order-status') }}"><i class="fa fa-star"></i> Đơn hàng</a></li>

                            <?php
                                }elseif($customer_id != null 
                                ){
                            ?>
                            <li><a href="{{ route('payment') }}"><i class="fa fa-star"></i> Đơn hàng</a></li>

                            <?php
                                } else {
                                    ?>
                            <li><a href="{{ route('login-checkout') }}"><i class="fa fa-star"></i> Đơn hàng</a>
                            </li>
                            <?php
                                }
                            ?>

                            {{-- Thanh toán --}}
                            <?php
                                $customer_id = session()->get('id');
                                // $shipping_id = session()->get('id');
                                if ($customer_id != null 
                                // && $shipping_id == null
                                ) {
                            ?>
                            <li><a href="{{ route('checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                            <?php
                                }elseif($customer_id != null 
                                // && $shipping_id != null
                                ){
                            ?>
                            <li><a href="{{ route('payment') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                            <?php
                                } else {
                                    ?>
                            <li><a href="{{ route('login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                            </li>
                            <?php
                                }
                            ?>


                            {{-- Giỏ hàng --}}
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-info"
                                        style="margin-top: 10px; padding: 0; color: #696763; background-color: white; border-color: white"
                                        data-toggle="dropdown">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng <span
                                            class="badge badge-pill badge-danger"
                                            style="color: rgb(166, 216, 27); background-color: #696763; border-color: white">{{ count((array) session('cart')) }}</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="row total-header-section"
                                            style="padding: 10px 0; border-bottom: 1px solid #3d3b3b;">
                                            <div class="col-lg-6 col-sm-6 col-6">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                                    class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                            </div>
                                            @php $total = 0 @endphp
                                            @foreach ((array) session('cart') as $id => $details)
                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                            @endforeach
                                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                                <p style="margin: 0">Tổng tiền: <span
                                                        class="text-info">{{ number_format($total) }} VNĐ</span></p>
                                            </div>
                                        </div>
                                        @if (session('cart'))
                                            @foreach (session('cart') as $id => $details)
                                                <div class="row cart-detail" style="padding: 10px 0;">
                                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                        <img src="{{ $details['image'] }}" />
                                                    </div>
                                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                        <p>{{ $details['name'] }}</p>
                                                        <span class="price text-info">
                                                            {{ number_format($details['price']) }} VNĐ</span>
                                                        <span class="count">
                                                            Số lượng: {{ $details['quantity'] }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="row" style="padding: 20px 0 0 0">
                                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                <a href="{{ route('cart') }}" class="btn btn-primary btn-block"
                                                    style="padding-top: 14px"><span class="price text-info">Đi đến giỏ
                                                        hàng</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- Đăng nhập/Đăng xuất --}}
                            <?php
                                $customer_id = session()->get('id');
                                if ($customer_id != null) {
                            ?>
                            <li><a href="{{ route('logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                            <?php
                                } else {
                                    ?>
                            <li><a href="{{ route('login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            <?php
                                }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <!--header-bottom-->
    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!--main menu-->
                    @include('client.components.main_menu')
                    <!--main menu-->

                </div>
                <div class="col-sm-4">
                    <div class="search_box pull-right">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm" />
                            <input type="submit" class="btn btn-success btn-sm" name="search_items" value="Tìm kiếm">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
<!--/header-->
