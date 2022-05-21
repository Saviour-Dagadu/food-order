<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br /><br />

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">    
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
        //echo "Clicked";

        //1. Get the Data from Form
        $id=$_POST['id'];
        $current_password = mysqli_real_escape_string($con, md5($_POST['current_password']));
        $new_password = mysqli_real_escape_string($con, md5($_POST['new_password']));
        $confirm_password = mysqli_real_escape_string($con, md5($_POST['confirm_password']));

        //2. Check whether the user with current ID and current Password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

        //Execute the Query
        $res = mysqli_query($con, $sql);

        if($res == TRUE)
        {
            //Check whether data is available or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //User Exists and Password can be changed
                //echo "User Found";
                
                //Check wether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //Update to Password
                    //echo "Password matched";
                    $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id";
                    
                    //Execute the Query
                    $res2 = mysqli_query($con, $sql2);

                    //Check whether the query executed or not
                    if($res2 == TRUE)
                    {
                        //DIsplay Success Message
                        //Update to Manage Admin Page with success message
                        $_SESSION['change-pwd'] = "<div class = 'success tex-center'> Password Changed Successfully. </div>";
                        //Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //Update to Manage Admin Page with error message
                        $_SESSION['change-pwd'] = "<div class = 'error tex-center'> Failed to Change Password. </div>";
                        //Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //Update to Manage Admin Page with error message
                    $_SESSION['pwd-not-match'] = "<div class = 'error tex-center'> Password did not match. </div>";
                    //Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
            else
            {
                //User Does not exist Set message and redirect
                $_SESSION['user-not-found'] = "<div class= 'error tex-center'>User Not Found. </div>";
                //Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //3. Check whether the New Password and Confirm Password match or not

        //4. Change Password if all above is true
    }

?>

<?php include('partials/footer.php'); ?>