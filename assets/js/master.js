$(function(){

    var base_url = window.location.origin+'/meraki';
    // Form submitting
    $(document).on('submit','#sign_up_form',function(event){
        var name = $("#name").val();
        var contactNumber = $("#contact_no").val();
        var emailAddress = $("#email").val();
        var atpos = emailAddress.indexOf("@");
        var dotpos = emailAddress.lastIndexOf(".");
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        var count = 0;
        var error = $(".error");
        if (name == "") {
            $(error[0]).html("*This field should not be blank");
            $(error[0]).css("display", "block");
            count++;
        }
        else
            $(error[0]).css("display", "none");
        if (contactNumber == "" || isNaN(contactNumber) || contactNumber.length != 10) {
            $(error[1]).html("*Enetr a valid phone number");
            $(error[1]).css("display", "block");
            count++;
        } else
            $(error[1]).css("display", "none");
        if (emailAddress == "") {
            $(error[2]).html("*This field should not be blank");
            $(error[2]).css("display", "block");
            count++;
        } else if (atpos < 2 || dotpos < atpos + 3 || dotpos + 2 >= emailAddress.length) {
            $(error[2]).html("*Invalid email address");
            $(error[2]).css("display", "block");
            count++;
        } else
            $(error[2]).css("display", "none");
        if (password == "") {
            $(error[3]).html("*Enter a valid password");
            $(error[3]).css({ "display": "inline", "background-color": "#FFFFFF" });
            count++;
        } else if (password.length < 5) {
            $(error[3]).html("*Password should be atleast 5 characters");
            $(error[3]).css({ "display": "inline", "background-color": "#FFFFFF" });
            count++;
        } else
            $(error[3]).css("display", "none");

        if (confirmPassword != password) {
            $(error[4]).html("*Password not matched");
            count++;
        }

        if (count > 0)
            return false;
        else{
            return true;
        }
    });

    // password progressbar
    $("#password_progressbar").hide();
    $("#password").keyup(function() {
        var password = $("#password").val();
        $("#password_progressbar").show();
        var passwordProgressBar = $("#password_progressbar");
        $(passwordProgressBar).html("");
        if (password.length == ' ') {
            $("#password_progressbar").hide();
            $(passwordProgressBar).animate({backgroundColor: '#D03333', width: '0'});
        } else if (password.length < 5) {
            $(passwordProgressBar).animate({backgroundColor: '#D03333', width: '25%'});
        } else if (password.length < 8) {
            $(passwordProgressBar).animate({backgroundColor: '#EBD219', width: '50%'});
        } else if (password.length < 10) {
            $(passwordProgressBar).animate({backgroundColor: '#3491CA', width: '75%'});
        } else if (password.length >= 10) {
            $(passwordProgressBar).animate({backgroundColor: '#2CDC41', width: '100%' });
        } else
            $(passwordProgressBar).css("visibility", "hidden");
    });


    // Form change password
    $(document).on('submit','#change_password_form',function(event){
        var password = $("#change_password").val();
        var confirmPassword = $("#confirm_change_password").val();
        var count = 0;
        var error = $(".error");
        if (password == "") {
            $(error[0]).html("*Enter a valid password");
            $(error[0]).css({ "display": "inline", "background-color": "#FFFFFF" });
            count++;
        } else if (password.length < 5) {
            $(error[0]).html("*Password should be atleast 5 characters");
            $(error[0]).css({ "display": "inline", "background-color": "#FFFFFF" });
            count++;
        } else
            $(error[0]).css("display", "none");

        if (confirmPassword != password) {
            $(error[1]).html("*Password not matched");
            count++;
        }

        if (count > 0)
            return false;
        else{
            return true;
        }
    });

    // password progressbar
    $("#change_password").keyup(function() {
        var password = $("#change_password").val();
        $("#password_progressbar").show();
        var passwordProgressBar = $("#password_progressbar");
        $(passwordProgressBar).html("");
        if (password.length == ' ') {
            $("#password_progressbar").hide();
            $(passwordProgressBar).animate({backgroundColor: '#D03333', width: '0'});
        } else if (password.length < 5) {
            $(passwordProgressBar).animate({backgroundColor: '#D03333', width: '25%'});
        } else if (password.length < 8) {
            $(passwordProgressBar).animate({backgroundColor: '#EBD219', width: '50%'});
        } else if (password.length < 10) {
            $(passwordProgressBar).animate({backgroundColor: '#3491CA', width: '75%'});
        } else if (password.length >= 10) {
            $(passwordProgressBar).animate({backgroundColor: '#2CDC41', width: '100%' });
        } else
            $(passwordProgressBar).css("visibility", "hidden");
    });

    //menu sidebar
    $(document).on('click','.fa-bars',function(){
        $('#side_nav').css('width','100%');
    });

    $(document).on('click','#side_nav .fa-times',function(){
        $('#side_nav').css('width','0');
    });

    //Cart modal
    $(document).on('click','#cart',function(){
        $.ajax({
            url: base_url+'/product/cart/',
            success:function(data){
                $('#cart_modal').html(data).css('display','block');
            }
        });
    });
    $(document).on('click','#cart_modal .fa-times',function(){
        $('#cart_modal').hide();
        $('#cart_modal_2').hide();
    });
    $(document).click(function(event) {
        if (!$(event.target).closest("#cart_modal,#cart,.fa-shopping-cart").length) {
            $('#cart_modal').hide();
        }
    });

    //Add cart
    $(document).on('click','#add_to_cart', function(){
        var product_id = $(this).val();
        var select_size = $("#product_size>select").val();
        if(select_size == undefined)
            select_size = '0';
        if(select_size == ''){
            $("#select_size_popup").show().delay(2000).fadeOut();
        }
        else{
            $.ajax({
                url: base_url+'/product/cart/'+product_id+'/'+select_size,
                success:function(data){
                    $('#cart_modal').html(data).css('display','block');
                }
            });
        }
    });

    $(document).on('click','#buy_now', function(){
        var product_id = $(this).val();
        var select_size = $("#product_size>select").val();
        if(select_size == undefined)
            select_size = '0';
        if(select_size == ''){
            $("#select_size_popup").show().delay(2000).fadeOut();
        }
        else{
            window.location.href = base_url+'/buynow/'+product_id+'/'+select_size;
        }
    });


    //plus cart
    $(document).on('click','#cart_modal .fa-plus', function(){
        var cart_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#cart_modal").
                append('<div class="loader_container"></div>');
            },
            url: base_url+'/product/plus_cart/'+cart_id,
            success:function(data){
                setTimeout(function(){
                    $('#cart_modal').html(data).css('display','block');
                }, 200);
            }
        });
    });

    //minus cart
     $(document).on('click','#cart_modal .fa-minus', function(){
        var qty = $(this).next(".qty").val();
        var cart_id = $(this).val();
        if(qty>1){
            qty--;
            $.ajax({
                beforeSend:function(){
                    $("#cart_modal").
                    append('<div class="loader_container"></div>');
                },
                url: base_url+'/product/minus_cart/'+cart_id,
                success:function(data){
                    setTimeout(function(){
                        $('#cart_modal').html(data).css('display','block');
                    }, 200);
                }
            });
        }
    });

    //remove cart
    $(document).on('click','#cart_modal .rmv', function(){
        var cart_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#cart_modal").
                append('<div class="loader_container"></div>');
            },
            url: base_url+'/product/remove_cart/'+cart_id,
            success:function(data){
                setTimeout(function(){
                    $('#cart_modal').html(data).css('display','block');
                }, 200);
            }
        });
    });


    // dropdown buttton for profile
    $(".dropbtn").click(function(){
        $("#myDropdown").toggleClass('show');
    });
    $("body").click(function(evt){
        if(evt.target.id == "user")
            return;
        if($("#myDropdown").hasClass('show'))
            $("#myDropdown").removeClass('show');
    });


    // Aside catagory section
    $(document).on('click', '#clothes', function(){
        $('.clothes').toggle();
    });
    $(document).on('click', '#accessories', function(){
        $('.accessories').toggle();
    });

    $('.dropdown_container_list').click(function(){
        offset = 0;
        var sub_catagory_id = $(this).data("value");
        $('.dropdown_container_list').removeClass('active_link');
        $(this).addClass('active_link');
        $('.dropdown_container').hide();
        $(this).parent().show();
        var gender = [1,2,3,4,5,6,8,9,12];
        var size = [1,2,3,4,5,6];
        if(gender.indexOf(sub_catagory_id) > -1)
            $('.gender').show();
        else
            $('.gender').hide();
        if(size.indexOf(sub_catagory_id) > -1)
            $('.size').show();
        else
            $('.size').hide();

        $.ajax({
            beforeSend:function(){
                $("#products").
                append('<div class="loader_container"></div>');
            },
            url: base_url+'/product/get_product/'+sub_catagory_id,
            success:function(data){
                setTimeout(function(){
                    $('#products').html(data);
                }, 300);
            }
        });
    });

    //Load more product
    var offset = 0;
    $(document).on('click' ,'#load_more', function(){
        offset += 9;
        var catagory = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#products").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: base_url+'/product/load_more/'+catagory+'/'+offset,
            success:function(data){
                setTimeout(function(){
                    $('#load_more').parent().before(data);
                    $('#products>.loader_container').remove();
                    if(data == '')
                        $('#load_more').hide();
                }, 300);
            }
        });

    });

    //profile section
    $('#myprofile_pic').hover(function(){
        $('.fa-camera').show();
    },function(){
        $('.fa-camera').hide();
    });

     //upload img form modal
    $(document).on('click','.fa-camera',function(){
        $('#modal_2').css('display','block');
    });
    $(document).on('click','.fa-times',function(){
        $('#modal_2').hide();
    });
    $('#modal_2').click(function(event) {
        if (!$(event.target).closest("#modal_2_1,.fa-times").length) {
            $('#modal_2').hide();
        }
    });


    // Profile nav
    $(document).on('click', '.profile_nav', function(){
        var page = $(this).val();
        $('.profile_nav').css('background-color','white');
        $(this).css('background-color','#e5e5e5');
        $.ajax({
            beforeSend:function(){
                    $("#profile_body").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: base_url+'/user/profile_nav/'+page,
            success:function(data){
                setTimeout(function(){
                    $('#profile_body').html(data);
                }, 300);
            }
        });
    });

    //add new address form show
    $(document).on('click' ,'.add_new_adr',function(){
        $('#add_address').slideToggle();
    });
    $(document).on('click' ,'#add_address>.cancel',function(event){
        event.preventDefault();
        $('#add_address').slideToggle();
    });
    $(document).on('submit','#add_address', function(event){
        event.preventDefault();
        var user_id = $(this).children().first().val();
        $.ajax({
            beforeSend:function(){
                    $("#profile_body").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: base_url+'/user/location/'+user_id,
            data: $(this).serialize(),
            type: 'post',
            success:function(data){
                setTimeout(function(){
                    $('#profile_body').html(data);
                }, 300);
            }
        });
        return true;
    });

    //my profile edit
    $('#profile_body input').attr('disabled','disabled');
    $(document).on('click' ,'#profile_body>p .fa-pencil-alt',function(){
        $('input').removeAttr('disabled');
        $('#my_profile_form button').show();
    });
    $(document).on('click' ,'#my_profile_form>.cancel',function(event){
        event.preventDefault();
        $('#profile_body input').attr('disabled','disabled');
        $('#my_profile_form button').hide();
    });

    //address edit delete
    $(document).on('click' ,'.fa-ellipsis-v',function(){
        $('.dot_popup').hide();
        $(this).next('.dot_popup').show();
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".fa-ellipsis-v").length) {
            $('.fa-ellipsis-v').next('.dot_popup').hide();
        }
    });

    //edit location
    $(document).on('click','#address_table tr .edit', function(){
        $(this).closest('td').find('form').slideToggle();
        $(this).closest('div').parent().hide();
    });

    $(document).on('click','#address_table tr .cancel', function(event){
        event.preventDefault();
        $(this).parent().slideToggle();
        $(this).parent().prev().show();
    });

    $(document).on('submit','.edit_location_form', function(event){
        event.preventDefault();
        var location_id = $(this).children().first().val();
        $.ajax({
            beforeSend:function(){
                    $("#profile_body").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: base_url+'/user/update_location/'+location_id,
            data: $(this).serialize(),
            type: 'post',
            success:function(data){
                setTimeout(function(){
                    $('#profile_body').html(data);
                }, 300);
            }
        });
        return true;
    });

    //delete location
    $(document).on('click','#address_table tr .delete', function(){
        var location_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                    $("#profile_body").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: base_url+'/user/delete_location/'+location_id,
            success:function(data){
                setTimeout(function(){
                    $('#profile_body').html(data);
                }, 300);
            }
        });
    });

    //forget password form submit
    $(document).on('submit', '#forget_password_form' , function(event){
        event.preventDefault();
        var user_id = $(this).children().first().val();
        $.ajax({
            beforeSend:function(){
                    $("#profile_body").
                    append('<div class="loader_container"><div class="loader"></div></div>');
            },
            url: base_url+'/user/change_password/'+user_id,
            data: $(this).serialize(),
            type: 'post',
            success:function(data){
                setTimeout(function(){
                    $('#profile_body').html(data);
                }, 300);
            }
        });
        return true;
    });

    //msg hide
    $(document).on('click','#profile_body .msg .fa-times', function(){
        $(this).parent().fadeOut(300);
    });

    //checkout

    //checkout plus
    $(document).on('click','#checkout_cart_body .fa-plus', function(){
        var cart_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#checkout_wrapper").
                append('<div class="loader_container"></div>');
            },
            url: base_url+'/product/checkout_plus_cart/'+cart_id,
            success:function(data){
                setTimeout(function(){
                    $('#checkout_wrapper').replaceWith(data).css('display','block');
                }, 200);
            }
        });
    });

    //checkout minus
    $(document).on('click','#checkout_cart_body .fa-minus', function(){
        var cart_id = $(this).val();
        var qty = $(this).next(".qty").val();
        if(qty>1){
            qty--;
            $.ajax({
                beforeSend:function(){
                    $("#checkout_wrapper").
                    append('<div class="loader_container"></div>');
                },
                url: base_url+'/product/checkout_minus_cart/'+cart_id,
                success:function(data){
                    setTimeout(function(){
                        $('#checkout_wrapper').replaceWith(data).css('display','block');
                    }, 200);
                }
            });
        }
    });

    //checkout remove
    $(document).on('click','#checkout_cart_body .rmv', function(){
        var cart_id = $(this).val();
        $.ajax({
            beforeSend:function(){
                $("#checkout_wrapper").
                append('<div class="loader_container"></div>');
            },
            url: base_url+'/product/checkout_remove_cart/'+cart_id,
            success:function(data){
                setTimeout(function(){
                    $('#checkout_wrapper').replaceWith(data).css('display','block');
                }, 200);
            }
        });
    });

    //order system
    $(document).on('click', '.continue', function(){
        $('.location_option').show();
        $('.cart_option').hide();
        $('.cart_change').show();
    });

    $(document).on('click', '.cart_change', function(){
        $('.option').hide();
        $('.cart_option').show();
        $('.change').hide();
    });

    $(document).on('change','input.location',function(){
        $('.location_btn').hide();
        $(this).parent().next().toggle();
    }); 

    $(document).on('click', '.location_change', function(event){
        event.preventDefault();
        $('.option').hide();
        $('.location_option').show();
        $(this).hide();
    });

    $(document).on('click','.location_btn',function(event){
        event.preventDefault();
        $('.payment_option').show();
        $('.location_option').hide();
        $('.location_change').show();
    });

    $(document).on('change','input.payment',function(){
        $('.payment_btn').hide();
        $(this).parent().next().toggle();
    });
    // end

    // product img change
    $(document).on('click','.product_imgs',function(){
        var pr_imgs_id = $(this).val();
        $.ajax({
            url: base_url+'/product/get_imgs/'+pr_imgs_id,
            success:function(data){
                $('#product_image>img').attr('src',data);
            }
        });
    });

    $(document).on('click','.product_img',function(){
        var img = $(this).val();
            $('#product_image>img').attr('src',img);
    });

    //cancel order

    //Cart modal
    $(document).on('click','.cancel_order_btn',function(){
        var order_id = $(this).val();
        $('#order_cancel_modal').find('.save').attr('href',base_url+'/user/cancel_order/'+order_id);
        $('#order_cancel_modal').toggleClass('hide');

    });
    $(document).on('click','#order_cancel_modal .fa-times',function(){
        $('#order_cancel_modal').toggleClass('hide');
    });

    $(document).on('click','#order_cancel_modal .cancel',function(){
        $('#order_cancel_modal').toggleClass('hide');
    });

    $(document).on('change','.star',function(){
        var star = $(this).val();
        var stars = $('.fa-star');
        $('.fa-star').removeClass('active_star');
        for(var i = 0;i<star;i++){
            $(stars[i]).addClass('active_star');
        }
    });

    $(document).on('click','#rate_btn',function(){
        $('#reviews form').slideToggle();
    });

    $(document).on('click','#reviews form .cancel',function(event){
        event.preventDefault();
        $('#reviews form').slideUp();
    });

    // $(document).on('click','.fa-thumbs-up', function(){
    //     var this_element = $(this);
    //     var review_id  = this_element.val();
    //     if(!this_element.hasClass('active_like'))
    //         $.ajax({
    //             url: base_url+'/user/review_like/'+review_id,
    //             success:function(data){
    //                  this_element.next().html(data);
    //                  this_element.addClass('active_like');
    //             }
    //         });
    //     else
    //         $.ajax({
    //             url: base_url+'/user/review_like/'+review_id+'/true',
    //             success:function(data){
    //                  this_element.next().html(data);
    //                  this_element.removeClass('active_like');
    //             }
    //         });

    // });

});