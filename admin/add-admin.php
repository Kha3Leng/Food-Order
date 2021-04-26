<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>

    <?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br /><br />

            <?php 
                if (isset($_SESSION['add'])){
                    echo $_SESSION['add'];      //displaying failed to add admin message
                    unset($_SESSION['add']);    //removing the message after the session is refreshed
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" placeholder="Enter your full name" /></td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td><input type="text" name="user_name" placeholder="Enter your user name" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Enter your password" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Submit" class="btn-secondary" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include('partials/footer.php'); ?>
    <?php 
        if(isset($_POST['submit'])){
        //    echo "Button clicked"; 
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];
            $password  = md5($_POST['password']);

            //insert admin data
            echo $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES (
                    '$full_name', '$user_name', '$password')";
            $res = mysqli_query($conn, $sql);

           //check if inserted successfully 
            if (!$res)
            {
                $_SESSION['add'] = "Failed to Add Successfully";
                header("location:".SITEURL."admin/add-admin.php");
            }else{
                
                $_SESSION['add'] = "Admin Added Successfully";
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }
        else {
            // echo "Button not clicked";
        }
    ?>
</body>

</html>