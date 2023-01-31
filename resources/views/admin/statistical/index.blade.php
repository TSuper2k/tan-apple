@extends('layouts.admin')

@section('title')
    <title>Trang thống kê</title>
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.components.content-header', ['name' => 'Statistical', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form autocomplete="off">
                      @csrf
                      <div class="col-md-12">
                        <p>Từ ngày: 
                          <input type="text" id="datepicker" class="form-control">
                        </p>
                        <p>Đến ngày: 
                          <input type="text" id="datepicker2" class="form-control">
                        </p>
                        <input type="button" id="btn-dashbroard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                        <p>Lọc theo:
                          <select class="dashboard-filter form-control">
                            <option>--Chọn--</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="thangtruoc">Tháng trước</option>
                            <option value="thangnay">Tháng này</option>
                            <option value="365ngayqua">365 ngày qua</option>
                          </select>
                        </p>
                      </div>
                    </form>
                    <div class="col-md-12">
                      <div id="chart" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
