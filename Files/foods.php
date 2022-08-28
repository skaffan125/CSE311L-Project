
    <?php include('partials-front/menu.php'); ?>

 
<section class="food-search text-center">
    <div class="container">
        <?php 

            // Search Keyword
            $search = $_POST['search'];
        
        ?>


        <h2><a href="#" class="text-white">Foods on Your Search "<?php echo $search; ?>"</a></h2>

    </div>
</section>




<!-- fOOD MEnu Section Starts  -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 

            //SQL Query to Get foods based on search keyword
            $sql = "SELECT * FROM dish JOIN dish_details ON dish.id=dish_details.dish_id WHERE dish.dish LIKE '%$search%' OR dish.dish_detail LIKE '%$search%'";

            
            $res = mysqli_query($con, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Availablity 
            if($count>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the details
                    $id = $row['id'];
                    $title = $row['dish'];
                    $price = $row['price'];
                    $description = $row['dish_detail'];
                    $image_name = $row['image'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // Check whether image name is available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>Admin/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                    <?php 

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

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Food Not Available
                echo "<div class='error'>Food not found.</div>";
            }
        
        ?>

        

        <div class="clearfix"></div>

        

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>