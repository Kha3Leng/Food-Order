<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include 'partials/menu.php';?>
    <div class="main-content">
        <div class="wrapper ">
            <h1>Manage Category</h1>
            <br /><br />
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <br/><br/>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
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

    <?php include 'partials/footer.php';?>
</body>

</html>