<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?= base_url('assets/meraki.ico')?>"> 
	<title>meraki</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sign.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/master.js'); ?>"></script>
</head>
<body>
	<h1><a href="<?php echo base_url()?>">MERAKI</a></h1>
	<section id="sign_form_wrapper">
		<section id="sign_form">
			<h2>Sign In</h2>
			<div id="api">
				<a href="<?= base_url('user/facebook_sign_in')?>"><i class="fab fa-facebook-f"></i> Sign in with facebook</a>
				<a href="<?= base_url('user/google_sign_in')?>"><i class="fab fa-google-plus-g"></i>Sign in with google</a>
			</div>
			<span class="error"><?= $this->session->flashdata('result')?></span>
			<form action="<?= base_url('user/sign_in_action')?>" id="sign_in_form" method="post">
				<label>
					Email <br>
					<input type="text" name="user[email]" placeholder="Email" value="<?= $this->session->flashdata('email') ? $this->session->flashdata('email') : get_cookie('email')?>">
				</label>
				<label>
					Password <br>
					<input type="password" name="user[password]" placeholder="Password" value="<?= get_cookie('password')?>">
				</label>
				<div>
					<label>
						<input type="checkbox" name="remember"> Remember Me
					</label>
				</div>
				<button>Sign In</button>
			</form>
			<p><a href="<?php echo base_url('sign_up'); ?>">Sign up</a><br><a href="<?= base_url('forget_password')?>">Forgot Password?</a></p>
		</section>
	</section>
	
</body>
</html>