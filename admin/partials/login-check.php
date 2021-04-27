
<?php

// Check if user is logged in..
// Authorizatin Access Control

if (!isset($_SESSION['user'])) {
    // User is not logged in
    // Redirect to Login
    $_SESSION['no-login'] = "<div class='failure'>Please log in to access</div>";
    header("location:" . SITEURL . "admin/login.php");
}

?>