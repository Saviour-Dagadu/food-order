<?php
    //Include constant page
    include('../config/constants.php');

    //echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete
        //echo "Process to Delete";

        //1. Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if available
        //Check if the image is available or not and delete if available
        if($image_name != "")
        {
            //It has image and need to be removed from folder
            //Get the image path
            $path = "../images/food/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check the image is removed or not
            if($remove==false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error tex-center'>Failed to remove Image file.</div>";
                //Redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of deleting food
                die();
            }
        }

        //3. Delete image from database
        //Create sql query to delete from table
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($con, $sql);

        //Check if the query is executed or not and set the session message respectively
        //4. Redirect to manage food page with session message
        if($res==true)
        {
            //Food Deletes
            $_SESSION['delete'] = "<div class='success tex-center'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to delete food
            $_SESSION['delete'] = "<div class='error tex-center'>Failed to Delete Food.</div>";
            header('location;'.SITEURL.'admin/manage-food.php');
        }


    }
    else
    {
        //Redirect to Manage Food Page
        //echo "Process to Redirect";
        $_SESSION['unauthorized'] = "<div class='error tex-center'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>