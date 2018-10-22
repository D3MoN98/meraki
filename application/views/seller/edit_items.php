<div id="main_body">
	<form id="add_items_form" action="<?= base_url('seller/update_items_action/').$product->product_id?>" method="post" enctype="multipart/form-data">
			<p>Add New Product</p>
			<div id="edt1">
				<img src="<?= base_url('upload/').$product->img?>" alt="">
				<div>
					<div>
						<button class="add_img">+</button>
					</div>
					<?php foreach ($product_imgs as $key) { ?>
					<div>
						<img src="<?= base_url('upload/').$key->imgs?>">
					</div>
					<?php } ?>
				</div>
			</div>

			<div id="edt2">
				<label><span>Product Name*</span> <br>
					<input type="text" name="product[name]" required value="<?= $product->name?>">
				</label>
				<label><span>Product Description</span> <br>
					<textarea name="product[desc]" id="" cols="30" rows="10"><?= $product->desc?>
					</textarea>
				</label>
				<label><span>Product Catagory*</span> <br>
					<select name="product[catagory]" id="catagory" required>
						<option value="">Select</option>
						<?php foreach ($catagory as $key) {
						?>
						<option value="<?= $key->catagory_id?>" <?= $product->catagory == $key->catagory_id ? "selected='selected'" : '' ?>><?= $key->name?></option>
						<?php } ?>
					</select>
				</label>
				<label><span>Product Sub-catagory*</span> <br>
					<select name="product[sub_catagory]" id="sub_catagory" required>
						<?php foreach ($sub_catagory as $key) {
						?>
						<option value="<?= $key->sub_catagory_id?>" <?= $product->sub_catagory == $key->sub_catagory_id ? "selected='selected'" : '' ?>><?= $key->name?></option>
						<?php } ?>
					</select>
				</label>
				<div class="size show" id="cloth_size"><span>Product Size</span>
					<label>
						<input type="checkbox" value="F" <?= in_array('F', explode(',',$product->size)) ? 'checked' : '' ?> name="product[size][]"> F
					</label>
					<label><input type="checkbox" value="S" <?= in_array('S', explode(',',$product->size)) ? 'checked' : '' ?> name="product[size][]"> S
					</label>
					<label><input type="checkbox" value="M" <?= in_array('M', explode(',',$product->size)) ? 'checked' : ''?> name="product[size][]"> M
					</label>
					<label><input type="checkbox" value="L" <?= in_array('L', explode(',',$product->size)) ? 'checked' : ''?> name="product[size][]"> L
					</label>
					<label><input type="checkbox" value="XL" <?= in_array('XL', explode(',',$product->size)) ? 'checked' : ''?> name="product[size][]"> XL
					</label>
					<label>
						<input type="checkbox" value="2XL" <?= in_array('2XL', explode(',',$product->size)) ? 'checked' : '' ?> name="product[size][]"> 2XL
					</label>
					<label><input type="checkbox" value="3XL" <?= in_array('3XL', explode(',',$product->size)) ? 'checked' : '' ?> name="product[size][]"> 3XL
					</label>
					<label><input type="checkbox" value="4XL" <?= in_array('4XL', explode(',',$product->size)) ? 'checked' : '' ?> name="product[size][]"> 4XL
					</label>
					<label><input type="checkbox" value="5XL" <?= in_array('5XL', explode(',',$product->size)) ? 'checked' : '' ?> name="product[size][]"> 5XL
					</label>
				</div>
				<label><span>Product Color</span> <br>
					<input type="text" name="product[color]" value="<?= $product->color?>">
				</label>
				<label><span>Product Gender</span> <br>
					<select name="product[gender]" id="gender">
						<option value="">Select</option>
						<option value="male" <?= $product->gender == 'male' ? "selected='selected'" : '' ?>>Male</option>
						<option value="female" <?= $product->gender == 'female' ? "selected='selected'" : '' ?>>Female</option>
						<option value="unisex" <?= $product->gender == 'unisex' ? "selected='selected'" : '' ?>>Unisex</option>
					</select>
				</label>
				<label><span>Product Quantity*</span> <br>
					<input type="number" name="product[qty]" min="1" required value="<?= $product->qty?>">
				</label>
				<label><span>Tags</span> <br>
					<input type="text" name="product[tags]" value="<?= $product->tags?>">
				</label>
				<label><span>Price</span> <br>
					<input type="text" name="product[price]" value="<?= $product->price?>">
				</label>
				<label><span>Mrp</span> <br>
					<input type="text" name="product[mrp]" value="<?= $product->mrp?>">
				</label>
				<label><span>Product Image*</span> <br>
					<input type="hidden" name="old_img" value="<?= $product->img?>" >
					<input type="file" name="product_img">
				</label>
				<div>
					<button>Save</button>
					<a href="<?= base_url('seller')?>">Cancel</a>
				</div>
			</div>
	</form>
</div><section id="add_img_modal">
	<section id="modal_2_1">
        <i class="fas fa-times"></i> 
	    <form action="<?= base_url('seller/multiple_img/').$product->product_id?>" method='post' enctype="multipart/form-data">
	    	<p>Change Profile Picture</p>
    		<input type="file" name="multiple_img[]" multiple>
    		<button class="save">Save</button>
	    </form>
	</section>
</section>