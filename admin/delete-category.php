<?php 
    include('../config/constant.php'); 
    
    // Check if id and image_name is set

    if(isset($_GET['id']) AND $_GET['image_name'] != ''){
        // Get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove image from images/category if available
        if ($image_name != ''){
            $path = "../images/category/".$image_name;
            
            // Delete files with unlink()
            $remove = unlink($path);
            if (!$remove){
                $_SESSION['remove'] = "<div class=\"failure\">Image Not Removed</div>";
                header("location:".SITEURL."admin/manage-category.php");
                
                // Stop the process
                die();
            }
        }

        // Delete data from database
        $sql = "DELETE FROM tbl_category
                WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if ($res == true){
            $_SESSION['delete'] = "<div class=\"success\">Deleted Sucessfully</div>";

            // Redirect to manage-category with a message
            header("location:".SITEURL."admin/manage-category.php");
        }else{
            $_SESSION['delete'] = "<div class=\"failure\">Deletion Failed</div>";

            // Redirect to manage-category with a message
            header("location:".SITEURL."admin/manage-category.php");
        }

        
    }else{
       // Display message and redirect to manage-category.php 
       $_SESSION['delete'] = "<div class\"=failure\">No such ID or image name</div>";
       header("location:".SITEURL."admin/manage-category.php");
    }
?>
