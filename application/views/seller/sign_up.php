<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seller Sign In</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/seller.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
	<script src="<?php echo base_url('assets/js/seller.js'); ?>"></script>
	<script>
		$(function(){
			var validate = "<?php echo isset($validate) && !$validate ? 'This acount allready exist' : ''; ?>";
	        var error = $(".error");
			if(validate != ''){
	            $(error[2]).html(validate);
            	$(error[2]).css("display", "block");
            	$("#email").css("border", "1px solid red");
			}
			else{
				$(error[2]).html('');
				$(error[2]).css("display", "none");
            	$("#email").css("border", "1px solid #b5b5b5");
			}
			
		});
	</script>
</head>
<body>
	<section id="sign_body">
		<section id="sign_container">
			<p>Sign Up</p>
			<form id="sign_up_form" action="<?php echo base_url('seller/sign_up_action'); ?>" method="post">
				<input type="text" id="name" name="seller[name]" placeholder="Name" value="<?= $this->session->flashdata('name')?>"><span class="error"></span>
				<input type="text" id="contact_no" name="seller[contact_no]" placeholder="Contact No" value="<?= $this->session->flashdata('contact_no')?>"><span class="error"></span>
				<input type="text" id="email" name="seller[email]" placeholder="Email Address" value="<?= $this->session->flashdata('email')?>"><span class="error"></span>
				<input type="password" id="password" name="seller[password]" placeholder="Password">
				<div id="password_progressbar"></div><span class="error"></span>
				<input type="password" id="confirm_password" name="seller[password]" placeholder="Confirm Password">
				<button>Sign Up</button>
				<div><a href="<?php echo base_url('seller/sign_in'); ?>">Sign In</a></div>
			</form>
		</section>
	</section>
</body>
</html>