<html>
<head>
    <title>Food Order Websit</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include("partials/menu.php"); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br/><br/><br/>
            <?php
                if (isset($_GET['id']) && $_GET['id'] != ''){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_order WHERE id = $id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0){
                        $rec = mysqli_fetch_assoc($res);

                        $id = $rec['id'];
                        $food = $rec['food'];
                        $qty = $rec['qty'];
                        $price = $rec['price'];
                        $status = $rec['status'];
                        $full_name = $rec['customer_name'];
                        $contact = $rec['customer_contact'];
                        $email = $rec['customer_email'];
                        $address = $rec['customer_address'];
                    }else{
                        header("location:".SITEURL."admin/manage-order.php");
                    }
                    
                }else{
                    header("location:".SITEURL."admin/manage-order.php");
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>    
                        <td>Food</td>
                        <td><strong><?php echo empty($_GET['food']) ? "<span class='failure'>No Food</span>": $_GET['food']; ?></strong></td>
                    </tr>
                    <tr>    
                        <td>QTY</td>
                        <td><input type="number" name="qty" value="<?php echo $qty; ?>"/></td>
                    </tr>
                    <tr>    
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option value="Ordered" <?php echo ($status == 'Ordered')? "selected": '';?>>Ordered</option>
                                <option value="On Delivery" <?php echo ($status == 'On Delivery')? "selected": ''; ?>>On Delivery</option>
                                <option value="Delivered" <?php echo ($status == 'Delivered')? "selected": ''; ?>>Delivered</option>
                                <option value="Cancelled" <?php echo ($status == 'Cancelled')? "selected": ''; ?>>Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>    
                        <td>Customer Name</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"/></td>
                    </tr>
                    <tr>    
                        <td>Contact</td>
                        <td><input type="text" name="contact" value="<?php echo $contact; ?>"/></td>
                    </tr>
                    <tr>    
                        <td>Email</td>
                        <td><input type="email" name="email" value="<?php echo $email; ?>"/></td>
                    </tr>
                    <tr>    
                        <td>Address</td>
                        <td><textarea cols="30" rows="5" name="address"><?php echo $address; ?></textarea></td>
                    </tr>
                    <tr>    
                        <td colspan="2">
                            <input type="hidden" name="price" value="<?php echo $price; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <input type="submit" name="submit" value="Update Order" class="btn-secondary"/>
                        </td>
                    </tr>

                </table>
            </form>

            <?php 
                if(isset($_POST['submit'])){
                    $qty = $_POST['qty'];
                    $status = $_POST['status'];
                    $full_name = $_POST['full_name'];
                    $contact = $_POST['contact'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $id = $_POST['id'];
                    $price = $_POST['price'];

                    if ($qty != ''){
                        $total = $qty * $price;
                    }

                    $sql3 = "UPDATE tbl_order SET
                            status = '$status',
                            qty = $qty,
                            total = $total,
                            customer_name = '$full_name',
                            customer_contact = '$contact',
                            customer_email = '$email',
                            customer_address = '$address'
                            WHERE id = $id";
                    
                    $res3 = mysqli_query($conn, $sql3);

                    if ($res3 == true){
                        $_SESSION['update'] = "<div class='success'>Updated Successfully</div>";
                        header("location:".SITEURL."admin/manage-order.php");
                    }else{
                        $_SESSION['update'] = "<div class='failure'>Updated Failed..</div>";
                        header("location:".SITEURL."admin/manage-order.php");
                    }
                }
            ?>
        </div>
    </div>

    <?php include("partials/footer.php"); ?>

    
</body>

</html>