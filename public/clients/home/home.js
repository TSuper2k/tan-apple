$(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
});

$(document).ready(function(){
    $('#sort').on('change', function(){
        var url = $(this).val();
        if(url){
            window.location = url;
        }
        return false;
    })
});

// $(document).ready(function() {
//     $("#slider-range").slider({
//         orientation: "horizontal",
//         range: true,
//         min: {{$min_price_range}},
//         max: {{$max_price_range}},
//         step: 100000,
//         values: [{{$min_price}}, {{$max_price}}],
//         slide: function(event, ui) {
//             $("#amount_start").val(ui.values[0]).simpleMoneyFormat();
//             $("#amount_end").val(ui.values[1]).simpleMoneyFormat();
//             $("#start_price").val(ui.values[0]);
//             $("#end_price").val(ui.values[1]);
//         }
//     });
//     $("#amount_start").val($("#slider-range").slider("values", 0)).simpleMoneyFormat();
//     $("#amount_end").val($("#slider-range").slider("values", 1)).simpleMoneyFormat();
// });

// // function addToCart(event){
// //   event.preventDefault();
// //   let urlCart = $(this).data('url');
// //   $.ajax({
// //     type: "GET",
// //     url: urlCart,
// //     dataType: 'json',
// //     success: function(data){
// //       if(data.code === 200){
// //         alert('Thêm thành công');
// //       }
// //     },
// //     error: function(){

// //     }
// //   })
// // }
// // $(function(){
// //   $('.add-to-cart').on('click', addToCart);
// // });

// // function cartUpdate(event){
// //   event.preventDefault();
// //   let urlUpdateCart = $('.update_cart_url').data('url');
// //   let id = $(this).data('id');
// //   let quantity = $(this).parents('tr').find('input.quantity').val();
// //   $.ajax({
// //     type: "GET",
// //     url: urlUpdateCart,
// //     data: {id: id, quantity: quantity},
// //     success: function(data){
// //       if(data.code === 200){
// //         $('.cart_info').html(data.cart_component);
// //         alert('Cap nhat thanh cong');
// //       }
// //     },
// //     error: function(){

// //     }
// //   })
// // }

// // $(function(){
// //   $(document).on('click', '.cart_update', cartUpdate);
// // })

// function AddCart(id){
//   $.ajax({
//     url: 'client/add-cart/' + id,
//     type: 'GET',
//   }).done(function(response){
//     RenderCart(response);
//     alertify.success('Đã thêm mới sản phẩm');
//   });
// }

// $("#change-item-cart").on("click", ".si-close i", function(){
//   $.ajax({
//     url: 'client/delete-cart/' + $(this).data("id"),
//     type: 'GET',
//   }).done(function(response){
//     RenderCart(response);
//     alertify.success('Đã xóa sản phẩm');
//   });
// })

// function RenderCart(response){
//   $("#change-item-cart").empty();
//   $("#change-item-cart").html(response);
//   $("#total-quanty-show").text($("#total-quanty-cart").val());
// }

// function DeleteListItemCart(id){
//   $.ajax({
//     url: 'client/delete-list-cart/' + id,
//     type: 'GET',
//   }).done(function(response){
//     RenderListCart(response);
//     alertify.success('Đã xóa');
//   });
// }

// function RenderListCart(response){
//   $("#list-cart").empty();
//   $("#list-cart").html(response);

//   var proQty = $('.pro-qty');
// 	proQty.prepend('<span class="dec qtybtn">-</span>');
// 	proQty.append('<span class="inc qtybtn">+</span>');
// 	proQty.on('click', '.qtybtn', function () {
// 		var $button = $(this);
// 		var oldValue = $button.parent().find('input').val();
// 		if ($button.hasClass('inc')) {
// 			var newVal = parseFloat(oldValue) + 1;
// 		} else {
// 			// Don't allow decrementing below zero
// 			if (oldValue > 0) {
// 				var newVal = parseFloat(oldValue) - 1;
// 			} else {
// 				newVal = 0;
// 			}
// 		}
// 		$button.parent().find('input').val(newVal);
// 	});

// }

// function SaveListItemCart(id){

//   $.ajax({
//     url: 'client/save-list-cart/' + id + '/' + $("#quanty-item-" + id).val(),
//     type: 'GET',
//   }).done(function(response){
//     RenderListCart(response);
//     alertify.success('Đã cập nhật');
//   });
// }

// $(".edit-all").on("click", function(){
//   var list = [];
//   $("table tbody tr td").each(function(){
//     $(this).find("input").each(function(){
//       var element = {key: $(this).data("id"), value: $(this).val()};
//       list.push(element);
//     })
//   })

//   $.ajax({
//     url: 'client/save-all',
//     type: 'POST',
//     data: {
//       "_token": "{{ csrf_token() }}",
//       "data": lists
//     },
//   }).done(function(response){
//     location.reload();
//   });
// })

