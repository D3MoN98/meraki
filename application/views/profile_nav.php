<?php if(isset($address)){ ?>
<p>Manage Address</p>
<button class="add_new_adr">+ Add New Address</button><br>
<span class="msg" <?= isset($addr_msg) ? 'style="display: block;"' : '' ?>><?= isset($addr_msg) ? $addr_msg : '' ?><i class="fas fa-times"></i></span><br>
<form id="add_address">
	<input type="hidden" value="<?= $user->user_id ?>">
	<label><span>Pincode </span> <br>
		<input type="text" name="location[pincode]">
	</label>
	<label><span>Address </span> <br>
		<textarea name="location[address]" cols="30" rows="5"></textarea>
	</label>
	<label><span>City </span> <br>
		<input type="text" name="location[city]">
	</label>
	<label><span>State </span> <br>
		<select name="location[state_id]" id="">
			<option value="">Select State</option>
			<?php foreach ($state as $key) { ?>
			<option value="<?= $key->state_id ?>"><?= $key->state_name ?></option>
			<?php } ?>
		</select>
	</label>
	<label><span>Landmark (optional) </span> <br>
		<input type="text" name="location[landmark]">
	</label>
	<button class="save">Save</button> <button class="cancel">Cancel</button>
</form>
<table id="address_table">
	<?php foreach ($location as $key) { ?>
	<tr>
		<td>
			<div>
				<?= $key->address ?>, <?= $key->city ?>, <?= $key->state_id ?> - <?= $key->pincode ?>
				<i class="fas fa-ellipsis-v"></i>
				<div class="dot_popup">
					<ul>
						<li><button class="edit">Edit</button></li>
						<li><button class="delete" value="<?= $key->location_id?>">Delete</button></li>
					</ul>
				</div>
			</div>
			<form class="edit_location_form">
				<input type="hidden" value="<?= $key->location_id ?>">
				<label><span>Pincode </span> <br>
					<input type="text" name="location[pincode]" value="<?= $key->pincode ?>">
				</label>
				<label><span>Address </span> <br>
					<textarea name="location[address]" cols="30" rows="5"><?= $key->address ?></textarea>
				</label>
				<label><span>City </span> <br>
					<input type="text" name="location[city]" value="<?= $key->city ?>">
				</label>
				<label><span>State </span> <br>
					<select name="location[state_id]" id="">
						<option value="">Select State</option>
						<?php foreach ($state as $key1) { ?>
						<option value="<?= $key1->state_id ?>" <?= $key1->state_id == $key->state_id ? "selected='selected'" : '' ?>><?= $key1->state_name ?></option>
						<?php } ?>
					</select>
				</label>
				<label><span>Landmark (optional) </span> <br>
					<input type="text" name="location[landmark]" value="<?= $key->landmark ?>">
				</label>
				<button class="save">Save</button> <button class="cancel">Cancel</button>
			</form>
		</td>
	</tr>
	<?php } ?>
</table>

<?php }else if(isset($profile)){ ?>

<p>My Profile <i class="fas fa-pencil-alt"></i></p>
<form id="my_profile_form" action="<?= base_url('user/edit_profile/').$user->user_id?>" method="post">

	<label><span>Name </span> <br>
		<input type="text" name="user[name]" value="<?= $user->name ?>" disabled>
	</label>
	<label><span>Date of Birth</span><br>
		<input type="date" name="user[dob]" value="<?= $user->dob ?>" disabled>
	</label>
	<label><span>Gender</span><br>
		<label><input type="radio" name="user[gender]" value="male" <?= $user->gender == 'male' ? "checked=''" : '' ?> disabled> <span>Male</span></label>
		<label><input type="radio" name="user[gender]" value="female" <?= $user->gender == 'female' ? "checked=''" : '' ?> disabled> <span>Female</span></label>
	</label>
	<label><span>Contact No</span><br>
		<input type="text" name="user[contact_no]" value="<?= $user->contact_no ?>" disabled>
	</label>
	<label><span>Email</span><br>
		<input type="text" name="user[email]" value="<?= $this->session->flashdata('email') ? $this->session->flashdata('email') : $user->email ?>" disabled>
		<div class="error"><?= $this->session->flashdata('error')?></div>
	</label>
	<button class="save">Save</button> <button class="cancel">Cancel</button>
</form>

<?php } else if(isset($security)){ ?>

<p>Change Password</p>
<form id="forget_password_form">
	<input type="hidden" value="<?= $user->user_id ?>">
	<span class="msg" <?= isset($pw_change) ? 'style="display: block;"' : '' ?>><?= isset($pw_change) ? $pw_change : 'sdsad' ?><i class="fas fa-times"></i></span><br>
	<label><span>Old Password </span> <br>
		<input type="password" name="password[old]">
		<span class="error"><?= isset($pw_error) ? $pw_error : '' ?></span>
	</label>
	<label><span>New Password </span> <br>
		<input type="password" name="password[new]">
	</label>
	<label><span>Confirm Password </span> <br>
		<input type="password" name="password[con]">
		<span class="error"><?= isset($pw_con_error) ? $pw_con_error : '' ?></span>
	</label>
	<button class="save">Save</button>
</from>
<?php } else if(isset($order)){ ?>
<h2>Order</h2>
<?php } ?>