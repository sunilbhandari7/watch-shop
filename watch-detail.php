<?php include('config/constants.php'); ?>
<?php include('partials-font/menu.php'); ?>
 <div class="main-detail">
  <?php
  if (isset($_GET['image_id'])) {
    $image_id = $_GET['image_id'];
    $sql = "SELECT * FROM tbl_watch WHERE id=$image_id";
    $res = mysqli_query($con, $sql);
    if ($res) {
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
  ?>
        <div class="detail-image">
          <?php
          if ($image_name == '') {
            echo "<div class='error'>Image not available</div>";
          } else {
          ?>
            <img src="<?php echo SITEURL; ?>images/watch/<?php echo $image_name; ?>" alt="" />
          <?php
          }
          ?>
        </div>
        <div class="detail-content">
          <h1><?php echo $title; ?></h1>
          <div class="star">
            <img src="images/star.png" alt="" />
            <span>(0 reviews)</span>
          </div>
          <p class="detail-desc">
            <?php echo $description; ?>
          </p>
          <h3 class="detail-price">Rs.<?php echo $price; ?></h3>
          <form method="post">
            
          Quantity:
            <div class="detail-quantity">
              
              <input type="number" name="qty" min="1" value="1" required>
            </div>
            <div class="detail-buy">
              <a href="<?php echo SITEURL;  ?>order.php?watch_id=<?php echo $id; ?>" class="buy-option" onclick="a()">Buy</a>
              <button class="addtocart-option" name="submit" type="submit"  onclick="a()">Add To Cart</button>
            </div>
          </form>
        </div>
  <?php
      } else {
        echo "<div class='error'> Watch Not available</div>";
      }
    } else {
      echo "Error executing query: " . mysqli_error($con);
    }
  } else {
    echo "Error: 'image_id' parameter is missing in the URL";
  }
  ?>
</div>

<h4 class='recommended-title'>Recommended For You:</h4>
<div class="mens-type">
  <?php

  if (isset($image_id)) {
    $sql2 = "SELECT * FROM tbl_watch WHERE active='YES' AND featured='YES' AND id NOT IN (SELECT id FROM tbl_watch WHERE id=$image_id) ORDER BY RAND() LIMIT 5";
    $res2 = mysqli_query($con, $sql2);

    // Check if $res2 is a valid result set
    if ($res2) {
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
              <a href="<?php echo SITEURL;  ?>order.php?watch_id=<?php echo $id; ?>" class="buy" onclick="a()">Buy</a>
              <a href="watch-detail.php?cart_id=<?php echo $id; ?>" class="add-to-cart" onclick="a()">Add to cart</a>
            </div>
          </div>
  <?php
        }
      } else {
        echo "<div class='error'> Watch Not available</div>";
      }
    } else {
      // Handle query execution failure
      echo "Error executing query: " . mysqli_error($con);
    }
  } else {
    echo "Error: 'image_id' is not defined";
  }
  ?>
</div>


<?php include('partials-font/footer.php'); ?>