{{-- <div class="category-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach ($categories as $keyCategory => $categoryItem)
                <li class="{{ $keyCategory == 0 ? 'active' : '' }}">
                    <a href="#category_tab_{{ $categoryItem->id }}" data-toggle="tab">
                        {{ $categoryItem->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach ($categories as $keyCategoryProduct => $categoryProductItem)
            <div class="tab-pane fade {{ $keyCategoryProduct == 0 ? 'active in' : '' }}"
                id="category_tab_{{ $categoryProductItem->id }}">
                @foreach ($categoryProductItem->products as $productItemTabs)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('detail.product', ['id' => $productItemTabs->id]) }}"><img
                                            src="{{ $productItemTabs->feature_image_path }}" alt="" /></a>
                                    <h2>{{ number_format($productItemTabs->price) }} VNĐ</h2>
                                    <p>{{ $productItemTabs->name }}</p>
                                    <a href="{{ route('add.to.cart', $productItemTabs->id) }}"
                                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div> --}}

<div class="category-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach ($categoryTab as $keyCategory => $categoryItem)
                <li class="{{ $keyCategory == 0 ? 'active' : '' }}">
                    <a href="#category_tab_{{ $categoryItem->id }}" data-toggle="tab">
                        {{ $categoryItem->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach ($categoryTab as $keyCategoryProduct => $categoryProductItem)
            <div class="tab-pane fade {{ $keyCategoryProduct == 0 ? 'active in' : '' }}"
                id="category_tab_{{ $categoryProductItem->id }}">
                @foreach ($categoryProductItem->products as $productItemTabs)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('detail.product', ['slug' => $productItemTabs->slug, 'id' => $productItemTabs->id]) }}">
                                        <img src="{{ $productItemTabs->feature_image_path }}" alt="" /></a>
                                    <h2>{{ number_format($productItemTabs->price) }} VNĐ</h2>
                                    <p>{{ $productItemTabs->name }}</p>
                                    <a href="{{ route('add.to.cart', $productItemTabs->id) }}"
                                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>