<?php

session_start();

define('SITEURL', 'http://192.168.64.2/food-order/');
define('LOCALHOST', "localhost");
define('DB_USER', "root");
define('DB', "food-order");
define('PW', "");

$conn= mysqli_connect(LOCALHOST, DB_USER, PW, DB);
// // Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>