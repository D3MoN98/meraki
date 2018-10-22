<section id="img_slidebar">
    <div class="mySlides fade">
        <a href="<?= base_url('product/23')?>">
          <img src="<?= base_url('assets/img/slideshow/')?>005.jpg">
        </a>
    </div>
    <div class="mySlides fade">
        <a href="<?= base_url('product/24')?>">
          <img src="<?= base_url('assets/img/slideshow/')?>001.jpg">
        </a>
    </div>
    <div class="mySlides fade">
        <a href="<?= base_url('product/26')?>">
          <img src="<?= base_url('assets/img/slideshow/')?>002.jpg">
        </a>
    </div>
    <div class="mySlides fade">
        <a href="<?= base_url('product/25')?>">
          <img src="<?= base_url('assets/img/slideshow/')?>003.jpg">
        </a>
    </div>
    <div class="mySlides fade">
        <a href="<?= base_url('products?keyword=music')?>">
          <img src="<?= base_url('assets/img/slideshow/')?>004.jpg">
        </a>
    </div>
    
    <div id="dot" style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span> 
      <span class="dot" onclick="currentSlide(2)"></span> 
      <span class="dot" onclick="currentSlide(3)"></span> 
      <span class="dot" onclick="currentSlide(4)"></span> 
      <span class="dot" onclick="currentSlide(5)"></span> 
    </div>
    <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a> -->
    <!-- <a class="next" onclick="plusSlides(1)">&#10095;</a> -->

    <div id="slideshow_btn">
        <button class="fa fa-chevron-left" aria-hidden="true" onclick="plusSlides(-1)"></button>
        <button class="fa fa-chevron-right" aria-hidden="true" onclick="plusSlides(1)"></button>
    </div>
</section>
<p id="product_header">Official merchandise by influencers, celebrities and independent artists</p>
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
        <!-- <ul type="none" class="catagory gender">
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
        </ul> -->
	</aside>
	<section id="products">
		<?php foreach ($products as $key) {?>
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
        <div>
            <button id="load_more" value="all">MORE RESULTS <i class="fas fa-angle-double-right"></i></button>
        </div>
        
    </section>
</div>