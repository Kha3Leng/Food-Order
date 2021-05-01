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
            <?php
                $sql = "SELECT count(*) as count FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_fetch_assoc($res)['count'];

                $sql1 = "SELECT count(*) as count FROM tbl_food";
                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_fetch_assoc($res1)['count'];


                $sql2 = "SELECT count(*) as count1 FROM tbl_order";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_fetch_assoc($res2)['count1'];

                $sql3 = "SELECT sum(total) as sum1 FROM tbl_order where status = 'Delivered'";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_fetch_assoc($res3)['sum1'];
            ?>
            <div class="clearfix"></div>
            <div class="col-4 text-center">
                <h1><?php echo $count; ?></h1>
                <br />
                Categories
            </div>
            <div class="col-4 text-center">
                <h1><?php echo $count1; ?></h1>
                <br />
                Foods
            </div>
            <div class="col-4 text-center">
                <h1><?php echo $count2; ?></h1>
                <br />
                Orders
            </div>
            <div class="col-4 text-center">
                <h1>$<?php echo $count3; ?></h1>
                <br />
                Revenue Generated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>

</html>