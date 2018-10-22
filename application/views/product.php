<div id="product_container">
	<aside id="product_display">
		<div id="pc1">
			<h2><?= $product->name ?></h2>
			<div id="product_images">
				<div id="side_image">
					<div><button class="product_img" value="<?= base_url('upload/').$product->img?>"><img src="<?= base_url('upload/').$product->img?>"></button></div>
					<?php foreach ($product_imgs as $key) { ?>
					<div><button class="product_imgs" value="<?= $key->pr_imgs_id?>"><img src="<?= base_url('upload/').$key->imgs?>"></button></div>
					<?php } ?>
				</div>
				<div id="product_image">
					<img src="<?= base_url('upload/').$product->img?>">
				<?php if($product->qty == 0){ ?>
					<div class="loader_container">
				        <span class="out_of_stock">Out of stock</span>
				    </div>
				<?php } ?>
				</div>
			</div>
		</div>
	</aside>
	<section id="product_details">
		<p><?= '$'.$product->price?> <span>(<s><?= '$'.$product->mrp?></s>)</span> <span><?= round(100 - $product->price*100/$product->mrp).'% off'?></span></p>
		<p>
			<span>
				<i class="fas fa-star <?= $rating >= 1 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $rating >= 2 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $rating >= 3 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $rating >= 4 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $rating == 5 ? 'active_star' : ''?>"></i>
			</span>
			<span><?= count($review)?> Customer reviews</span>
		</p>
		<p><?= $product->desc ?></p>
		<?php if($product->size != ''){ ?>
		<div id="product_size">
			<div>
				<p>Size</p>
				<a href="">size chart</a>
			</div>
			<select>
				<option value="">Select size</option>
				<?php foreach(explode(',', $product->size) as $key => $value){?>
				<option value="<?= $value?>"><?= $value?></option>
				<?php } ?>
			</select>
			<span class="popuptext" id="select_size_popup">Select a size</span>
		</div>
		<?php }else{ ?>
		<div></div>
		<?php } ?>
		<?php if($product->qty>0){ ?>
		<div>
			<button  id="buy_now" value="<?= $product->product_id?>">BUY NOW</button>
			<button id="add_to_cart" value="<?= $product->product_id?>">ADD TO CART</button>
		</div>
		<?php } else{ ?>
		<div></div>
		<?php } ?>
		<div><i class="fas fa-gift"></i> Available as a gift</div>
		<div>
			<i class="fas fa-plane-departure"></i> Shipping starts on September 24. Available until September 7.
		</div>
		<div>
			<?= $product_sold == '' ? 0 : $product_sold?> items sold 
		</div>
	</section>
	<section id="extra_product">
		<p>ALSO AVAILABLE ITEMS</p>
		<div>
			<?php foreach ($extra_product as $key) { ?>
			<div>
				<a href="<?= base_url('product/').$key->product_id?>"><img src="<?= base_url('upload/').$key->img?>"><?=  $key->name ?>
				</a>
			</div>
			<?php } ?>
		</div>
	</section>
	<section id="reviews">
		<p>REVIEWS AND RATINGS</p>
		<button id="rate_btn">Rate This Product</button>
		<form action="<?= base_url('user/review/').$product->product_id ?>" method='post'>
			<div id="star_rating">
			    <label>
			    	<i class="fas fa-star"></i>
				    <input class="star" type="radio" value="1" name='review[rate]'>
			    </label>
			    <label>
			    	<i class="fas fa-star"></i>
				    <input class="star" type="radio" value="2" name='review[rate]'>
			    </label>
			    <label>
			    	<i class="fas fa-star"></i>
				    <input class="star" type="radio" value="3" name='review[rate]'>
			    </label>
			    <label>
			    	<i class="fas fa-star"></i>
				    <input class="star" type="radio" value="4" name='review[rate]'>
			    </label>
			    <label>
			    	<i class="fas fa-star"></i>
				    <input class="star" type="radio" value="5" name='review[rate]'>
			    </label>
			</div>
			<span>Title</span>
			<input type="text" name='review[title]' required>
			<span>Description</span>
			<textarea id="" cols="30" rows="5" name='review[desc]' required></textarea>
			<button class="save">Submit</button>
			<button class="cancel">Cancel</button>
		</form>
		<?php if(count($review) == 0){ ?>
			<div><p style="padding: 15px;letter-spacing: 2px;">No reviews yet</p></div>
		<?php } ?>
		<?php foreach ($review as $key) { ?>
		<div class="reviews">
			<span><span>
				<i class="fas fa-star <?= $key->rate >= 1 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $key->rate >= 2 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $key->rate >= 3 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $key->rate >= 4 ? 'active_star' : ''?>"></i>
				<i class="fas fa-star <?= $key->rate == 5 ? 'active_star' : ''?>"></i>
			</span> <span><?= $key->title ?></span></span>
			<p><?= $key->desc ?></p>
			<div>
				<span><?= $this->action->join('name','user','review','user.user_id=review.user_id',['review_id' => $key->review_id])->row()->name?></span> <span><i class="fas fa-check-circle"></i> Certified Buyer 
				<?= $this->action->join('order_date','order','review','order.user_id=review.user_id',['review_id' => $key->review_id,'product_id' => $key->product_id])->row()->order_date?></span>
				<!-- <div>
					<span><button class="fas fa-thumbs-up" value='<?= $key->review_id?>'></button> <span class="likes"><?= $key->like?></span></span> 
					<span><button class="fas fa-thumbs-down" value='<?= $key->review_id?>'></button> <?= $key->dislike?></span> 
				</div> -->
			</div>
		</div>
		<?php } ?>
	</section>
</div>
