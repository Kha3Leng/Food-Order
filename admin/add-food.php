<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br/><br/><br/>

            <?php
                if(isset($_SESSION['category-count'])){
                    echo $_SESSION['category-count'];
                    unset($_SESSION['category-count']);
                }
            ?>
            <br/><br/><br/>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title"/></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea cols="30" rows="5" name="description"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price"/></td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name="image"/></td>
                    </tr>
                    <tr>
                        <td>Food Category</td>
                        <td>
                            <select name="category">

                            <?php 
                                // To display category
                                $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if ($count > 0){
                                    while( $rec = mysqli_fetch_assoc($res)){
                                        $id = $rec['id'];
                                        $title = $rec['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title;?></option>
                                        <?php
                                    }
                                }else{
                                    $_SESSION['category-count'] = "<div class=\"failure\">No category</div>";
                                }
                            ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes</input>
                            <input type="radio" name="featured" value="No">No</input>
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes</input>
                            <input type="radio" name="active" value="No">No</input>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary"/>
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit'])){
                    // Get data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];

                    // Upload image if selected
                    if (isset($_FILES['image']['name']) and $_FILES['image']['name'] != ''){
                        $image_name = $_FILES['image']['name'];

                        // Renaming image name
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;
                        $src_path = $_FILES['image']['tmp_name'];
                        $des_path = '../images/food/'.$image_name;
                        
                        $src_path;
                        $des_path;
                        $upload = copy($src_path, $des_path);
                        
                        // Make sure to give permission to folder as writable
                        // Check if upload is success
                        if ($upload == false){
                            $_SESSION['upload'] = "<div class=\"failure\">Failed to upload image</div>";
                            header("location:".SITEURL."admin/manage-food.php");
                            die();
                        }
                    }else{
                        $image_name = '';
                    }


                    if (isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }else{
                        $featured = "No";
                    }

                    if (isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else{
                        $active = "No";
                    }

                    if (!empty($_POST['category'])){
                        $category = $_POST['category'];
                        echo "You have selected ".$_POST['category'];
                    }

                    // Insert into database
                    $sql1 = "INSERT INTO tbl_food (description,title, featured, active, price, category_id, image_name)
                            VALUES('$description', '$title', '$featured', '$active', $price, $category, '$image_name')";
                    
                    $res1 = mysqli_query($conn, $sql1);

                    if ($res1 == true){
                        // Query executed sucessfully
                        $_SESSION['add'] = "<div class=\"success\">Food Added Sucessfully</div>";
                        header("location:".SITEURL."admin/manage-food.php");
                    }else{
                        $_SESSION['add'] = "<div class=\"failure\">Food Not Added Sucessfully</div>";
                        header("location:".SITEURL."admin/manage-food.php");
                    }


                    // Redirect to manage-food with a message
                }
            ?>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>
</html>