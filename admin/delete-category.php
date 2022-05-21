<?php
    //Include constants file
    include('../config/constants.php');

    //echo "Delete Page";
    //Check whether the id and the image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET ['image_name'];

        //Remove the physical image file if available
        if($image_name != "")
        {
            //Image is available, so remove it
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //If failed to remove then add an error message and stop the process
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error tex-center'>Failed to remove category image. </div>";
                //Redirect to the manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }
        //Delete data from database
        //SQL Query to delete data fro database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($con, $sql);

        //check whether the data is deleted from the database or not
        if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success tex-center'>Category Deleted Successfully.</div>";
            //Redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set failed message and redirect
            $_SESSION['delete'] = "<div class='error tex-center'>Failed to Deleted Category.</div>";
            //Redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>