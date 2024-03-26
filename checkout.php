<?php include('config/constants.php') ?>
<?php include('partials-font/menu.php') ?>
<link rel="stylesheet" href="css/checkout.css">

<?php  
   if(isset($_SESSION['id'])){
     $customer_id    = $_SESSION['id'];
     $customer_email = $_SESSION['email']; 
     $customer_name  = $_SESSION['username'];
     $customer_add   = $_SESSION['add'];  
     $customer_number= $_SESSION['number'];

     $sub_total=0;
     $shipping_cost = 0;
     $total = 0;

     if(isset($_POST['checkout'])){
        $fullname = $_POST['fullname'];
        $address  = $_POST['address'];
        $number   = $_POST['phone_number'];
        
        $order_date = date("Y-m-d h:i:s");
        $status = "Ordered";
    
        // Fetching customer contact from the session
        // Assuming 'number' is the session variable for customer contact
    
        $cartt = "SELECT * FROM cart WHERE user_id='$customer_id'";
        $run  = mysqli_query($con,$cartt);
        if(mysqli_num_rows($run) > 0){
            while($row = mysqli_fetch_array($run) ){
                $db_pro_id  = $row['product_id'];
                $db_pro_qty  = $row['quantity'];
               
    
                $pr_query  = "SELECT * FROM tbl_watch WHERE id=$db_pro_id";
                $pr_run    = mysqli_query($con,$pr_query);
                if(mysqli_num_rows($pr_run) > 0){
                    while($pr_row = mysqli_fetch_array($pr_run)){
                        $price = $pr_row['price'];
                        $product_name=$pr_row['title'];

                        $product_id = $pr_row['id']; // Fetching product_id from the database
    
                        $single_pro_total_price = $db_pro_qty * $price;
                        
                        
                       
                           $checkout_query = "INSERT INTO tbl_buy SET
                          watch='$product_name',
                          price=$price,
                          qty=$db_pro_qty,
                          total=$single_pro_total_price,
                          order_date='$order_date',
                          status='$status',
                          customer_name='$customer_name',
                          customer_contact='$number',
                          customer_email='$customer_email',
                          customer_address='$address',
                          customer_id=$customer_id,
                          product_id=$db_pro_id
                          ";
                        if(mysqli_query($con,$checkout_query)){
                            $del_query = "DELETE FROM cart where user_id = $customer_id";
                            if(mysqli_query($con,$del_query)){
                                $_SESSION['message'] ="<div style='color:green; text-align:center'>
                                    Thanks! for your order, It will be delivered within 7 working days.
                                </div>";
                                header("location:" . SITEURL.'customer/orders.php');
                            }
                        }
                    }
                }
            }
        }
    }
?>

 <h1 class="checkout-title">Check Out</h1>
    <div class="checkout-main">
    
        <div class="checkout-form">
      <h2>Shipping  Details</h2><hr>
      <form action="" method="post">
        <label for="email"><b>Email:</b></label>
        <label><b><?php echo $customer_email;?></b></label><br><br>
        <label for="fullname">FullName:</label>
                        <input type="text" name="fullname" placeholder="Full Name" class="form-control" value="<?php echo $customer_name; ?>" required><br><br>
        <label for="address">Address:</label>
        <input type="text" name="address" placeholder="Address" value="<?php echo $customer_add; ?>" class="form-control" ><br><br>
        <label for="number">Number:</label>
        <input type="number" name="phone_number" placeholder="Phone Number" class="form-control" value="<?php echo $customer_number; ?>" required><br><br>
        <input type="submit" name="checkout" class="checkout-btn" value="Place Order" id="border-less">
      </form>
        </div>

        <div class="checkout-cart">
        <h2>Order Detail</h2><hr>
        <?php
                  $cart = "SELECT * FROM cart WHERE user_id='$customer_id'";
                  $run  = mysqli_query($con,$cart);
                   if(mysqli_num_rows($run) > 0){
                      while($cart_row = mysqli_fetch_array($run)){
                          $db_cust_id = $cart_row['user_id'];
                          $db_pro_id  = $cart_row['product_id'];
                          $db_pro_qty  = $cart_row['quantity'];

                       $pr_query  = "SELECT * FROM tbl_watch WHERE id=$db_pro_id";
                       $pr_run    = mysqli_query($con,$pr_query);
                                       
                        if(mysqli_num_rows($pr_run) > 0){
                         while($pr_row = mysqli_fetch_array($pr_run)){
                              $pid = $pr_row['id'];
                              $title = $pr_row['title'];
                              $price = $pr_row['price'];
                              $arrPrice = array($pr_row['price']);    
                             
                              $img1 = $pr_row['image_name'];
                                             
                              $single_pro_total_price = $db_pro_qty * $price;
                              $pro_total_price = array($db_pro_qty * $price);  
                              $each_pr = implode($pro_total_price);
                                           //   $values = array_sum($arrPrice);
                                 $shipping_cost=0;
                                 $values = array_sum($pro_total_price);
                                 $sub_total +=$values;
                                 $total = $sub_total + $shipping_cost;
                                              
                            ?> 
        <table class="checkout-tbl">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <tr>
                <td><img class="checkout-img" src="images/watch/<?php echo $img1;?>" alt=""></td>
                <td><?php echo $title;?></td>
                <td>x <?php echo $db_pro_qty;?></td>
                <td> <?php echo $single_pro_total_price;?></td>
                <?php  
                              
                            }
                           }    
                         }
                        }
           ?>
            </tr>
           
               
        </table>
        <div class="checkout-total">
            <div class="checkout-total-info">
                <p>Subtotal</p>
                <p>Shipping</p><hr>
                <h3>TOTAL</h3>
            </div>
            <div class="checkout-total-calculate">
                <p>Rs.<?php echo $sub_total;?></p>
                <p>Rs.<?php echo $shipping_cost;?></p><hr>
                <h3>Rs.<?php echo $total;?></h3>
            </div>
        </div>
     </div>
     <?php     
  }
 ?>
    </div>

<?php include('partials-font/footer.php') ?>