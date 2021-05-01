<?php include('partials/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <?php
        if ($_GET['food_id'] != ''){
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
            $res = mysqli_query($conn, $sql);

            if($res == true){
                if($rec = mysqli_fetch_assoc($res)){
                    $id = $rec['id'];
                    $title = $rec['title'];
                    $description = $rec['description'];
                    $price = $rec['price'];
                    $image_name = $rec['image_name'];
                }
            }else{
                header("location:".SITEURL);
            }
        }else{
            header("location:".SITEURL);
        }
    ?>
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php
                        if ($image_name != ''){
                    ?>
                        <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php 
                        }else{
                            echo "<div class='failure'>No Image</div>";
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>"/>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    
                    <input type="hidden" name="food-id" value="<?php echo $id; ?>"/>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                if(isset($_POST['submit'])){
                    $food_id = $_POST['food-id'];
                    $full_name = $_POST['full-name'];
                    $contact = $_POST['contact'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $qty = $_POST['qty'];
                    $price = $_POST['price'];

                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:m:s");

                    $status = "Ordered";   //Ordered, Cancelled, On Delivery, Delivered

                    $sql4 = "INSERT INTO tbl_order 
                            (food, price, qty, total, order_date, status, customer_name,
                            customer_contact, customer_email, customer_address)
                            VALUES ($food_id, $price, $qty, $total, '$order_date', '$status', '$full_name',
                            '$contact', '$email', '$address')";
                    // echo $sql4;
                    $res4 = mysqli_query($conn, $sql4);

                    // echo var_dump($res4);
                    // die();

                    if ($res4 == true){
                        $_SESSION['order'] = "<div class='success text-center'>Ordered</div>";
                        header("location:".SITEURL);
                    }else{
                        $_SESSION['order'] = "<div class='failure text-center'>Failed to Order</div>";
                        header("location:".SITEURL);
                    }
                    
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('partials/footer.php'); ?>