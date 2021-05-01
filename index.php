<?php include("partials/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 

        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // Create query to display caetgory from database
                $sql = "SELECT * FROM tbl_category WHERE featured = 'Yes' and active = 'Yes' limit 3";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if( $count > 0){
                    while( $record = mysqli_fetch_assoc($res)){
                        $id = $record['id'];
                        $title = $record['title'];
                        $image_name = $record['image_name'];

                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name != ''){
                            ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                            <?php }else{
                                echo "<div class='failure'>Image Unavailable</div>";
                            }
                            ?>
                             <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>
                        <?php
                    }
                }else{
                    echo "<div class='failure'>No Category Data</div>";
                }
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql1 = "SELECT * FROM tbl_food WHERE active='Yes' and featured='Yes'";
                $res1 = mysqli_query($conn, $sql1);

                $count = mysqli_num_rows($res1);
                if ($count > 0){
                    while($rec = mysqli_fetch_assoc($res1)){
                        $id = $rec['id'];
                        $title = $rec['title'];
                        $description = $rec['description'];
                        $price = $rec['price'];
                        $image_name = $rec['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                         if($image_name != ''){
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
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

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }

                }else{
                    echo "<div class='failure'> No Food </div>";
                }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footer.php'); ?>