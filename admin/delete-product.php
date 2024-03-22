<?php
include('../config/constants.php');
//echo "delete page";
//check whether id and image values are set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value and delete it
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove image if already exists 
    if ($image_name != "") {
        $path = "/images/category/" . $image_name;
        $remove = unlink($path);
        if ($remove == false) {
            //sett the session message the redirect to manage category page
            $_SESSION['remove'] = "<div class='error'>Failed to remove product image</div>";
            header("Location:" . SITEURL . "admin/manage-product.php");
            die();
        }
    }
    $sql = "DELETE FROM tbl_product WHERE id=$id";
    $res = mysqli_query($con, $sql);
    //check data delete from database or not 
    if ($res) {
        $_SESSION['delete'] = "<div class='success'>Product deleted successfully</div>";
        header("Location:" . SITEURL . "admin/manage-product.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to deleted product.</div>";
        header("Location:" . SITEURL . "admin/manage-product.php");
    }
} else {
    //redirect to manage product page
    header('Location:' . SITEURL . 'admin/manage-product.php');
}