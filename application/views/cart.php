<?php if(count($product->result()) != 0){ ?>
<div>
    <i class="fa fa-times"></i>
    <p>YOUR CART</p>
    <span>
        $<?php 
        $sum = 0;
        foreach ($product->result() as $key)
            $sum += $key->qty*$key->price;
        echo $sum;
         ?>
    </span>
    <a href="<?= base_url('checkout')?>">CHECKOUT</a>
</div>
<?php foreach ($product->result() as $key) { ?>
<div class="cart_product">
    <div><img src="<?= base_url('upload/').$key->img?>" alt=""></div>
    <div>
        <span><?= $key->name ?></span>
        <span><?= $this->action->join('sub_catagory.name as sub_catagory_name','product','sub_catagory','sub_catagory.sub_catagory_id = product.sub_catagory',['product_id' => $key->product_id])->row()->sub_catagory_name;?></span>
        <span>$<?= $key->price ?> <?= $key->color != '' ? ','.$key->color : '' ?> <?= $key->size != '0' ? $key->size : '' ?></span>
    </div>
    <div>
        <div>
            <button class="fas fa-minus" value="<?= $key->cart_id?>"></button><input type="text" class="qty" value="<?= $key->qty?>"><button class="fas fa-plus" value="<?= $key->cart_id?>"></button>
        </div>
        <button class="rmv" value="<?= $key->cart_id?>">Remove Item</button>
    </div>
</div>
<?php } ?>
<div id="cart_price">
    <div><span>Subtotal</span><span>$<?= $sum ?></span></div>
    <div><span>Shipping and handling</span><span>Free</span></div>
    <div><span>Total</span><span>$<?= $sum; ?></span></div>
</div>
<?php }
else{ ?>
<img width="350px" src="<?= base_url('assets/img/cart-empty.jpg')?>" alt="">
<?php } ?>
