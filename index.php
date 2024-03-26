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
            header('location:index.php');
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
    
<section class="home" id="home">

        <div class="homeContent">
            
            <div class="home-btn">
                
            </div>
        </div>
    </section>
        <div class="heading">
            <h2>Shop By Category</h2>
           
        </div>
        <div class="product-main">
        <?php
  $sql = "SELECT * FROM tbl_product WHERE active='Yes' AND featured='Yes'  LIMIT 3";
  $res = mysqli_query($con, $sql);
  $count = mysqli_num_rows($res);
  if ($count > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      $id = $row['id'];
      $title = $row['title'];
      $image_name = $row['image_name'];
  ?>
       <div class="product-detail">
            <a class="category-info" href="<?php SITEURL; ?>category-watch.php?category_id=<?php echo $id; ?>">
          <?php
          if ($image_name == '') {
            echo "<div class='error'>Image not available</div>";
          } else {
            //img available
          ?>
            <img class="category-img" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?> " alt="">
          <?php
          }
          ?>
       
              
                <h1><?php echo $title; ?></h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed quidem similique, ut dolorum, id magnam hic, dolores </p>
                <a class="category-seemore"  href="<?php SITEURL; ?>category-watch.php?category_id=<?php echo $id; ?>">See More..</a>
            </a>
        </div>
        <?php
    }
  } else {
    echo "<div class='error'> Category not available</div>";
  }
  ?>
    </div>
  
    <?php include('partials-font/footer.php'); ?>