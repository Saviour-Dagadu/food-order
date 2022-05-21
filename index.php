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
    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Create SQL Query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the query
                $res = mysqli_query($con, $sql);

                //count rows to check if the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container food-responsive">
                                    <?php
                                    //Check whether Image is available
                                        if($image_name=="")
                                        {
                                            //Display message
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            //Image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" height = "400px" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //Categories not available
                    echo "<div class='error'>Category not Added</div>";
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

            //Getting food from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute Query
            $res2 = mysqli_query($con, $sql2);

            //Count rows
            $count2 = mysqli_num_rows($res2);

            //Check Whether food is available or not
            if($count2>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box food-responsive">
                        <div class="food-menu-img">
                            <?php
                            //Check whether image is available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            {
                                //Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" height ="100px">
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
                echo "<div class='error'>Food not available.</div>";
            }

            ?>



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>