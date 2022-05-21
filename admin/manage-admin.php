<?php include('partials/menu.php'); ?>

        <!-----Main Content Section Start----->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //Displaying session message
                        unset($_SESSION['add']); //Removing session message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>

                <br /><br /><br />
                <!---Button to Add Admin---->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                    //Query to Get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the Query
                        $res = mysqli_query($con, $sql);

                        //Check whether the Query is Executed or not
                        if($res == TRUE)
                        {
                            //Count rows to check wether we have data in database or not
                            $count = mysqli_num_rows($res); // Function to get all the rows in database

                            $sn=1; // Create a variable and assign a value

                            //Check the num of rows
                            if($count>0)
                            {
                                //We have data in database
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    //Using while loop to get the data from Database
                                    //And while loop will run as long as we have data in database

                                    //Get individual Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the Values in our table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                //We do not have Data in Database
                            }
                        }
                    ?>

                    
                </table>

            </div>
        </div>
        <!-----Main Content Section Ends----->

<?php include('partials/footer.php'); ?>