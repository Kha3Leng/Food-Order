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
            ?>
            <br /><br />
            <a href="./add-admin.php" class="btn-primary">Add Admin</a>
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
                <tr>
                    <td>adf</td>
                    <td>adf</td>
                    <td>adsf</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>adf</td>
                    <td>adf</td>
                    <td>adsf</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>adf</td>
                    <td>adf</td>
                    <td>adsf</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>adf</td>
                    <td>adf</td>
                    <td>adsf</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>

</html>