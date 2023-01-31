<div class="features_items">
    <h2 class="title text-center">Sản phẩm nổi bật</h2>
    @foreach ($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    {{-- <form action="">
                        @csrf --}}
                    {{-- <input type="hidden" value="{{ $product->id }}" class="cart_product_id_{{ $product->id }}">
                        <input type="hidden" value="{{ $product->name }}" class="cart_product_name_{{ $product->id }}">
                        <input type="hidden" value="{{ $product->feature_image_path }}" class="cart_product_feature_image_path_{{ $product->id }}">
                        <input type="hidden" value="{{ $product->price }}" class="cart_product_price_{{ $product->id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $product->id }}"> --}}
                    <div class="productinfo text-center">
                        <img style="width: 100%; height: 170px" src="{{ $product->feature_image_path }}" alt="" />
                        <h2>{{ number_format($product->price) }} VNĐ</h2>
                        <p>{{ $product->name }}</p>
                        {{-- <a onclick="AddCart({{ $product->id }})" href="javascript:"
                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                                Add to cart</a> --}}
                        {{-- <button type="button" data-id_product="{{ $product->id }}" class="btn btn-default add-to-cart" name="add-to-cart">Add to cart</button> --}}
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-default add-to-cart"><i
                                class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                    <div class="product-overlay">
                        {{-- <input type="hidden" value="{{ $product->id }}" class="cart_product_id_{{ $product->id }}">
                            <input type="hidden" value="{{ $product->name }}" class="cart_product_name_{{ $product->id }}">
                            <input type="hidden" value="{{ $product->feature_image_path }}" class="cart_product_feature_image_path_{{ $product->id }}">
                            <input type="hidden" value="{{ $product->price }}" class="cart_product_price_{{ $product->id }}">
                            <input type="hidden" value="1" class="cart_product_qty_{{ $product->id }}"> --}}
                        <div class="overlay-content">
                            <a href="{{ route('detail.product', ['slug' => $product->slug,'id' => $product->id]) }}">
                                <img style="width: 100%; height: 170px" src="{{ $product->feature_image_path }}"
                                    alt="" /></a>
                            <h2>{{ number_format($product->price) }}</h2>
                            <p>{{ $product->name }}</p>
                            {{-- <a onclick="AddCart({{ $product->id }})" href="javascript:"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                                    Add to cart</a> --}}
                            {{-- <button type="button" data-id_product="{{ $product->id }}" class="btn btn-default add-to-cart" name="add-to-cart">Add to cart</button> --}}
                            <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                    {{-- </form> --}}

                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">

                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
