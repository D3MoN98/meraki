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
			<h2>Change password</h2>
			<form id="change_password_form" action="<?= base_url('user/forget_change_password')?>" method="post">
				<label>
					New Password <br>
					<input id="change_password" type="password" name="user[password]" placeholder="New Password">
					<div id="password_progressbar"></div>
					<span class="error"></span>
				</label>
				<label>
					Confirm Password <br>
					<input id="confirm_change_password" type="password" placeholder="Confirm Password">
					<span class="error"></span>
				</label>
				<input type="hidden" value="<?= $user_id?>" name='user[user_id]'>
				<button>Save</button>
			</form>
		</section>
	</section>
</body>
</html>