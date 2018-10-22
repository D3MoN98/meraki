<?php $user =  $this->db->get_where('user',['user_id' => $this->session->userdata('user_id')])->row() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="<?= base_url('assets/meraki.ico')?>"> 
    <meta name="viewport" content="width=device-width">
    <title>meraki</title>
</head>
<body>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/master.css')?>">
<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script src="<?php echo base_url('assets/js/master.js')?>"></script>
<script src="<?php echo base_url('assets/js/slideshow.js')?>"></script>
<header>
    <button class="fas fa-bars"></button>
    <div>
        <a href="<?= base_url()?>"><h1>MERAKI</h1></a>
    </div>
    <div id="search">
        <form action="<?= base_url('products')?>" method='get'>
            <input type="search" placeholder="Search" name="keyword" value="<?= $this->session->flashdata('keyword')?>">
            <button><i class="fas fa-search"></i></button>
        </form>
    </div>
    <nav>
        <ul>
            <li><a href="<?php echo base_url()?>">Home</a></li>
            <li><a href="<?= base_url('products')?>">Products</a></li>
            <li>
                <?php if(!$this->session->userdata('user_id')){ ?>
                <a href="<?php echo base_url('sign_in')?>">Sign In</a>
                <?php } else{ ?>
                <button id='user' class='dropbtn'><?= $user->name; ?></button>
                <div id='myDropdown' class='dropdown_content'>
                    <a href='<?= base_url('user/profile')?>'>My Profile</a>
                    <a href='<?= base_url('order_history')?>'>My Order</a>
                    <a href="<?= base_url('user/sign_out')?>">Sign Out</a>
                </div>
                <?php } ?>
            </li>
            <li><button id="cart" class="fas fa-shopping-cart"></button></li>
        </ul>
    </nav>
</header>
<section id="cart_modal">
    
</section>
<div id="side_nav" class="side_nav">
    <i class="fa fa-times"></i>
    <?php if($this->session->userdata('user_id')){ ?>
    <p>Welcome, <?= $user->name; ?></p>
    <?php } ?>
    <a href="<?= base_url()?>">Home</a>
    <a href="<?= base_url('products')?>">Products</a>
    <?php if(!$this->session->userdata('user_id')){ ?>
    <a href="<?= base_url('sign_in')?>">Sign In</a>
    <?php } else{ ?>
    <a href="<?= base_url('user/profile')?>">My Profile</a>
    <a href="<?= base_url('order_history')?>">My Order</a>
    <a href="<?= base_url('user/sign_out')?>">Sign Out</a>
    <?php } ?>
</div>