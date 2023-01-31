@extends('layouts.client')

@section('title')
    <title>Sản phẩm theo danh mục</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('clients/home/home.js') }}"></script>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('client.components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="amount">Sắp xếp theo</label>
                            <form action="">
                                @csrf
                                <select name="sort" id="sort" class="form-control">
                                    <option value="{{ Request::url() }}?sort_by=none">--Lọc--</option>
                                    <option value="{{ Request::url() }}?sort_by=tang_dan">--Giá tăng dần--</option>
                                    <option value="{{ Request::url() }}?sort_by=giam_dan">--Giá giảm dần--</option>
                                    <option value="{{ Request::url() }}?sort_by=kytu_az">Lọc theo tên từ A đến Z</option>
                                    <option value="{{ Request::url() }}?sort_by=kytu_za">Lọc theo tên từ Z đến A</option>
                                </select>
                            </form>
                        </div>
                        {{-- <div class="col-md-4">
                            <label for="amount">Lọc theo giá</label>
                            <form action="">
                                @csrf
                                <div id="slider-range"></div>
                                <div style="float: left">
                                    <input type="text" id="amount_start" readonly
                                        style="border:0; color:#13bc2c; font-weight:bold;">
                                </div>
                                <div style="float: right">
                                    <input type="text" id="amount_end" readonly
                                        style="border:0; color:#13bc2c; font-weight:bold;">
                                </div>
                                    <input type="hidden" name="start_price" id="start_price">
                                    <input type="hidden" name="end_price" id="end_price">
                                </div>
                                <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-default">
                            </form>
                        </div> --}}
                    </div>
                    <div class="features_items">
                        <!--features_items-->
                        <h2 class="title text-center">Sản phẩm nổi bật</h2>
                        @foreach ($category_by_id as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a
                                                href="{{ route('detail.product', ['slug' => $product->slug, 'id' => $product->id]) }}"><img
                                                    style="width: 100%; height: 170px"
                                                    src="{{ $product->feature_image_path }}" alt="" /></a>
                                            <h2>{{ number_format($product->price) }}VNĐ</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="{{ route('add.to.cart', $product->id) }}"
                                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                                vào giỏ hàng</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <a
                                                    href="{{ route('detail.product', ['slug' => $product->slug, 'id' => $product->id]) }}"><img
                                                        style="width: 100%; height: 170px"
                                                        src="{{ $product->feature_image_path }}" alt="" /></a>
                                                <h2>{{ number_format($product->price) }}VNĐ</h2>
                                                <p>{{ $product->name }}</p>
                                                <a href="{{ route('add.to.cart', $product->id) }}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $category_by_id->links() }}

                    </div>
                    <!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection

