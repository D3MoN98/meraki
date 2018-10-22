<?php if(isset($user)){ ?>
<section id="edit_container">
	<p>Edit</p>
	<form action="<?= base_url('admin/edit_action/user/').$user->user_id?>" method="post">
		<span class="fas fa-times"></span>
		<input type="text" id="name" name="user[name]" placeholder="Name" value="<?= isset($user) ? $user->name : ''?>"><br><span class="error"></span>
		<input type="text" id="contact_no" name="user[contact_no]" placeholder="Contact No" value="<?= isset($user) ? $user->contact_no : ''?>"><br><span class="error"></span>
		<input type="text" id="email" name="user[email]" placeholder="Email Address" value="<?= isset($user) ? $user->email : ''?>"><br><span class="error"></span>
		<button>Save</button>
	</form>
</section>
<?php } ?>
<?php if(isset($seller)){ ?>
<section id="edit_container">
	<p>Edit</p>
	<form action="<?= base_url('admin/edit_action/seller/').$seller->seller_id?>" method="post">
		<span class="fas fa-times"></span>
		<input type="text" id="name" name="seller[name]" placeholder="Name" value="<?= isset($seller) ? $seller->name : ''?>"><br><span class="error"></span>
		<input type="text" id="contact_no" name="seller[contact_no]" placeholder="Contact No" value="<?= isset($seller) ? $seller->contact_no : ''?>"><br><span class="error"></span>
		<input type="text" id="email" name="seller[email]" placeholder="Email Address" value="<?= isset($seller) ? $seller->email : ''?>"><br><span class="error"></span>
		<button>Save</button>
	</form>
</section>
<?php } ?>