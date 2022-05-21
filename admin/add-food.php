<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br /><br />

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td><textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" >

                            <?php 
                                //Create PHP code to display category from database
                                //1. Create SQL to get all active categories from Database
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";

                                $res = mysqli_query($con, $sql);

                                //count rows to check if we have category or not
                                $count = mysqli_num_rows($res);

                                //If count is greater than zero we have categories else we do not have categories
                                if($count>0)
                                {
                                    //We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //We do not have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                                //2. Display on Dropdown
                            
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name = "featured" value="Yes"> Yes
                        <input type="radio" name = "featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name = "active" value="Yes"> Yes
                        <input type="radio" name = "active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php 
            //Check if the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the food in Database
                //echo "Clicked";

                //1. Get the data from form
                $title = mysqli_real_escape_string($con, $_POST['title']);
                $description = mysqli_real_escape_string($con, $_POST['description']);
                $price = mysqli_real_escape_string($con, $_POST['price']);
                $category = $_POST['category'];

                //Check if radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // Setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = 'No'; // Setting the Default value
                }

                //2. Upload the image if selected
                //Check if the select image is checked or not and upload if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details
                    $image_name = $_FILES['image']['name'];

                    //Check if the image is selected or not and upload image if selected
                    if($image_name != "")
                    {
                        //Image is Selected
                        //A. Rename the image
                        //Get the extension of selected image (jpg, png, gif, etc.) "Savi-Cane.jpg"
                        $ext = end(explode('.', $image_name));

                        //create new name for image
                        $image_name = "Food-Name-".rand(0000, 9999).".".$ext; // New image name maybe like "Food-Name-657.jpg"

                        //B. Upload the image
                        //Get the source path and destination path

                        //source path is the current location of the image
                        $src=$_FILES['image']['tmp_name'];

                        //Destination path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check if the image is uploaded or not
                        if($upload == false)
                        {
                            //Failed to upload the image
                            //Redirect to Add Food Page with error message
                            $_SESSION['upload'] = "<div class='error tex-center'>Failed to upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');

                            //Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; //Setting the default value as blank
                }

                //3. Insert into database

                //Create SQL Query to save or add food
                //For numerical value do not pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($con, $sql2);

                //Check if data inserted or not
                //4. Redirect with message to manage food page
                if($res2 == true)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success tex-center'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error tex-center'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>