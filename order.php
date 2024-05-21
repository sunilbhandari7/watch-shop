<?php ob_start(); ?>
<?php include('config/constants.php') ?>

<?php include('partials-font/menu.php') ?>

<link rel="stylesheet" href="css/buy.css">
<?php
if (isset($_SESSION['username'])) {
    // Check if 'id' session variable is set
    if (isset($_SESSION['id'])) {
        $custid = $_SESSION['id'];

        if (isset($_GET['watch_id'])) {
            //get the watch id
            $watch_id = $_GET['watch_id'];
            //get details of the selected watch
            $sql = "SELECT * FROM tbl_watch WHERE id = $watch_id";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            } else {

                echo "<script> function a(){alert('⚠️ Login is required to buy this product');}</script>";
                header("Location:" . SITEURL);
            }
        }
    }
} else {
    //redirect to home
    echo "<script> function a(){alert('⚠️ Login is required to buy this product');}</script>";
    header('Location:' . SITEURL);
}
?>


<div class="main">
    <form action="" method="post" class="order">
        <fieldset class="sunil1">
            <legend>Selected Watch</legend>
            <div class="selected-watch">
                <div class="selected-watch-img">
                    <?php
                    if ($image_name == "") {
                        //img not available
                        echo "<div class='error'>Image not available</div>";
                    } else {
                    ?>
                        <img src="<?php echo SITEURL; ?>/images/watch/<?php echo $image_name; ?>" alt="" class="selected-image" />
                    <?php

                    }

                    ?>

                </div>
                <div class="selected-watch-des">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="watch" value="<?php echo $title; ?>">
                    <p class="selected-watch-price">Rs.<?php echo $price ?></p>
                    <input type="hidden" name="price" value="<?php echo $price ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" min="1" value="1" required />

                </div>
            </div>
        </fieldset>
        <fieldset class="user-details sunil1">
            <?php
            $sql3 = "SELECT * FROM tbl_user WHERE id = $custid";
            $res3 = mysqli_query($con, $sql3);
            $count3 = mysqli_num_rows($res3);
            if ($count3 == 1) {
                $row3 = mysqli_fetch_array($res3);
                $name = $row3['full_name'];
                $phone = $row3['phone'];
                $email = $row3['email'];
                $address = $row3['address'];
            }
            ?>
            <legend>Delivery Details</legend>
            <div class="order-label">Full Name</div>
            <input type="text" name="full-name" value="<?php echo $name; ?>" placeholder="E.g. Sunil Bhandari" class="input-responsive" required />

            <div class="order-label">Phone Number</div>
            <input type="tel" name="contact" value="<?php echo $phone; ?>" placeholder="E.g. 9841xxxxxx" class="input-responsive" required />

            <div class="order-label">Email</div>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E.g. sunilbhandari@gmail.com" class="input-responsive" required />

            <div class="order-label">Address</div>
            <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required><?php echo $address; ?></textarea>

        </fieldset>

        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" />

    </form>
    <?php
    if (isset($_POST['submit'])) {
        //get all the details of the order
        $watch = $_POST['watch'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty; //
        $order_date = date("Y-m-d h:i:s"); // Current server time
        $nepali_date = gmdate("Y-m-d h:i:s", strtotime("+5 hours 45 minutes", strtotime($order_date))); // Adding 5 hours and 45 minutes to the server time to get Nepali time
        $status = "Ordered"; //
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];

        $sql2 = "INSERT INTO tbl_buy SET
        watch='$watch',
        price=$price,
        qty=$qty,
        total=$total,
        order_date='$nepali_date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address',
        customer_id=$custid,
        product_id=$id
        ";
        $res2 = mysqli_query($con, $sql2);
        if ($res2) {
            $_SESSION['order'] = "<div class='success text-center' style='text-align:center;color:green ;'>Watch Order Successfully It will be deliver after 7 working days.</div>";
            header("location:" . SITEURL."/customer/orders.php");
        } else {
            $_SESSION['order'] = "<div class='error' style='text-align:center;color:red;'>Failed to order Watch. " . mysqli_error($con) . "</div>";
            header("location:" . SITEURL );
        }
    } else {
    }
    ?>
</div>
<?php include('partials-font/footer.php') ?>
<?php ob_end_flush(); ?>
