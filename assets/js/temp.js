    $(document).on('submit' ,'#order_form', function(event){
        event.preventDefault();
        $.ajax({
            url: 'http://localhost/meraki/product/place_order/',
            data: $(this).serialize(),
            type: 'post',
            success:function(data){
                setTimeout(function(){
                    $('#checkout_wrapper').replaceWith(data).css('display','block');
                }, 200);
            }
        });
        return true;
    });


    $(document).on('click', '#checkout_body .prev', function(){
        var page = $('#checkout_body_page').val();
        if(page > 1)
            page--;
        if(page != 4){
            $('#checkout_body > div:nth-child(3) .next').show();
            $('#order_form').hide();
        }
            
        $('#checkout_body_page').val(page);
        $.ajax({
            beforeSend:function(){
                    $("#checkout_ajax_body").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: 'http://localhost/meraki/product/checkout_page/'+page,
            success:function(data){
                setTimeout(function(){
                    $('#checkout_ajax_body').html(data);
                }, 300);
            }
        });
    });

    //checkout plus
    $(document).on('click','#checkout_ajax_body .fa-plus', function(){
        var cart_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#checkout_wrapper").
                append('<div class="loader_container"></div>');
            },
            url: 'http://localhost/meraki/product/checkout_plus_cart/'+cart_id,
            success:function(data){
                setTimeout(function(){
                    $('#checkout_wrapper').replaceWith(data).css('display','block');
                }, 200);
            }
        });
    });

    //checkout minus
    $(document).on('click','#checkout_ajax_body .fa-minus', function(){
        var cart_id = $(this).val();
        var qty = $(this).next(".qty").val();
        if(qty>1){
            qty--;
            $.ajax({
                beforeSend:function(){
                    $("#checkout_wrapper").
                    append('<div class="loader_container"></div>');
                },
                url: 'http://localhost/meraki/product/checkout_minus_cart/'+cart_id,
                success:function(data){
                    setTimeout(function(){
                        $('#checkout_wrapper').replaceWith(data).css('display','block');
                    }, 200);
                }
            });
        }
    });

    //checkout remove
    $(document).on('click','#checkout_ajax_body .rmv', function(){
        var cart_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#checkout_wrapper").
                append('<div class="loader_container"></div>');
            },
            url: 'http://localhost/meraki/product/checkout_remove_cart/'+cart_id,
            success:function(data){
                setTimeout(function(){
                    $('#checkout_wrapper').replaceWith(data).css('display','block');
                }, 200);
            }
        });
    });