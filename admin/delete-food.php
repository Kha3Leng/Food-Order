<?php 
    include('../config/constant.php');
    
    if(isset($_GET['id'])){
        // Get ID and Image_name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove Image if available
        if ($image_name != ''){
            // has to remove image
            $path = "../images/food/".$image_name;
            $remove = unlink($path);
            echo var_dump($remove);
            echo $image_name;
            if ($remove == false){
                $_SESSION['remove'] = "<div class='failure'> Failed to delete image</div>";
                header("location:".SITEURL."admin/manage-food.php");
                die();
            }
        }

        // Remove food data from database
        $sql = "DELETE FROM tbl_food WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully..</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }

        // Redirect to manage-food with a message
        
    }else{
        // Redirect to manage-food
        $_SESSION['delete'] = "<div class='failure'>Failed to delete food...</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
?>
