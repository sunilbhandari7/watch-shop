<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Shop - Homepage</title>

   
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mens.css">
    <link rel="stylesheet" href="css/ladies.css">
    <link rel="stylesheet" href="css/unisex.css">
    <link rel="stylesheet" href="css/watch-detail.css">
    <link rel="stylesheet" href="css/watch-list.css">
</head>
<?php
// Assuming $con is your database connection
if (isset($_SESSION['username'])) {
    $cust_id = $_SESSION['id'];
    $query = "SELECT * FROM cart WHERE user_id=$cust_id";
    $run = mysqli_query($con, $query);

    if ($run) {
        $count = mysqli_num_rows($run);
    } else {
        // Handle query execution failure
        echo "Error: " . mysqli_error($con);
        $count = 0;
    }
} else {
    $count = 0;
}
?>


<body>
    <header class="header">
        <div class="logoContent">
            <a href="#" class="logo"><img src="images/logoo.png " height= 50px width=80px alt=""></a>
            <h1 class="logoName"> </h1>
        
        </div>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="our-product.php">Our Product</a>
            <a href="contact-us.php">Contact Us</a>
            <a href="about-us.php">About Us</a>
            <?php if (!isset($_SESSION['username'])) {


?>
            <a href="user-signup.php">Sign Up</a>
            <a href="user-login.php">Log In</a>
            <?php
            }

            if (isset($_SESSION['username'])) {


            ?>
                <a href="<?php echo SITEURL; ?>customer/index.php">User Account</a>
            <?php }
            ?>
            
        </nav>
        <form class="search" action="<?php echo SITEURL; ?>watch-search.php" method="POST">
        <div class="search">

            <input width="20px" height="20px" type="text" name="search" id="searchBar" placeholder="Search for Watch">
            <img src="images/searchicon.png" alt="">
        </div>
</form>
<a href="cart.php" class="">
        <div class="add-to-cart" > <img width="30px" height="30px" src ="images/addtocart.png"> </div>
        <span><?php echo $count; ?></span>
            </a>
 
    </header>
   
   