<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Document</title>
</head>
<style>
  table, th, td {
    border: 1px solid rgb(209, 29, 29);
  }
</style>
<body>
  <div class="container" style="background: rgb(231, 222, 222); border-radious: 12px; padding: 15px">
    <div class="col-md-12">
      <p><center>Đây là mail tự động. Quý khách vui lòng không trả lời mail này.</center></p>
      <div class="row">
        <div class="col-md-6">
          <h4><center>Công ty Tan_Apple</center></h4>
        </div>
        
        <div class="col-md-6">
          Chào bạn {{ $customer_array['customer_name'] }}
        </div>
        
        <div class="col-md-12">
          <h4>Thông tin người nhận</h4>
          <p>Email:
            <span>{{ $customer_array['customer_email'] }}</span>
          </p>
          <p>Số điện thoại:
            <span>{{ $customer_array['customer_phone'] }}</span>
          </p>
          <p>Địa chỉ:
            <span>{{ $customer_array['customer_address'] }}</span>
          </p>
        </div>

        <div class="col-md-12">
          <h4>Sản phẩm đã đặt</h4>
          <table>
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>

            <tbody>
              @php
                $sub_total = 0;
                $total = 0;
              @endphp
              @foreach($cart_array as $cart)
                @php
                  $sub_total = $cart['product_quantity'] * $cart['product_price'];
                  $total += $sub_total;
                @endphp
                <tr>
                  <td>{{ $cart['product_name'] }}</td>
                  <td>{{ number_format($cart['product_price']) }} VNĐ</td>
                  <td align="center"> {{ $cart['product_quantity'] }}</td>
                  <td>{{ number_format($sub_total) }} VNĐ</td>
                </tr>
              @endforeach
              <tr>
                <td colspan="4" align="right"><b>Tổng tiền: {{ number_format($total) }}</b></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-12">
          <p><center>Cảm ơn quý khách đã đặt hàng. Mọi chi tiết xin liên hệ 0987654321.</center></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>