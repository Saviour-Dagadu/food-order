<?php 

    //Include constants.php file her
    include('../config/constants.php');

    //1. Get the ID of the Admin to be deleted
    echo $id = $_GET['id'];
    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($con, $sql);

    //Check whether the query executed successfully of not
    if($res == TRUE)
    {
        //Query Executed successfully and Admin Deleted
        //echo "Admin Deleted";
        //Create Session variable to display message
        $_SESSION['delete'] = "<div class='success tex-center'>Admin Deleted Successfully.</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Deleted Admin";
        
        $_SESSION['delete'] = "<div class='error tex-center'>Failed to Delete Admin, try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. Redirect to manage Admin page with message (Success)

?>