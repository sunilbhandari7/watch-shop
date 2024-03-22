<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Product</h1>

        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['no-product-found'])) {
            echo $_SESSION['no-product-found'];
            unset($_SESSION['no-product-found']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br>
        <!-- button to add admin -->
        <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-product.php">Add Product</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_product";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);
            //sn number
            $sn = 1;
            if ($count > 0) {
                //$count = mysqli_fetch_assoc($res);
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            //check image name availability
                            if ($image_name != '') {
                            ?>
                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="" width="140px">
                            <?php
                            } else {
                                echo "<div class='error'>Image not available</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a class="btn-secondary" href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>">Update Product</a>
                            <a class="btn-danger" href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Delete Product</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Product Added.</div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php') ?>