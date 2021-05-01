<?php include('partials/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php 
                if ($_GET['category_id'] != ''){
                    $category_id = $_GET['category_id'];

                    $sql1 = "SELECT title FROM tbl_category WHERE id = $category_id";
                    $res1 = mysqli_query($conn, $sql1);
                    if ($res1 == true && $rec1 = mysqli_fetch_assoc($res1)){
                        $category_title = $rec1['title'];
                    }else{
                        $_SESSION['no-category'] = "<div class='failure'>No Categery</div>";
                        header("location:".SITEURL); 
                    }
                }else{
                    $_SESSION['no-category'] = "<div class='failure'>No Categery</div>";
                    header("location:".SITEURL);
                }
                
            ?>
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * FROM tbl_food
                        WHERE category_id = $category_id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 0){
                    while($rec = mysqli_fetch_assoc($res)){
                        $id = $rec['id'];
                        $title = $rec['title'];
                        $price = $rec['price'];
                        $description = $rec['description'];
                        
                        $image_name = $rec['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                if ($image_name != ''){
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php 
                                }else{
                                    echo "<div class='failure'>No Image</div>";
                                }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials/footer.php'); ?>