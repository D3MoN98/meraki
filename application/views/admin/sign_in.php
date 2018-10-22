<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Sign In</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admin.css'); ?>">
</head>
<body>
	<section id="sign_body">
		<section id="sign_container">
			<p>Sign In</p>
			<span><?= $this->session->flashdata('result')?></span>
			<form action="<?php echo base_url('admin/sign_in_action'); ?>" method="post">
				<input type="text" name="admin[email]" placeholder="Email Address" value="<?= $this->session->flashdata('email')?>"><br>
				<input type="password" name="admin[password]" placeholder="Password">
				<button>Login</button>
				<a href="<?php echo base_url('admin/sign_up'); ?>">Register an Account</a>
			</form>
		</section>
	</section>
</body>
</html>