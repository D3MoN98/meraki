<section id="checkout_wrapper">
	<aside id="checkout_aside">
		<div>
			<div>
				<h2>Price Details</h2>
			</div>
			<div>
				<div>
					<span>Subtotal</span> 
					<span>$<?php 
			        $sum = 0;
			        foreach ($cart->result() as $key)
			            $sum += $key->qty*$key->price;
			        echo $sum;
			         ?></span>
				</div>
				<div>
					<span>Shipping and handling</span> <span>Free</span>
				</div>
				<div>
					<span>Total</span> 
					<span>$<?php 
			        $sum = 0;
			        foreach ($cart->result() as $key)
			            $sum += $key->qty*$key->price;
			        echo $sum;
			         ?></span>
				</div>
			</div>
		</div>
		
	</aside>
	<section id="checkout_body">
		<div>
			<div>
				<h2>Cart</h2>
				<button class="change cart_change">Change</button>
			</div>
			<div class="cart_option">
				<div id="checkout_cart_body">
					<?php if(count($cart->result()) == 0){ ?>
					<p>No items in your cart</p>
					<?php } foreach ($cart->result() as $key) { ?>
					<div class="cart_item">
						<div>
							<img src="<?= base_url('upload/').$key->img?>" alt="">
						</div>
						<div>
							<span><?= $key->name ?></span>
							<span><?= $this->action->join('sub_catagory.name as sub_catagory_name','product','sub_catagory','sub_catagory.sub_catagory_id = product.sub_catagory',['product_id' => $key->product_id])->row()->sub_catagory_name;?></span>
							<span>$<?= $key->price ?>, <?= $key->color ?>, <?= $key->size ?></span>
						</div>
						<div>
							<div>
								<button class="fas fa-minus" value="<?= $key->cart_id?>"></button>
								<input type="text" class="qty" value="<?= $key->qty?>">
								<button class="fas fa-plus" value="<?= $key->cart_id?>"></button>
							</div>
					        <button class="rmv" value="<?= $key->cart_id?>">Remove Item</button>
						</div>
					</div>
					<?php } ?>
				</div>
				<div>
					<?php if(count($cart->result()) != 0){ ?>
					<button class="continue">CONTINUE</button>
					<?php }else{ ?>
					<a href="<?= base_url('products')?>" class='save'>Go Shopping</a>
					<?php } ?>
				</div>
			</div>
		</div>
		<form action="<?= base_url('user/order')?>" id="order_form" method='post'>
			<div>
				<div>
					<h2>Address</h2>
					<button class="change location_change">Change</button>
				</div>
					<?php 
					if($location->num_rows() == 0){ ?>
						<a href="<?= base_url('user/profile')?>">Add new address</a>
					<?php } ?>
					<table class='location_option option'>
					<?php foreach ($location->result() as $key) { ?>
						<tr>
							<td>
								<label><input class="location" type="radio" value="<?= $key->location_id?>" name="order[location]"> 
									<span><?= $key->address?>, <?= $key->city?> - <?= $key->pincode?>, <?= $key->state_id?></span></label>
							<button class="location_btn">Delevry Here</button>
							</td>
						</tr>
						<?php } ?>
					</table>
			</div>
			<div>
				<div>
					<h2>Payment</h2>
				</div>
					<table class='payment_option option'>
						<tr>
							<td>
								<label><input class="payment" type="radio" value="cod" name="order[payment]"> 
									<span>Cash On Delevery</span></label>
									<button class="payment_btn">Confrim Order</button>
							</td>
							<td>
								<label><input class="payment" type="radio" value="credit_card" name="order[payment]"> 
									<span>Credit Card</span></label>
									<button class="payment_btn">Confrim Order</button>
							</td>
							<td>
								<label><input class="payment" type="radio" value="paypal" name="order[payment]"> 
									<span>Paypal</span></label>
									<button class="payment_btn">Confrim Order</button>
							</td>
							<td>
								<label><input class="payment" type="radio" value="net_banking" name="order[payment]"> 
									<span>Net Banking</span></label>
									<button class="payment_btn">Confrim Order</button>
							</td>
						</tr>
					</table>
			</div>
		</form>
	</section>
</section>