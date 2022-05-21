<?php include('partials-front/menu.php'); ?>

<br /><br /><br />

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //Display all the categories that are active
                //SQL Query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                //Execute the Query
                $res = mysqli_query($con, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check if categories is available or not
                if($count>0)
                {
                    //Categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container food-responsive">
                                    <?php
                                    if($image_name=="")
                                    {
                                        //image is not available
                                        echo "<div class='error'>Image Not Found</div>";
                                    }
                                    else
                                    {
                                        //image is available
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
                    //Category Not Available
                    echo "<div class='error'>Category Not Found</div>";
                }
            
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>