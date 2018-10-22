<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width">
    <title>Seller</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/seller.css'); ?>">    
    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/js/seller.js')?>"></script>
</head>
<body>
    <header>
        <button class="fas fa-bars"></button>
        <p><?= $seller->name ?></p>
        <form action="">
            <input type="text" placeholder="Search....">
            <button id="search"><i class="fas fa-search"></i></button>
        </form>
        <nav>
            <ul>
                <li><button id="notification" class="fas fa-bell"></button></li>
                <li><button id="message"  class="fas fa-envelope"></button></li>
                <li><button id="profile" class="fas fa-user-circle"></button>
                    <div id='myDropdown' class='dropdown_content'>
                        <a id="my_profile_link" href="<?= base_url('seller/profile')?>">My Profile</a><br>
                        <a href="<?= base_url('seller/sign_out')?>">Sign Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>