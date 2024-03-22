<?php
include('config/constants.php');
//destroy the session 
session_destroy(); //unset the session and user data
header('location:' . SITEURL);