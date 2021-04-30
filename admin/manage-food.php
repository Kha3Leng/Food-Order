<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper ">
            <h1>Manage Food</h1>
            <br /><br /><br/>
            <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['no-data'])){
                    echo $_SESSION['no-data'];
                    unset($_SESSION['no-data']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['delete-img'])){
                    echo $_SESSION['delete-img'];
                    unset($_SESSION['delete-img']);
                }
            ?>
            <br /><br /><br/>
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br/><br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Price
                    </th>
                    <th>    
                        Image
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Featured
                    </th>
                    <th>
                        Active
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <?php 
                    // Query Select to tbl_food
                    $sql = "SELECT * FROM tbl_food";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        while($rec = mysqli_fetch_assoc($res)){
                            $id = $rec['id'];
                            $description = $rec['description'];
                            $title = $rec['title'];
                            $price = $rec['price'];
                            $featured = $rec['featured'];
                            $active = $rec['active'];
                            $category = $rec['category_id'];
                            $image_name = $rec['image_name'];
                            
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        if ($rec['image_name'] != ''){
                                            $path = SITEURL."images/food/".$rec['image_name'];
                                            // echo $path;
                                            ?>
                                            <img src="<?php echo $path; ?>" width="100px"/>
                                            <?php
                                        }else{
                                            ?>
                                            <span class="failure">No Image</span>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $category; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <td colspan="9" class="failure">No Food Data</td>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>

    <?php include('partials/footer.php');?>
</body>

</html>