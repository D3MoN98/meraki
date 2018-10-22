<section id="order_history_container">
	<h2>Your Orders</h2>
	<!-- <nav>
		<ul>
			<li><a class="active_nav" href="">Orders</a></li>
			<li><a href="">Active Orders</a></li>
			<li><a href="">Cancelled Orders</a></li>
		</ul>
	</nav> -->
	<div id="order_history_body">
		<?php foreach ($order as $key) { ?>
		<div class="orders">
			<div>
				<a href="<?= base_url('order_details/').$key->order_id?>" class="order_details_btn" >#<?= $key->order_id ?></a>
				<?php if($key->is_cancel == 0 && $key->status == 0){ ?>
				<button class="cancel cancel_order_btn" value="<?= $key->order_id ?>">Cancel order</button>
				<?php } ?>
			</div>
			<?php 
			$order_details = $this->action->get('order_details',['order_id' => $key->order_id])->result();
			$total_price = 0;
			foreach ($order_details as $key2) { 
				$product = $this->action->get('product',['product_id' => $key2->product_id])->row();
				$total_price += $key2->price*$key2->qty;
				?>
			<div class="order">
				<div>
					<img src="<?= base_url('upload/'). $product->img?>" alt="">
				</div>
				<div>
					<span><a href="<?= base_url('product/').$key2->product_id?>"><?= $product->name ?></a></span>
					<span>$<?= $key2->price?>, quatity <?= $key2->qty?> </span>
					<span>Sold by: Cloudtail India</span>
				</div>
				<?php if($key2->status != 0){ ?>
				<div>
					<span>Delivered on <?= $key2->delivered_date?></span>
					<span>Your item has been delivered</span>
				</div>
				<?php } elseif($key->is_cancel ==1){ ?>
				<div>
					<span>Your order is cancelled</span>
				</div>
				<?php } else { ?>
				<div>
					<span>Arriving soon</span> 
					<span>Your item has been not delivered yet</span>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="order_footer">
				<span>Ordered On <?= $key->order_date?></span>
				<span>Order Total $<?= $total_price?></span>
			</div>
		</div>
		<?php }
		if(count($order) == 0){ ?>
			<div class="no_order">
				<p>No orders found</p>
			</div>
		<?php } ?>
	</div>
</section>
<section id="order_cancel_modal" class="hide">
	<section>
		<p>Order Cancellation <i class="fa fa-times"></i></p>
		<span>We will try our best to review your request</span>			
		<div>
			<a href="<?= base_url('user/cancel_order')?>" class="save">Request Cancellation</a>
			<button class="cancel">Close</button>
		</div>
	</section>
</section>