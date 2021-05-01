<?php include('partials/menu.php'); ?>

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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql = "SELECT * FROM tbl_food WHERE active = 'Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 1){
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
                                if($image_name != ''){
                            ?>
                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name;?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
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
                }else{
                    echo "<div class='failure'>No Food Data</div>";
                }
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footer.php'); ?>