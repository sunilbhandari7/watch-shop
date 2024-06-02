
<?php include('include/header.php');


if (!isset($_SESSION['username'])) {
  
  header('location:../user-login.php');
}
?>



<div class="account-info">

  User Account Information

</div>
<div class="user-information">
  <?php include('include/sidebar.php'); ?>
  
</div>


<?php include('include/footer.php') ?>