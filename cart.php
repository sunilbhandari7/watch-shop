<?php 
include('config/constants.php'); 
include('partials-font/menu.php'); 
?>
<link rel="stylesheet" href="css/cart.css">

<?php
if (isset($_SESSION['username'])) {
  $customer_id = $_SESSION['id'];

  // Delete Query
  if (isset($_GET['id'])) {
    $proid = $_GET['id'];
    $del_query = "DELETE FROM cart WHERE product_id = $proid and user_id = $customer_id";
    if (mysqli_query($con, $del_query)) {
      header("location:cart.php");
    }
  }
  // Cart Query
  $cart = "SELECT * FROM cart WHERE user_id='$customer_id'";
  $run = mysqli_query($con, $cart);

  $sub_total = 0;
  $shipping_cost = 0;
  $total = 0;
}
?>

<div class="cart-detail">
  <div class="cart-item">
    <h1>Shopping Cart</h1>
    <table class="cart-title">
      <th>Product Details</th>
      <th></th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total</th>
      <th>Actions</th>

      <?php
      if (mysqli_num_rows($run) > 0) {
        while ($cart_row = mysqli_fetch_array($run)) {
          $db_cust_id = $cart_row['user_id'];
          $db_pro_id = $cart_row['product_id'];
          $db_pro_qty = $cart_row['quantity'];

          $pr_query = "SELECT * FROM tbl_watch WHERE id=$db_pro_id";
          $pr_run = mysqli_query($con, $pr_query);

          if (mysqli_num_rows($pr_run) > 0) {
            while ($pr_row = mysqli_fetch_array($pr_run)) {
              $id = $pr_row['id'];
              $title = $pr_row['title'];
              $price = $pr_row['price'];
              $img1 = $pr_row['image_name'];

              $single_pro_total_price = $db_pro_qty * $price;
              $pro_total_price = $db_pro_qty * $price;

              $sub_total += $pro_total_price;
              $total = $sub_total + $shipping_cost;
      ?>

              <tr>
                <td><img class="cart-image" src="<?php echo SITEURL; ?>images/watch/<?php echo $img1; ?> " alt=""></td>
                <td><h3><?php echo $title; ?></h3></td>
                <td>x <?php echo $db_pro_qty; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $single_pro_total_price; ?> </td>
                <td colspan="2">
                  <a class="cart-update" href="edit_cart.php?cart_id=<?php echo $id; ?>">Update</a>
                  <a class="cart-delete" href="cart.php?id=<?php echo $id; ?>">Delete</a>
                </td>
              </tr>

      <?php
            }
          }
        }
      } else {
        echo "<tr><td colspan='6' class='text-center'>Your Cart is Empty</td></tr>";
      }
      ?>
    </table>
  </div>
  <!-- End cart -->

  <!-- Order Detail -->
  <div class="order-detail">
    <h1 class="order-detail-title">Order Details</h1>
    <p>Subtotal:<?php echo $sub_total; ?></p>
    <p>Discount:Rs0</p>
    <p>Shipping:<?php echo $shipping_cost; ?></p>
    <hr />
    <h2>Total:Rs.<?php echo $total; ?></h2>
  </div>
  <!-- End order -->
</div>

<div class="cart-button descrip">
  <a href="watch-items.php"><button>Continue Shopping</button></a>
  <a href="checkout.php"><button>Proceed Checkout</button></a>
</div>

<?php include('partials-font/footer.php'); ?>
    