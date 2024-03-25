<?php include('config/constants.php'); ?>
<?php include('partials-font/menu.php'); ?>
<div class="product-main">
        <?php
  $sql = "SELECT * FROM tbl_product WHERE active='Yes' AND featured='Yes' ";
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