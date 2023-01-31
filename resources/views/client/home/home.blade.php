@extends('layouts.client')

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
    <!--/slider-->
    @include('client.home.components.slider')
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">

                @include('client.components.sidebar')

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    @include('client.home.components.feature_product')
                    <!--features_items-->

                    <!--/category-tab-->
                    @include('client.home.components.category_tab')
                    <!--/category-tab-->

                    <!--recommended_items-->
                    @include('client.home.components.recommend_product')
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection
