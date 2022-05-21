<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br /><br />

        <?php 
            //1. Get ID of Selected ID
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($con, $sql);

            //Check whether the Query is executed or not
            if($res == TRUE)
            {
                //Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;  ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;  ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "button clicked";
        //Get all the values from form
        echo $id = $_POST['id'];
        echo $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        echo $username = mysqli_real_escape_string($con, $_POST['username']);

        //Create an SQL Query to update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id' ";

        //Execute the Query
        $res = mysqli_query($con, $sql);

        //Check whether the query is executed successfully
        if(res == TRUE)
        {
            //Query Executed and Admin updated
            $_SESSION['update'] = "<div class='success tex-center'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to updated Admin
            $_SESSION['update'] = "<div class='error tex-center'>Failed to Updated Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>