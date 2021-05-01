<?php include('partials/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $_POST['search']; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $search = $_POST['search'];
                
                $sql = "SELECT * FROM tbl_food 
                        WHERE title like '%$search%' OR
                        description LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count > 0){
                    while($rec = mysqli_fetch_assoc($res)){
                        $id = $rec['id'];
                        $title = $rec['title'];
                        $description = $rec['description'];
                        $price = $rec['price'];
                        $image_name = $rec['image_name'];
                        ?>
                        <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if ($image_name != '')
                                {
                            ?>
                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                    echo "<div class='failure'>No food name with <strong>".$search."</strong></div>";
                }

            ?>
        
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footer.php'); ?>