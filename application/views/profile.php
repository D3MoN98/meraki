<div id="profile_container">
	<aside>
		<div id="myprofile_pic">
			<i class="fas fa-camera"></i>
			<img src="<?= $user->profile_pic ?>" alt="">
			<p><?= $user->name?></p>
		</div>
		<nav>
			<ul>
				<li><button class="profile_nav" value="profile">My Profile</button></li><hr>
				<li><button class="profile_nav" value="address">My Address</button></li><hr>
				<li><button class="profile_nav" value="security">Change Password</button></li><hr>
				<li><button class="profile_nav" value="order">My Orders</button></li>
			</ul>
		</nav>
	</aside>
	<section id="profile_body">
		<p>My Profile <i class="fas fa-pencil-alt"></i></p>
		<form id="my_profile_form" action="<?= base_url('user/edit_profile/').$user->user_id?>" method="post">
			<label><span>Name </span> <br>
				<input type="text" name="user[name]" value="<?= $user->name ?>">
			</label>
			<label><span>Date of Birth</span><br>
				<input type="date" name="user[dob]" value="<?= $user->dob ?>">
			</label>
			<label><span>Gender</span><br>
				<label><input type="radio" name="user[gender]" value="male" <?= $user->gender == 'male' ? "checked=''" : '' ?>> <span>Male</span></label>
				<label><input type="radio" name="user[gender]" value="female" <?= $user->gender == 'female' ? "checked=''" : '' ?>> <span>Female</span></label>
			</label>
			<label><span>Contact No</span><br>
				<input type="text" name="user[contact_no]" value="<?= $user->contact_no ?>">
			</label>
			<label><span>Email</span><br>
				<input type="text" name="user[email]" value="<?= $this->session->flashdata('email') ? $this->session->flashdata('email') : $user->email ?>">
				<div class="error"><?= $this->session->flashdata('error')?></div>
			</label>
			<button class="save">Save</button>
			<button class="cancel">cancel</button>
		</form>
	</section>
</div>
<section id="modal_2">
	<section id="modal_2_1">
        <i class="fas fa-times"></i> 
	    <form action="<?= base_url('user/update_profile_pic')?>" method='post' enctype="multipart/form-data">
	    	<p>Change Profile Picture</p>
    		<input type="file" name="user_img">
    		<button class="save">Save</button>
	    </form>
	</section>
</section>