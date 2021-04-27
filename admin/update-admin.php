<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php
        include('partials/menu.php');
    ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br /><br />
            <?php 
                // 1. get id to update
                $id = $_GET['id'];
                $sql = "SELECT full_name, username from tbl_admin where id = $id ";

                // 2. create query to select data
                $res = mysqli_query($conn, $sql);

                // 3. check if query is executed
                if ($res){
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        echo "<div class=\"success\">Admin available</div>";
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $user_name = $row['username'];
                    }else{
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td> Full Name </td>
                        <td> <input type="text" name="full_name" value="<?php echo $full_name; ?>" /></td>
                    </tr>
                    <tr>
                        <td> User Name </td>
                        <td> <input type="text" name="user_name" value="<?php echo $user_name; ?>" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="submit" name="submit" value="Change Data" class="btn-secondary" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php 
        // Check whether if the submit button is clicked.
        if (isset($_POST['submit'])){
            //echo "Button submit clicked";
            //echo $id;
            // Get all the values from the form to update 
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];

            //create query to update admin datat
            $sql = "UPDATE tbl_admin set full_name = '$full_name', username = '$user_name' WHERE id = '$id'";

            $res = mysqli_query($conn, $sql);

            // check if query is executed 

            if ($res == TRUE){
                $_SESSION['update'] =  "<div class='success'>Updated Successfully</div>";
                header("location:".SITEURL."admin/manage-admin.php");
            }else{
                $_SESSION['update'] = "<div class='failure'>Failed Miserably</div>";
                header("location:".SITEURL."admin/update-admin.php");
            }
        }
    ?>

    <?php
        include('partials/footer.php');
    ?>
</body>

</html>