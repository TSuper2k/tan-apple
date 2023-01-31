@extends('layouts.client')

@section('title')
    <title>Đăng nhập</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('clients/home/home.js') }}"></script>
@endsection

@section('content')
    <section id="form">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Đăng nhập</h2>
                        <form action="{{ route('login-customer') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @error('fail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="email_account" placeholder="Email" @error('email_account') is-invalid @enderror
                                value="{{ old('email_account') }}"/>
                                @error('email_account')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_account" placeholder="Mật khẩu" @error('password_account') is-invalid @enderror/>
                                @error('password_account')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <span>
                                <input type="checkbox" class="checkbox">
                                Ghi nhớ đăng nhập
                            </span> --}}
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">HOẶC</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="{{ route('add-customer') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Tên" @error('name') is-invalid @enderror
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email"
                                    @error('email') is-invalid @enderror value="{{ old('email') }}" />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="phone" placeholder="Số điện thoại"
                                    @error('phone') is-invalid @enderror value="{{ old('phone') }}" />
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" placeholder="Địa chỉ"
                                    @error('address') is-invalid @enderror value="{{ old('address') }}" />
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" placeholder="Mật khẩu"
                                    @error('password') is-invalid @enderror />
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                                    @error('password_confirmation') is-invalid @enderror />
                                @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endsection
