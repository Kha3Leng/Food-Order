<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper ">
            <h1>Manage Order</h1>
            <br /><br />
            <?php 
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <!-- <a href="#" class="btn-primary">Add Admin</a> -->
            <table class="tbl-full">
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Food
                    </th>
                    <th>
                        Price in USD
                    </th>
                    <th>
                        Qty
                    </th>
                    <th>
                        Total
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Customer Name
                    </th>
                    <th>
                        Customer Phone
                    </th>
                    <th>
                        Customer Email
                    </th>
                    <th>
                        Customer Address
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_order";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    if ($count > 0){
                        while($rec = mysqli_fetch_assoc($res)){
                            $id = $rec['id'];
                            $food_id = $rec['food'];
                            $price = $rec['qty'];
                            $total = $rec['total'];
                            $qty = $rec['qty'];
                            $status = $rec['status'];
                            $full_name = $rec['customer_name'];
                            $contact = $rec['customer_contact'];
                            $email = $rec['customer_email'];
                            $address = $rec['customer_address'];

                            $sql1 = "SELECT title from tbl_food WHERE id = $food_id";
                            $res1 = mysqli_query($conn, $sql1);
                            $food = mysqli_fetch_assoc($res1)['title'];
                            ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $food;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $qty;?></td>
                                    <td><?php echo $total;?></td>
                                    <td><?php 
                                    switch($status){
                                        case 'Ordered':
                                            echo "<label style='color: blue;'>".$status."</label>";
                                            break;
                                        case 'Delivered':
                                            echo "<label style='color: green;'>".$status."</label>";
                                            break;
                                        case 'On Delivery':
                                            echo "<label style='color: orange;'>".$status."</label>";
                                            break;
                                        case 'Cancelled':
                                            echo "<label style='color: red;'>".$status."</label>";
                                            break;
                                    }
                                    ?></td>
                                    <td><?php echo $full_name;?></td>
                                    <td><?php echo $contact;?></td>
                                    <td><?php echo $email;?></td>
                                    <td><?php echo $address;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>&food=<?php echo $food;?>" class="btn-danger">Update Order</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{
                        echo "<div class='failure'>No Data</div>";
                    }
                ?>
                
            </table>
        </div>
    </div>

    <?php include('partials/footer.php');?>
</body>

</html>