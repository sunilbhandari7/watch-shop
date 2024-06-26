<?php include('config/constants.php'); ?>
<?php include('partials-font/menu.php'); ?>

<?php
if (isset($_SESSION['username'])) {
    if (isset($_SESSION['id'])) {
        $custid = $_SESSION['id'];

        if (isset($_GET['cart_id'])) {
            $p_id = $_GET['cart_id'];
            $category_id = $_GET['category_id'];

            $sel_cart = "SELECT * FROM cart WHERE user_id = $custid AND product_id = $p_id";
            $run_cart = mysqli_query($con, $sel_cart);

            if ($run_cart) {
                if (mysqli_num_rows($run_cart) == 0) {
                    $cart_query = "INSERT INTO `cart`(`user_id`, `product_id`, quantity) VALUES ($custid, $p_id, 1)";
                    if (mysqli_query($con, $cart_query)) {
                        header('location: category-watch.php?category_id=' . $category_id);
                        exit;
                    }
                } else {
                    while ($row = mysqli_fetch_array($run_cart)) {
                        $exist_pro_id = $row['product_id'];
                        if ($p_id == $exist_pro_id) {
                            echo "<script>alert('⚠️ This product is already in your cart');</script>";
                        }
                    }
                }
            } else {
                echo "Error executing query: " . mysqli_error($con);
            }
        }
    } else {
        echo "Warning: 'id' session variable is not set";
    }
} else {
    echo "<script>alert('⚠️ Login is required');</script>";
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql3 = "SELECT title FROM tbl_product WHERE id=$category_id";
    $res3 = mysqli_query($con, $sql3);
    $row3 = mysqli_fetch_assoc($res3);
    $category_title = $row3['title'];
} else {
    header('Location:' . SITEURL);
    exit;
}
?>

<h2 style="text-align:center; margin:10px;">Available&nbsp;<span style="color:#fb5607;">"<?php echo $category_title; ?>"</span></h2>

<div class="mens-type">
    <?php
    $sql2 = "SELECT * FROM tbl_watch WHERE category_id=$category_id";
    $res2 = mysqli_query($con, $sql2);
    $count2 = mysqli_num_rows($res2);
    if ($count2 > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
    ?>
            <div class="mens-info">
                <div class="mens-picture">
                    <?php
                    if ($image_name == '') {
                        echo "<div class='error'>Image not available</div>";
                    } else {
                    ?>
                        <a href="<?php echo SITEURL; ?>watch-detail.php?image_id=<?php echo $id; ?>&category_id=<?php echo $category_id; ?>">
                            <img src="<?php echo SITEURL; ?>images/watch/<?php echo $image_name; ?>" alt="" />
                        </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="mens-description">
                    <p class="mens-name"><?php echo $title; ?></p>
                    <p class="mens-price">Rs.<?php echo $price; ?></p>
                    <a href="<?php echo SITEURL; ?>order.php?watch_id=<?php echo $id; ?>" class="buy js-buy">Buy</a>
                    
                    <a href="category-watch.php?cart_id=<?php echo $id; ?>&category_id=<?php echo $category_id; ?>" class="add-to-cart js-add-to-cart" onclick="a()">Add to Cart</a>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<div class='error'> Watch Not available</div>";
    }
    ?>
</div>

<?php include('partials-font/footer.php'); ?>
