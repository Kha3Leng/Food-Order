<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php 
    // includ database connection
    include('../config/constant.php');
    
    //1. get admin id to be deleted
    $id = $_GET['id'];

    //2. create query for deletion
    $sql = "DELETE FROM tbl_admin where id = $id";

    $res = mysqli_query($conn, $sql);

    //check if query executed success
    if ($res){
        // used SESSION variable to store a message
        $_SESSION['delete'] = "<div class=\"success\">Successfully executed</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
        //redirect to manage-admin.php
    }else{
        $_SESSION['delete'] = "<div class=\"failure\">Failed Miserably</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }

    //3. redirect to manage-admin.php with message (success/error)

    include('partials/footer.php');
?>
</body>

</html>