$(document).on('click','.add-cart',function(){

    let id=$(this).data('id');

    $.ajax({

        url:'/cart/add',

        method:'POST',

        data:{

            product_id:id,

            _token:$('meta[name="csrf-token"]').attr('content')

        },

        success:function(res){

            $('#cartCount').text(res.count);

            Swal.fire({

                icon:'success',

                title:'Added to Cart',

                timer:1200,

                showConfirmButton:false

            });

        }

    });

});