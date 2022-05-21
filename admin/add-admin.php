<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br /><br />

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the session is set or not
            {
                echo $_SESSION['add']; // Display the session message
                unset($_SESSION['add']); // Remove session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>
                <tr>
                    <td>Password </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
                </tr>
                <tr>
                    <td col-span="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    //Process the value from form and save it in Database
    
    //Check whether the button is clicked ot not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button clicked";

        //1. Get the data from form
        $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, md5($_POST['password'])); //Password Encripted with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        //3. Executing and Saving Data into Database
        $res = mysqli_query($con, $sql) or die(mysqli_error());

        //4. Check whether the (Query is executed) data is inserted or not and display appropriate message
        if($res == TRUE)
        {
            //Data Inserted
            //echo "Data Saved Successfully";
            //Create a Session variable to display message
            $_SESSION['add'] = "<div class='success tex-center'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to insert Data
            //echo "Failed to save data";
            //Create a Session variable to display message
            $_SESSION['add'] = "<div class='error tex-center'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>