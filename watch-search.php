<?php include('config/constants.php'); ?>
<?php include('partials-font/menu.php'); ?>


<div class="wallpaper">
    <img class="wallpaper-img" src="images/asd.jpg" alt="" width="100%" height="30%" />
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
<?php include('partials-font/footer.php'); ?>