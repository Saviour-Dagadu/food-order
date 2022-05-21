<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br /><br />

        <?php
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the data";
                $id = $_GET['id'];
                //Create QSL Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($con, $sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to the manage category page with error message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //Display th image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display error message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update-Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($con, $_POST['title']);
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating the image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the image details
                    $image_name = $_FILES['image']['name'];

                    //Check if the image is available or not
                    if($image_name != "")
                    {
                        //Image Available

                        //A. Upload the new image
                        //Auto rename our image
                        //Get the extension of the image (jpg, png, gif, etc) e.g "SpecialFood1.jpg"
                        $ext = end(explode('.', $image_name));
                        
                        //Rename image
                        $image_name = "Food_category_".rand(000, 999).'.'.$ext; // e.g Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally upload the image
                        $upload= move_uploaded_file($source_path, $destination_path);

                        //Check if the image is uploaded or not
                        //If the image is not uploaded then we will stop the process and redirect with error message
                        if($upload == FALSE)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error tex-center'>Failed to upload Image. </div>";
                            //Redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }

                        //B. Remove the current image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            //Check if the image is removed or not
                            //If failed to removed then display message and stop the process
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error tex-center'>Failed to remove image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); // Stop the process
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3. Update the database
                $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = '$id' ";

                //Execute the Query
                $res2 = mysqli_query($con, $sql2);

                //4. Redirect to manage category page with message
                //Check whether the query is executed or not
                if($res2==true)
                {
                    //category update
                    $_SESSION['update'] = "<div class='success tex-center'>Category Updated Successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to update
                    $_SESSION['update'] = "<div class='error tex-center'>Category Failed to Updated.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>