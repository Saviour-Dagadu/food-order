<?php include('partials-front/menu.php'); ?>

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
                //Display food that are active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($con, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check if food is available
                if($count>0)
                {
                    //Foods available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box food-responsive">
                                <div class="food-menu-img">
                                    <?php
                                        //Check whether the image is available or not
                                        if($image_name=="")
                                        {
                                            //Image nor available
                                            echo "<div class='error'>Image not available.</div>";
                                        }
                                        else
                                        {
                                            //Image available
                                            ?>
                                            <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" height = "100px" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">GHS<?php echo $price; ?></p>
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
                    //Food not available
                    echo "<div class='error'>Food not found.</div>" ;
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>