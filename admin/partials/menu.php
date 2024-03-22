<?php

include('../config/constants.php');
include('partials/login-check.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                
                <li><a href="manage-product.php">Product</a></li>
                <li><a href="manage-watch.php">Watch</a></li>
                <li><a href="manage-buy.php">Buy</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
    </div>