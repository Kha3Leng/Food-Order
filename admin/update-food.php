<html>
<head>
    <title>Food Order Websit</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include("partials/menu.php"); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br/><br/><br/>
            <?php
            ?>
            <br/> <br/> <br/>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <?php
                        if (isset($_GET['id']) && $_GET['id'] != ''){
                            // Get id
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM tbl_food WHERE id = $id";
                            $res = mysqli_query($conn, $sql);
                            // echo var_dump($res);
                            $count = mysqli_num_rows($res);
                            if($count != 0){
                                if ($rec = mysqli_fetch_assoc($res)){
                                    $id = $rec['id'];
                                    $title = $rec['title'];
                                    $description = $rec['description'];
                                    $current_image = $rec['image_name'];
                                    $price = $rec['price'];
                                    $current_category = $rec['category_id'];
                                    $featured = $rec['featured'];
                                    $active = $rec['active'];
                                }
                            }else{
                                $_SESSION['no-data'] = "<div class='failure'>No Food Data</div>";
                                header("location:".SITEURL."admin/manage-food.php");
                            }
                        }else{
                            header("location:".SITEURL."admin/manage-food.php");
                        }
                    ?>
                    <tr>
                        <td>ID</td>
                        <td><input type="text" name="id" value="<?php echo $id; ?>" readonly/></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description" ><?php echo $description;?></textarea></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Select a Category</td>
                        <td>
                            <select name="category">
                                <?php 
                                        $sql1 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                        $res1 = mysqli_query($conn, $sql1);
                                        $count = mysqli_num_rows($res1);
                                        
                                        if ($count > 0){
                                            
                                            while($rec = mysqli_fetch_assoc($res1)){
                                                $category_id = $rec['id'];
                                                $category_title = $rec['title'];
                                                ?>
                                                <option <?php if($category_id == $current_category){ echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
                                                <?php
                                            }
                                        }else{
                                            echo "<div class='failure'>No Category</div>";
                                        }
                                ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <?php
                                if ($current_image != ''){
                                    $path = SITEURL."images/food/".$current_image;
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
                    </tr>
                    <tr>
                        <td>Select a New Image</td>
                        <td><input type="file" name="new_image" /></td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="Yes" <?php if($featured == 'Yes'){echo "checked";} ?>>Yes</input>
                            <input type="radio" name="featured" value="No" <?php if($featured == 'No'){echo "checked";} ?> >No</input>
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes" <?php if($active == 'Yes'){echo "checked";} ?>>Yes</input>
                            <input type="radio" name="active" value="No" <?php if($active == 'No'){echo "checked";} ?>>No</input>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" />
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include("partials/footer.php"); ?>

    
</body>

</html>
<?php 
        ob_start();
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_category = $_POST['category'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            
            // print_r($_FILES['new_image']);
            if ($_FILES['new_image']['name'] != ''){
                $image_name = $_FILES['new_image']['name'];
                $ext = end(explode('.', $image_name));
                $image_name = "Food_Name_".rand(0000, 9999).".".$ext;
                $src_path = $_FILES['new_image']['tmp_name'];
                $des_path = "../images/food/".$image_name;
                $upload = copy($src_path, $des_path);
                if( !$upload ){
                    $_SESSION['upload'] = "<div class='failure'>Failed to upload image</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                    die();
                    exit();
                }
                // echo "hello";
                // echo var_dump($image_name);
                // die();
                if ($current_image != ''){
                    $path = "../images/food/".$current_image;
                    $remove = unlink($path);
                    if($remove == false){
                        $_SESSION['delete-img'] = "<div class='failure'>Failed to delete image</div>";
                        header("location:".SITEURL."admin/manage-food.php");
                        die();
                        exit();
                    }
                }else{
                    $image_name = $image_name;
                }
            }else{
                $image_name = $current_image;
            }

            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                $featured = "No";
            }

            if(isset($_POST['active'])){
                $featured = $_POST['active'];
            }else{
                $featured = "No";
            }
            
            $sql2 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    category_id = $current_category,
                    featured = '$featured',
                    active = '$active',
                    image_name = '$image_name'
                    WHERE id = $id";

            $res2 = mysqli_query($conn, $sql2);
            if($res2 == true){
                $_SESSION['update'] = "<div class='success'>Updated Successfully</div>";
                echo ("<script> window.location = 'http://192.168.64.2/food-order/admin/manage-food.php'; </script>");

            }else{
                $_SESSION['update'] = "<div class='failure'>Updated Failed</div>";
                header("location:".SITEURL."admin/manage-food.php");
            }
        }
    ?>