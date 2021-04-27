<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br /><br />
            <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
    ?>
            <br /> <br />
            <div class="clearfix"></div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Foods
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Orders
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Revenue Generated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>

</html>