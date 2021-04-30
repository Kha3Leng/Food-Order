<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
    <?php include('partials/menu.php'); ?>
    <div class="main-content">
    <div class="wrapper">
    <h1>Update Category</h1>
    <br/><br/><br/>
        <?php
            // Check if ID exists in the database
            if(isset($_GET['id']) && $_GET['id'] != ''){
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category where id = $id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){
                    $record = mysqli_fetch_assoc($res);
                    $id = $record['id'];
                    $title = $record['title'];
                    $featured = $record['featured'];
                    $active = $record['active'];
                    $image_name = $record['image_name'];

                    $path = SITEURL."images/category/".$image_name;
                }else{
                    $_SESSION['no_category'] = "<div class=\"failure\">No Category Found</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
            }else{
                // ID doesn't exist in Database
                // Redirect to manage-category
                $_SESSION['id_not_exist'] = "<div class=\"failure\">ID Not Exists</div>";
                header("location:".SITEURL."admin/manage-category.php");
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>   
                    <td>ID</td>
                    <td><input type="text" name="id" value="<?php echo $id?>" readonly/></td>
                </tr>
                <tr>   
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"/></td>
                </tr>
                <tr>   
                    <td>Current Image</td>
                    <td>
                        <?php 
                            // Check if the image_name is empty or not
                            if ($image_name != ''){
                                ?>
                                <img src="<?php echo $path; ?>" width="100px"/>
                                <?php
                            }else{
                                ?>
                                <span class="failure">No Image </span> 
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>   
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>   
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured == "Yes"){ echo "checked";}?> type="radio" name="featured" value="Yes">Yes</input>
                        <input <?php if($featured == "No"){ echo "checked";}?> type="radio" name="featured" value="No">No</input>
                    </td>
                </tr>
                <tr>   
                    <td>Active</td>
                    <td>
                        <input <?php if($active == "Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes</input>
                        <input <?php if($active == "No"){ echo "checked";} ?> type="radio" name="active" value="No">No</input>
                    </td>
                </tr>
                <tr>   
                    <td colspan="2">
                        <input type="hidden" name="image_name" value="<?php echo $image_name; ?>"/>
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary"/>
                    </td>
                </tr>
            </table>
        </form>

        <?php
            // Check if submit button is clicked
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $current_image = $_POST['image_name'];
                

                // Update new image if selected
                // Check if new image is uploaded?
                // echo $current_image;
                // print_r($_FILES['image']);
                // print_r(isset($_FILES['image']['name']));
                // print_r($_FILES['image']['name'] != '');
                // die();
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
                    $image_name = $_FILES['image']['name'];
                    // Auto Renaming 
                    // Get extension of our image (jpg, png, etc..)
                    $ext = end(explode('.', $image_name));

                    // Rename image
                    $image_name = 'Food_category_'.rand(000,999).'.'.$ext;


                    $src_path = $_FILES['image']['tmp_name'];
                    $des_path = "../images/category/".$image_name;
                    
                    // Finally upload\\
                    $upload = move_uploaded_file($src_path, $des_path);
                    // chmod -Rf 777 FOLDER_PATH
                    echo var_dump($upload);
                    echo "hello";
                    echo $image_name;
                    echo $current_image;

                    // Check upload success
                    if (!$upload){
                        $_SESSION['upload'] = "<div class=\"failure\">Failed to upload image</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                       die(); 
                    }

                    if ($current_image != ''){
                        $path = "../images/category/".$current_image;
                    
                        $remove = unlink($path);
                        
                            if ($remove == false){
                                $_SESSION['fail_remove'] = "<div class=\"failure\">Failed to upload a current image</div>";
                                header("location:".SITEURL."admin/manage-category.php");
                                die();
                            }

                        }
                    
                }else{
                    $image_name = empty($_POST['image_name'])? '': $_POST['image_name'];
                }

                // Update database
                $sql1 = "UPDATE tbl_category SET
                        title = '$title', 
                        featured = '$featured',
                        active = '$active',
                        image_name = '$image_name'
                        WHERE id = $id";
                $res1 = mysqli_query($conn, $sql1);

                // Check if query is executed
                if ($res1 == true){
                    $_SESSION['update'] = "<div class=\"success\">Category Updated Sucessfully</div>";

                    // Redirect to manage-category with a message
                    header("location:".SITEURL."admin/manage-category.php");
                }else{
                    $_SESSION['update'] = "<div class=\"failured\">Category Updated Failed..</div>";

                    // Redirect to manage-category with a message
                    header("location:".SITEURL."admin/manage-category.php");
                }         
            }
        ?>
    </div>
    </div>
    <?php include('partials/footer.php') ?>

</body>
</html>