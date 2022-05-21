<?php include('partials/menu.php'); ?>

        <!-----Main Content Section Start----->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1>
                <br /><br />

                <!---Button to Add Admin---->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

                <br /><br /><br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorized']))
                    {
                        echo $_SESSION['unauthorized'];
                        unset($_SESSION['unauthorized']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //Create SQL Query to get all the food
                        $sql = "SELECT * FROM tbl_food";

                        //Execute the query
                        $res = mysqli_query($con, $sql);

                        //count rows to check if we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial number variable and set default value as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in database
                            //Get food from database and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //Get value from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>GHS<?php echo $price; ?></td>
                                        <td>
                                            <?php 
                                                //Check if we have image or not
                                                if($image_name=="")
                                                {
                                                    //we do not have image. display message
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }
                                                else
                                                {
                                                    //We have Image, Display Image
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px" >
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>


                                <?php
                            }
                        }
                        else
                        {
                            //Food not added in database
                            echo "<tr><td colspan='7' class='error'>Food not added yet</td></tr>";
                        }
                    ?>

                    
                    
                </table>

            </div>
        </div>
        <!-----Main Content Section Ends----->

<?php include('partials/footer.php'); ?>