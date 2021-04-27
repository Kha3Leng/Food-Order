<?php include '../config/constant.php';?>
<html>

<head>
    <title> Log In Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <div class="login text-center">
    <?php
if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if (isset($_SESSION['no-login'])) {
    echo $_SESSION['no-login'];
    unset($_SESSION['no-login']);
}

?>
        <h1>Log In</h1>

        <br /><br /> <br />
        <!-- Log In Form start here -->
        <form action="" method="POST">
            <table>
                Username <br />
                <input type="text" name="username" /><br /><br />
                Password <br />
                <input type="password" name="password" /><br /><br />
                <input type="submit" name="submit" value="Log In" class="btn-primary" />
            </table>
        </form>
        <br /><br /><br />
        <p>Created By - <a href="#">Sai Khay Leang</a></p>
    </div>


    <?php

// Check whether the submit button is clicked.
if (isset($_POST['submit'])) {
    // Process login
    // 1. Get data
    $username = $_POST['username'];

    // password don't forget to hash
    $password = md5($_POST['password']);

    // 2. Check username and password exist
    $sql = "SELECT * FROM tbl_admin
            WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn, $sql);

    // 3. Count rows to check if the user exist or not
    $count = mysqli_num_rows($res);
    // $count = 1;

    if ($count == 1) {
        // User Available
        $_SESSION['login'] = "<div class='success'>Logged In...</div>";
        $_SESSION['user'] = $username; // Check if user is logged in or out.
        header("location:" . SITEURL . "admin/");
    } else {
        // User Unavailable
        $_SESSION['login'] = "<div class='failure'>Username or Password didn't match.</div>";
        header("location:" . SITEURL . "admin/login.php");
    }
}

?>

</body>

</html>

