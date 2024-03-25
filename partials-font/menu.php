<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Shop - Homepage</title>

   
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mens.css">
    <link rel="stylesheet" href="ladies.css">
    <link rel="stylesheet" href="unisex.css">
    <link rel="stylesheet" href="css/watch-detail.css">
</head>

<body>
    <header class="header">
        <div class="logoContent">
            <a href="#" class="logo"><img src="" alt=""></a>
            <h1 class="logoName">Watch Shop </h1>
        
        </div>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="our-product.php">Our Product</a>
            <a href="user-signup.php">Sign Up</a>
            <a href="user-login.php">Log In</a>
            <a href="contact-us.php">Contact Us</a>
            <a href="about-us.php">About Us</a>
        </nav>
        <form class="search" action="<?php echo SITEURL; ?>watch-search.php" method="POST">
        <div class="search">

            <input width="20px" height="20px" type="text" name="search" id="searchBar" placeholder="Search for Watch">
            <img src="images/searchicon.png" alt="">
        </div>
</form>
        <div class="add-to-cart" > <img width="30px" height="30px" src ="images/addtocart.png"> </div>
 
    </header>
   
   