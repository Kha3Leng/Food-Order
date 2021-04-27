<?php
include '../config/constant.php';
// Destroy SESSION
session_destroy();

// Redirect to log in page
header("location:" . SITEURL . "admin/login.php");
