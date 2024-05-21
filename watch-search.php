<?php include('config/constants.php'); ?>
<?php include('partials-font/menu.php'); ?>
<?php
// Start or resume the session

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Check if 'id' session variable is set
    if (isset($_SESSION['id'])) {
        $custid = $_SESSION['id'];

        if (isset($_GET['cart_id'])) {
            $p_id = $_GET['cart_id'];

            $sel_cart = "SELECT * FROM cart WHERE user_id = $custid AND product_id = $p_id";
            $run_cart = mysqli_query($con, $sel_cart);

            if ($run_cart) {
                if (mysqli_num_rows($run_cart) == 0) {
                    $cart_query = "INSERT INTO `cart`(`user_id`, `product_id`,quantity) VALUES ($custid,$p_id,1)";
                    if (mysqli_query($con, $cart_query)) {
                        header('location:watch-search.php');
                        exit; // Exit after redirection
                    }
                } else {
                    while ($row = mysqli_fetch_array($run_cart)) {
                        $exist_pro_id = $row['product_id'];
                        if ($p_id == $exist_pro_id) {
                            $error = "<script> alert('⚠️ This product is already in your cart  ');</script>";
                        }
                    }
                }
            } else {
                // Handle query execution failure
                echo "Error executing query: " . mysqli_error($con);
            }
        }
    } else {
        // Handle 'id' session variable not being set
        echo "Warning: 'id' session variable is not set";
    }
} else {
    echo "<script> function a(){alert('⚠️ Login is required to add this product into cart');}</script>";
}
?>

<div class="wallpaper">
    <img class="wallpaper-img" src="images/"  alt="" />
    <div class="sologon">
        <?php
        $search = isset($_POST['search']) ? mysqli_real_escape_string($con, $_POST['search']) : '';
        ?>

        <h2>Watch on Your Search <span style="color:#fb5607;">"<?php echo $search ?>"</span></h2>
    </div>
</div>
<div class=explore-div>
    <h3><a class="explore" href="">Watch Items</a></h3>
</div>
<div class="mens-type">
    <?php


    ////sql query to get food based on search

    $sql = "SELECT * FROM tbl_watch WHERE title LIKE '%$search%' OR description LIKE '%$search%'";


    //execute query
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
    ?>
            <div class="mens-info">
                <div class="mens-picture">
                    <?php
                    if ($image_name == '') {
                        echo "<div class='error'>Image not available.</div>";
                    } else {
                    ?>
                        <a href="<?php echo SITEURL; ?>watch-detail.php?image_id=<?php echo $id; ?>">
                            <img src="<?php echo SITEURL; ?>images/watch/<?php echo $image_name; ?>" alt="" />
                        </a>
                    <?php

                    }

                    ?>

                </div>
                <div class="mens-description">
                    <p class="mens-name"><?php echo $title; ?></p>
                    <p class="mens-price">Rs.<?php echo $price; ?></p>
                    <a href="<?php echo SITEURL;  ?>order.php?watch_id=<?php echo $id; ?>" onclick="a()" class="buy">buy</a>
                    <a href="watch-search.php?cart_id=<?php echo $id; ?>" class="add-to-cart js-add-to-cart" onclick="a()">add to cart</a>
                </div>
            </div>

    <?php

        }
    } else {
        echo "<div class='error'>Watch not found</div>";
    }
    ?>


</div>
