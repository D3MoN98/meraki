<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?= base_url('assets/meraki.ico')?>"> 
	<title>meraki</title>
	<meta name="viewport" content="width=device-width">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sign.css'); ?>">
	
	<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
	<script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
	<script src="<?php echo base_url('assets/js/master.js'); ?>" type="text/javascript"></script>
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
	<h1><a href="<?php echo base_url()?>">MERAKI</a></h1>
	<section id="sign_form_wrapper">
		<section id="sign_form">
		<h2>Sign Up</h2>
		<form id="sign_up_form" action="<?php echo base_url('user/sign_up_action'); ?>" method="post">
			<label>
				Name <br>
				<input type="text" id="name" name="user[name]" placeholder="Name" value="<?php echo $this->session->flashdata('name');?>"><br>
				<span class="error"></span>
			</label>
			<label>
				Contact No <br>
				<input type="text" id="contact_no" name="user[contact_no]" placeholder="Contact No" value="<?php echo $this->session->flashdata('contact_no');?>">
				<span class="error"></span>
			</label>
			<label>
				Email <br>
				<input type="text" id="email" name="user[email]" placeholder="Email" value="<?php echo $this->session->flashdata('email');?>">
				<span class="error"></span>
			</label>
			<label>
				Password <br>
				<input type="password" id="password" name="user[password]" placeholder="Password">
				<div id="password_progressbar"></div>
				<span class="error"></span>
			</label>
			<label>
				Confirm Password <br>
				<input type="password" id="confirm_password" placeholder="Confirm Password">
				<span class="error"></span>
			</label>
			<button>Sign Up</button>
		</form>
		<p><a href="<?php echo base_url('sign_in'); ?>">Sign In</a><br></p>
	</section>
	</section>
	
	
</body>
</html>