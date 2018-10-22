<div id="container">
	<aside id="catagory">
		<ul type="none" class="catagory">
            <h2>Catagories</h2>
            <li><a class="dropdown_container_list" href="javascript:void(0);" data-value='all'>ALL</a></li>
            <li>
                <a id="clothes" href="javascript:void(0);">CLOTHES</a>
                 <div class="dropdown_container clothes">
                    <a class="dropdown_container_list" href="javascript:void(0);" data-value='clothes'>All</a>
                 <?php foreach ($sub_catagory_clothes as $key) { ?>
                    <a class="dropdown_container_list" href="javascript:void(0);" data-value='<?= $key->sub_catagory_id?>'><?= $key->name?></a>
                 <?php } ?>
                  </div>
            </li>
            <li>
                <a id="accessories" href="javascript:void(0);">ACCESSORIES</a>
                <div class="dropdown_container accessories">
                    <a class="dropdown_container_list" href="javascript:void(0);" data-value='accessories'>All</a>
                    <?php foreach ($sub_catagory_accessories as $key) { ?>
                    <a class="dropdown_container_list" href="javascript:void(0);" data-value='<?= $key->sub_catagory_id?>'><?= $key->name?></a>
                    <?php } ?>
                  </div>
            </li>
        </ul>
        <ul type="none" class="catagory gender">
            <h2>Genders</h2>
            <li><a href="">Male</a></li>
            <li><a href="">Female</a></li>
            <li><a href="">Unisex</a></li>
        </ul>
        <ul type="none" class="catagory size">
            <h2>Sizes</h2>
            <select name="" id="">
                <option value="">Select</option>
                <option value="">XS</option>
                <option value="">S</option>
                <option value="">M</option>
                <option value="">L</option>
                <option value="">XL</option>
                <option value="">2XL</option>
                <option value="">3XL</option>
            </select>
        </ul>
	</aside>
	<section id="products">
        <?php if(count($products) == 0){ ?>
            <p>No results found</p>
		<?php } foreach ($products as $key) {?>
	        <figure class="products ">
	            <a href="<?= base_url('product/').$key->product_id?>"><img src="<?php echo base_url('upload/').$key->img?>">
	            <figcaption>
	                <p class="product-title"><?= $key->name ?></p>
	                <p class="product-price"><?= '$'.$key->price ?></p>
	            </figcaption></a>
                <?php if($key->qty == 0){ ?>
                    <div class="loader_container">
                        <span class="out_of_stock">Out of stock</span>
                    </div>
                <?php } ?>
	       </figure>
		<?php } ?>
    </section>
</div>