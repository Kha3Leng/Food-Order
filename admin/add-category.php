<?php include 'partials/menu.php';?>
<html>
<head>
    <title> Food Category </title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>
    <body>
        <div class="main-content">
            <div class="wrapper">
                <h1>Add Category</h1>
                <br /> <br/>
                <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title</td>
                            <td> <input type="text" name="title" /> </td>
                        </tr>
                        <tr>
                            <td>Select Image</td>
                            <td><input type="file" name="image"/></td>
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
                                <input type="submit" name="submit" value="Add Category" class="btn-secondary"/>
                             </td>
                        </tr>
                    </table>
                </form>
                <?php 
                    // Check if submit btn is clicked
                    if(isset($_POST['submit'])){
                        // Get values from form
                        $title = $_POST['title'];

                        // print_r for displaying array()
                        // print_r($_FILES['image']['name']);
                        
                        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
                            // Upload the image
                            // To upload image, we need image name, source path and detination path
                            echo $image_name = $_FILES['image']['name'];

                            // Auto Renaming 
                            // Get extension of our image (jpg, png, etc..)
                            $ext = end(explode('.', $image_name));

                            // Rename image
                            $image_name = 'Food_category_'.rand(000,999).'.'.$ext;


                            echo $src_path = $_FILES['image']['tmp_name'];
                            echo $des_path = "../images/category/".$image_name;
                            
                            // Finally upload
                            $upload = move_uploaded_file($src_path, $des_path);
                            
                            // $upload = copy($src_path, $des_path);
                            echo !$upload;
                            // Check upload success
                            if (!$upload){
                                $_SESSION['upload'] = "<div class=\"failure\">Failed to upload image</div>";
                                header("location:".SITEURL."admin/add-category.php");
                               die(); 
                            }
                        }else{
                            // don't upload image and set image_name as null
                            $image_name = "";
                        }

                        // Check if radio btn is checked
                        if (isset($_POST['featured'])){
                            $featured = $_POST['featured'];
                        }else{
                            // Set default value
                            $featured = "No";
                        }
                        
                        if (isset($_POST['active'])){
                            $active = $_POST['active'];
                        }else{
                            $active = "No";
                        }
                        

                        // Query for Category insertion to database
                        $sql = "INSERT INTO tbl_category(title, image_name, featured, active) VALUES ('$title', '$image_name', '$featured', '$active')";
                        $sql;
                        $res = mysqli_query($conn, $sql);

                        // Check if query executed successfully
                        if ($res == true){
                            // Executed sucessfully
                            $_SESSION['add'] = "<div class=\"success\">Added Successfully</div>";
                            header("location:".SITEURL."admin/manage-category.php");
                        }else{
                            $_SESSION['add'] = "<div class=\"failure\">Failed Successfully</div>";
                            header("location:".SITEURL."admin/add-category.php");
                        }

                        
                    }
                ?>
            </div>
        </div>
        <?php include 'partials/footer.php';?>
    </body>
</html>