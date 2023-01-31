@extends('layouts.client')

@section('title')
    <title>Đặt hàng thành công</title>
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

            <h4 style="height: 200px">
                <center>Cảm ơn bạn đã đặt hàng, vui lòng kiểm tra Email, chúng tôi sẽ liên hệ với bạn sớm nhất :)</center>
            </h4>

        </div>
        <script type="text/javascript">
            function Redirect() {
                window.location="http://127.0.0.1:8000";
            }

            document.write("Bạn sẽ được đưa về trang chủ trong 3 giây");
            setTimeout('Redirect()', 3000);
        </script>
    </section>
    <!--/#cart_items-->
@endsection
