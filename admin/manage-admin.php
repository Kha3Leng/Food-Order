<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>

    <?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br /><br />
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];    //displaying session message
                    unset($_SESSION['add']);  //removing session message
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['user_not_found'])){
                    echo $_SESSION['user_not_found'];
                    unset($_SESSION['user_not_found']);
                }

                if (isset($_SESSION['not_matched'])){
                    echo $_SESSION['not_matched'];
                    unset($_SESSION['not_matched']);
                }

                if (isset($_SESSION['update_password'])){
                    echo $_SESSION['update_password'];
                    unset($_SESSION['update_password']);
                }
            ?>
            <br /><br />

            <a href="./add-admin.php" class="btn-primary">Add Admin</a>
            <br /> <br />
            <table class="tbl-full">
                <tr>
                    <th>
                        Serial No
                    </th>
                    <th>
                        Full Name
                    </th>
                    <th>
                        User Name
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <?php 
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);

                    if ($res){
                        $count = mysqli_num_rows($res);
                        $sn = 1;            //serial number incremented row by row, used it instaed of $id
                        if ($count > 0){
                            //we have admin data in databases
                            while($rows  = mysqli_fetch_assoc($res)){
                                // retrieve data from databases;
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $user_name = $rows['username'];

                                //display the values in the table
                                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $user_name; ?></td>
                    <td>
                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>"
                            class="btn-primary">Change Password</a>
                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>"
                            class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>"
                            class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                <?php
                            }
                        }else{
                            //we dont' have  admin data in databases
                        }
                    }
                ?>
            </table>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>

</html>