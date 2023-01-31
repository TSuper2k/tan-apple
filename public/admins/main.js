//button delete
function actionDelete(event){
  event.preventDefault();
  let urlRequest = $(this).data('url');
  let that = $(this);

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'GET',
        url: urlRequest,
        success: function(data){
          if(data.code == 200){
            that.parent().parent().remove();
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        },
        error: function(){

        }
      });
    }
  })
}

$(function(){
  $(document).on('click', '.action_delete', actionDelete);
});

//statistical
$(document).ready(function(){
  chart30daysorder();

  var chart = new Morris.Bar({
    element: 'chart',
    lineColors: ['#819C79','#fc8710','#FF6541','#A4ADD3','#766B56'],
    parseTime: false,

    // data: [
    //   { period: '2008', value: 20 },
    //   { period: '2009', value: 10 },
    //   { period: '2010', value: 5 },
    //   { period: '2011', value: 5 },
    //   { period: '2012', value: 20 }
    // ],
    
    hideHover: 'auto',
    xkey: 'period',
    ykeys: ['order','sales','quantity'],
    labels: ['Đơn hàng','Doanh số','Số lượng']
  });

  function chart30daysorder(){
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url: 'http://127.0.0.1:8000/admin/statistical/days-order',
      method: "POST",
      dataType: "JSON",
      data: {_token:_token},
      success: function(data){
        chart.setData(data);
      }
    });
  };

  $('.dashboard-filter').change(function(){
    var dashboard_value = $(this).val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url: 'http://127.0.0.1:8000/admin/statistical/dashboard-filter',
      method: "POST",
      dataType: "JSON",
      data: {_token:_token, dashboard_value:dashboard_value},
      success: function(data){
        chart.setData(data);
      }
    });
  });

  $( function() {
    $( "#datepicker" ).datepicker({
      prevText: "Tháng trước",
      nextText: "Tháng sau",
      dateFormat: "yy-mm-dd",
      dayNamesMin: ["Chủ nhật","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"],
      duration: "slow"
    });
    $( "#datepicker2" ).datepicker({
      prevText: "Tháng trước",
      nextText: "Tháng sau",
      dateFormat: "yy-mm-dd",
      dayNamesMin: ["Chủ nhật","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"],
      duration: "slow"
    });
  });
  
  $('#btn-dashbroard-filter').click(function(){
    var _token = $('input[name="_token"]').val();
  
    var from_date = $('#datepicker').val();
    var to_date = $('#datepicker2').val();
  
    $.ajax({
      url: 'http://127.0.0.1:8000/admin/statistical/filter-by-date',
      method: "POST",
      dataType: "JSON",
      data: {from_date:from_date, to_date:to_date, _token:_token},
      success: function(data){
        chart.setData(data);
      }
    });
  });
});

//order
$('.order_details').change(function(){
  var order_status = $(this).val();
  var order_id = $(this).children(":selected").attr("id");
  var _token = $('input[name="_token"]').val();

  product_quantity = [];
  $("input[name='product_quantity']").each(function(){
    product_quantity.push($(this).val());
  });

  order_product_id = [];
  $("input[name='order_product_id']").each(function(){
    order_product_id.push($(this).val());
  });

  j = 0;
  for(i = 0; i < order_product_id.length; i++){
    //khách đặt
    var order_qty = $('.order_qty_' + order_product_id[i]).val();
    //tồn kho
    var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
    if(parseInt(order_qty) > parseInt(order_qty_storage)){
      j = j + 1;
      if(j == 1){
        alert('Không đủ hàng');
      }
      $('.color_qty_' + order_product_id[i]).css('background', '#FF0000');
    }
  }
  if(j == 0){
    $.ajax({
      url: '/admin/orders/update-order-qty',
      method: 'POST',
      data: {_token:_token, order_status:order_status, order_id:order_id, order_product_id:order_product_id, product_quantity:product_quantity},
      success: function(data){
        alert('Cập nhật trạng thái đơn hàng thành công');
        location.reload();
      }
    });
  }
});


$('.update_quantity_order').click(function(){
  var order_product_id = $(this).data('product_id');
  var order_qty = $('.order_qty_' + order_product_id).val();
  var order_id = $('.order_id').val();
  var _token = $('input[name="_token"]').val();

  $.ajax({
    url: '/admin/orders/update-qty',
    method: 'POST',
    data: {_token:_token, order_qty:order_qty, order_id:order_id, order_product_id:order_product_id},
    success:function(data){
      alert('Thay đổi tình trạng đơn hàng thành công');
      location.reload();
    }});
  // alert(order_product_id)
  // alert(order_qty)
  // alert(order_id)
});
