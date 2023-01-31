@extends('layouts.client')

@section('title')
    <title>Kết quả tìm kiếm</title>
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
                    <div class="product-details">
                        <h2 class="title text-center">Kết quả tìm kiếm</h2>
                        @foreach ($searchProduct as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{ route('detail.product', ['slug' => $product->slug, 'id' => $product->id]) }}"><img style="width: 100%; height: 170px"
                                                    src="{{ $product->feature_image_path }}" alt="" /></a>
                                            <h2>{{ number_format($product->price) }}VNĐ</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="{{ route('add.to.cart', $product->id) }}"
                                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                                vào giỏ hàng</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <a href="{{ route('detail.product', ['slug' => $product->slug, 'id' => $product->id]) }}"><img style="width: 100%; height: 170px"
                                                        style="width: 100%" src="{{ $product->feature_image_path }}"
                                                        alt="" /></a>
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
                    </div>
                    <!--/product-details-->

                    <!--recommended_items-->
                    @include('client.home.components.recommend_product')
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection
