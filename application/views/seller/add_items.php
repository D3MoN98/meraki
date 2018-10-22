<div id="main_body">
	<form id="add_items_form" action="<?= base_url('seller/add_items_action')?>" method="post" enctype="multipart/form-data">
			<p>Add New Product</p>
			<span class="error"><?= isset($error) ? $error : ''?></span>
			<label><span>Product Name*</span> <br>
				<input type="text" name="product[name]" required>
			</label>
			<label><span>Product Description</span> <br>
				<textarea name="product[desc]" id="" cols="30" rows="10"></textarea>
			</label>
			<label><span>Product Catagory*</span> <br>
				<select name="product[catagory]" id="catagory" required>
					<option value="">Select</option>
					<?php foreach ($catagory as $key) {
					?>
					<option value="<?= $key->catagory_id?>"><?= $key->name?></option>
					<?php } ?>
				</select>
			</label>
			<label><span>Product Sub-catagory*</span> <br>
				<select name="product[sub_catagory]" id="sub_catagory" required disabled>
					<option value="">Select</option>
				</select>
			</label>
			<div class="size" id="cloth_size"><span>Product Size</span>
				<label><input type="checkbox" value="F" name="product[size][]"> F</label>
				<label><input type="checkbox" value="S" name="product[size][]"> S</label>
				<label><input type="checkbox" value="M" name="product[size][]"> M</label>
				<label><input type="checkbox" value="L" name="product[size][]"> L</label>
				<label><input type="checkbox" value="XL" name="product[size][]"> XL</label>
				<label><input type="checkbox" value="2XL" name="product[size][]"> 2XL</label>
				<label><input type="checkbox" value="3XL" name="product[size][]"> 3XL</label>
				<label><input type="checkbox" value="4XL" name="product[size][]"> 4XL</label>
				<label><input type="checkbox" value="5XL" name="product[size][]"> 5XL</label>
			</div>
<!-- 			<div class="size" sty id="shoe_size"><span>Product Size</span>
				<label><input type="checkbox"> 7</label>
				<label><input type="checkbox"> 8</label>
				<label><input type="checkbox"> 9</label>
				<label><input type="checkbox"> 10</label>
			</div> -->
			<label><span>Product Color</span> <br>
				<input type="text" name="product[color]">
			</label>
			<label><span>Product Gender</span> <br>
				<select name="product[gender]" id="gender" disabled>
					<option value="">Select</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
					<option value="unisex">Unisex</option>
				</select>
			</label>
			<label><span>Product Quantity*</span> <br>
				<input type="number" name="product[qty]" value="1" min="1" required>
			</label>
			<label><span>Tags</span> <br>
				<input type="text" name="product[tags]">
			</label>
			<label><span>Price</span> <br>
				<input type="text" name="product[price]">
			</label>
			<label><span>Mrp</span> <br>
				<input type="text" name="product[mrp]">
			</label>
			<label><span>Product Image*</span> <br>
				<input type="file" name="product_img" required>
			</label>
			<div>
				<button>Save</button>
				<a href="<?= base_url('seller')?>">Cancel</a>
			</div>
	</form>
</div>