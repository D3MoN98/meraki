$(function(){
    var base_url = window.location.origin+'/meraki';

    // Form submitting
    $(document).on('submit','#sign_up_form',function(){
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

    // Menu toggle
    $(".fa-bars").click(function(){
        if($(".sidebar_nav_two").hasClass('active')){
            $(".sidebar_nav_two").css('display','none');
            $(".sidebar_nav_one").css('display','block');
            $(".sidebar_nav_two").removeClass('active');
            $(".sidebar_nav_one").addClass('active');
        }
        else if($(".sidebar_nav_one").hasClass('active')){
            $(".sidebar_nav_one").css('display','none');
            $(".sidebar_nav_two").css('display','block');
            $(".sidebar_nav_one").removeClass('active');
            $(".sidebar_nav_two").addClass('active');
        }
    });

    // dropdown buttton for profile
    $("#profile").click(function(){
        $("#myDropdown,#profile").toggleClass('show');
    });
    $("body").click(function(evt){
        if(evt.target.id == "profile")
            return;
        if($("#myDropdown,#profile").hasClass('show'))
            $("#myDropdown,#profile").removeClass('show');
    });

    $(document).on('click', '#data_table_dropdown', function(){
        $('aside.sidebar_nav_one li:nth-child(3),aside.sidebar_nav_one li:nth-child(4)').toggleClass('show_dropdown');
        if($('aside.sidebar_nav_one li:nth-child(3),aside.sidebar_nav_one li:nth-child(4)').hasClass('show_dropdown')) 
            $('aside.sidebar_nav_one li:nth-child(3),aside.sidebar_nav_one li:nth-child(4)').css('display','block');
        else
            $('aside.sidebar_nav_one li:nth-child(3),aside.sidebar_nav_one li:nth-child(4)').css('display','none');

    });

    // Edit function
    $(document).on("click", '.fa-pencil-alt', function(){
        var id = $(this).val();
        var table;
        if($(this).hasClass('user'))
            table = 'user';
        else
            table = 'seller';
        $.ajax({
            url: base_url+'/admin/edit/'+table,
            data: {'id' : id},
            type: 'post',
            success:function(data){
                $("#modal_body").html(data).css('display','block');
            }
        });
    });
    $(document).on('click','.fa-times',function(){
        $("#edit_container").css({  "-webkit-animation-name": "animatedown",
                                    "-webkit-animation-duration": "0.4s",
                                    "animation-name": "animatedown",
                                    "animation-duration": "0.4s"});
        $("#modal_body").fadeOut();
    });


    // Delete function
    $(document).on("click", '.fa-trash-alt', function(){
        $("#modal_body").css('display','block');
        var value = $(this).val();
        var table;
        if($(this).hasClass('user'))
            table = 'user';
        else
            table = 'seller';

        $("#modal_body").html("<section id='confirm_delete'>Are you sure youn want to delete<br><button name='yes' value="+value+">Yes</button><button name='cancel'>Cancel</button></section>");
        $("#confirm_delete button[name=yes]").click(function(){
            var id = $(this).val();
            $.ajax({
                url: base_url+'/admin/delete/'+table+"/"+id,
                success:function(data){
                    $("#modal_body").html("<section id='confirm_delete'>One row deleted</section>").css('display','block').delay(2000).fadeOut();
                    $("#tbody").html(data);
                }
            });
        });

        $("#confirm_delete button[name=cancel]").click(function(){
            $("#confirm_delete").css({"-webkit-animation-name": "animatedown",
                                        "-webkit-animation-duration": "0.4s",
                                        "animation-name": "animatedown",
                                        "animation-duration": "0.4s"});
            $("#modal_body").fadeOut(400);
        });
    });

    // Deactivate
    $(document).on("click", '.fa-power-off', function() {
        $("#modal_body").css('display','block');
        var value = $(this).val();
        var table;
        if($(this).hasClass('user'))
            table = 'user';
        else
            table = 'seller';

        $("#modal_body").html("<section id='confirm_deactivate'>Are you sure youn want to change status<br><button name='yes' value="+value+">Yes</button><button name='cancel'>Cancel</button></section>");
        $("#confirm_deactivate button[name=yes]").click(function(){
            var id = $(this).val();
            $.ajax({
                url: base_url+'/admin/update_status/'+table+"/"+id,
                success:function(data){
                    $("#modal_body").html("<section id='confirm_deactivate'>Status changed</section>").css('display','block').delay(2000).fadeOut();
                    $("#tbody").html(data);
                }
            });
        });
        $("#confirm_deactivate button[name=cancel]").click(function(){
        $("#confirm_deactivate").css({"-webkit-animation-name": "animatedown","-webkit-animation-duration": "0.4s","animation-name": "animatedown","animation-duration": "0.4s"});
            $("#modal_body").fadeOut(400);
        });
    }); 


    // table switch

    $('#switch').change(function() {
        if(this.checked) {
            $("input#search_table").toggleClass('user');
            $("input#search_table").toggleClass('seller');
            $.ajax({
                url: base_url+'/admin/seller_table',
                success:function(data){
                    $("#tbody").html(data);
                }
            });
        }
        else{
            $("input#search_table").toggleClass('user');
            $("input#search_table").toggleClass('seller');
            $.ajax({
                url: base_url+'/admin/user_table',
                success:function(data){
                    $("#tbody").html(data);
                }
            });
        }
    });

    // search
    $("input#search_table").keyup(function(){
        var like = $(this).val();
        var table;
        if($(this).hasClass('user'))
            table = 'user';
        else
            table = 'seller';
        $.ajax({
            url: base_url+'/admin/search/'+table+"/"+like,
            success:function(data){
                $("#tbody").html(data);
            }
        });
    });
    var row = $("#num_rows").val();

});