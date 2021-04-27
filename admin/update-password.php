<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br /> <br />

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Old Password</td>
                        <td><input type="password" name="current_password" /></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" /></td>
                    </tr>
                    <tr>
                        <td>Confirmed Password</td>
                        <td><input type="password" name="confirmed_password" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="submit" name="submit" value="Update Password" class="btn-secondary" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    // Check whether the submit button is clicked or not

    if (isset($_POST['submit'])){
        // echo "yes you clicked";
        // 1. Get current user id

        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirmed_password = md5($_POST['confirmed_password']);

        // 2. Check if the id exists in the database.

        $sql = "SELECT * FROM tbl_admin where id = $id and password = '$current_password'";

        // 3. execute the query
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        // echo $count;
        if ($res == TRUE){
            // User exists and password can be changed.
            // Check new password with confirmed password.
            // echo $new_password;
            // echo $confirmed_password;
            // echo $confirmed_password+"<br/>";

            if ($new_password == $confirmed_password){
                // Update the password
                // echo "password matched";
                $sql2 = "UPDATE tbl_admin 
                            SET password = '$new_password'
                            WHERE id = $id ";
                $res2 = mysqli_query($conn, $sql2);
                
                // Check if update query is executed successfully
                if ($res2){
                    $_SESSION['update_password'] = "<div class='success'> Password Changed </div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }else{
                    $_SESSION['update_password'] = "<div class='failure'> Password Not Changed </div>";

                    header("location:".SITEURL."admin/update-password.php");
                }
            }else{
                // Show message it
                $_SESSION['not_matched'] = "<div class='failure'> User Not Matched </div>";

                // Redirect it 
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }else{
            // User Doesn't exist. Send message and redirect.
            $_SESSION['user_not_found'] = "<div class='failure'> User Not Found </div>";

            // Redirect User 
            header("location:".SITEURL."admin/manage-admin.php");
        }

    }else{
        // echo "no you didn't clicked";
    }
    ?>

    <?php include('partials/footer.php'); ?>
</body>

</html>