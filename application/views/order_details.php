<section id="order_details_container">
	<h2>Order Details</h2>
	<div>
		<span>Ordered on <?= $order->order_date?></span>
		<span>Order # <?= $order->order_id?></span>
		<a href="<?= base_url('invoice/').$order->order_id?>">Invoice</a>
	</div>
	<div>
		<div>
			<h4>Delivery Address</h4>
			<p><?= $order->location?></p>
		</div>
		<div>
			<h4>Payment Method</h4>
			<p><?= $order->payment?></p>
		</div>
		<div>
			<h4>Order Summary</h4>
			<p><span><span>Item(s) Subtotal:</span> <span>$<?= $total_price ?></span></span></p>
			<p><span><span>Shipping:</span> <span>Free</span></sppan></p>
			<p><span>Grand Total:</span> <span>$<?= $total_price ?></span></p>
		</div>
	</div>
	<?php foreach ($order_details as $key) { 
		$products = $this->action->get('product', ['product_id' => $key->product_id])->row();
		?>
	<div class="order">
		<div>
			<img src="<?= base_url('upload/').$products->img?>" alt="">
		</div>
		<div>
			<span><a href="<?= base_url('product/').$products->product_id?>"><?= $products->name?></a></span>
			<span>$<?= $products->price?>, qty- <?= $key->qty?></span>
			<span>Sold by: Cloudtail India</span>
		</div>
		<?php if($key->status == 0 && $order->is_cancel == 0){ ?>
		<div>
			<span>Arriving soon</span>
			<span>Your item has been not delivered yet</span>
		</div>
		<?php } elseif($order->is_cancel == 1){ ?>
		<div>
			<span>Your order is canceled</span>
		</div>
		<?php } else{ ?>
		<div>
			<span>Delivered on <?= $key->delivered_date?></span>
			<span>Your item has been delivered</span>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</section>