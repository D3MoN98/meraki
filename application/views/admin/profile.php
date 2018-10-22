<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profile.css'); ?>">
</head>
<body>
	<div id="profile_wrapper">
		<aside>
			<div id="myprofile_pic">
				<img src="<?php echo base_url('upload/default.jpg')?>" alt="">
				<p><?= $admin->name?></p>
			</div>
		</aside>
		<section>
			<form action="<?= base_url('admin/edit_profile/').$admin->admin_id?>" method="post">
				<label><span>Name</span> <br>
					<input type="text" name="admin[name]" value="<?= $admin->name ?>">
				</label>
				<label><span>Date of Birth</span><br>
					<input type="date" name="admin[dob]" value="<?= $admin->dob ?>">
				</label>
				<label><span>Gender</span><br>
					<label><input type="radio" name="admin[gender]" value="male" <?= $admin->gender == 'male' ? "checked=''" : '' ?>> <span>Male</span></label>
					<label><input type="radio" name="admin[gender]" value="female" <?= $admin->gender == 'female' ? "checked=''" : '' ?>> <span>Female</span></label>
				</label>
				<label><span>Contact No</span><br>
					<input type="text" name="admin[contact_no]" value="<?= $admin->contact_no ?>">
				</label>
				<label><span>Email</span><br>
					<input type="text" name="admin[email]" value="<?= $this->session->flashdata('email') ? $this->session->flashdata('email') : $admin->email ?>">
					<div class="error"><?= $this->session->flashdata('error')?></div>
				</label>
				<button>Save</button>
			</form>
		</section>
	</div>
</body>
</html>