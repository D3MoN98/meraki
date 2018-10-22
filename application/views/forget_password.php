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
			<h2>Your Credentials</h2>
			<span class="error"><?= $this->session->flashdata('result')?></span>
			<form action="<?= base_url('user/forget_password')?>" method="post">
				<label>
					Email <br>
					<input type="text" name="user[email]" placeholder="Email" value="<?= $this->session->flashdata('email')?>">
				</label>
				<label>
					Contact No <br>
					<input type="text" name="user[contact_no]" placeholder="Contact No" value="<?= $this->session->flashdata('contact_no')?>">
				</label>
				<button>Next</button>
			</form>
		</section>
	</section>
</body>
</html>