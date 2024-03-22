<?php include('config/constants.php'); ?>
<?php include('partials-font/menu.php'); ?>



<?php
//check whether id is passed 
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql3 = "SELECT title FROM tbl_product WHERE id=$category_id";
    $res3 = mysqli_query($con, $sql3);
    $count3 = mysqli_fetch_assoc($res3);
    $category_title = $count3['title'];
} else {
    header('Location:' . SITEURL);
    exit; // Exit after redirection
}

?>
<h2 style="text-align:center; margin:10px;">Available&nbsp;<span style="color:#fb5607;">"<?php echo $category_title; ?>"</span></h2>

<div class="mens-type">
    <?php
    //based on selected category
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
                    //check img available
                    if ($image_name == '') {
                        echo "<div class='error'>Image not available</div>";
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
                    <a href="<?php echo SITEURL;  ?>order.php?watch_id=<?php echo $id; ?>" class="buy">buy</a>
                    <a href="category-watch.php?cart_id=<?php echo $id; ?>&category_id=<?php echo $category_id; ?>" class="add-to-cart js-add-to-cart" onclick="a()">add to cart</a>
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