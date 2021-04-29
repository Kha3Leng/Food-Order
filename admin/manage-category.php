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

                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
            <br/><br/>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br/> <br/>
            <table class="tbl-full">
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Featured
                    </th>
                    <th>
                        Active
                    </th>
                    <th>
                        Actions
                        </th>
                </tr>
                <?php
                    // Display ALl Categories
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count > 0){
                        $sn = 1;
                        while($rec = mysqli_fetch_assoc($res)){
                            $id = $rec['id'];
                            $title = $rec['title'];
                            $image_name = $rec['image_name'];
                            $featured = $rec['featured'];
                            $active = $rec['active'];
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php 
                                        if($image_name != ''){
                                            // echo $image_name; 
                                            // Display Image if image exists.
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px"/>
                                            <?php
                                        }else{
                                            echo "<span class=\"failure\">No Image</span>";
                                        }
                                        
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr colspan="6">
                            <td><div class="failure">No Category</div></td>
                        </tr>
                        <?php

                    }
                    
                ?>
            </table>
        </div>
    </div>

    <?php include 'partials/footer.php';?>
</body>

</html>