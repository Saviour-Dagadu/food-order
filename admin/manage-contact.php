<?php include('partials/menu.php'); ?>

        <!-----Main Content Section Start----->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Contact Message</h1>
               
                <br /><br /><br />

                <?php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th>Contact Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Get all the messages from database
                        $sql = "SELECT * FROM tbl_contact ORDER BY id DESC"; //Display the latest order first
                        //Execute the Query
                        $res = mysqli_query($con, $sql);
                        //Count the rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a serial number and set its initial value as 1

                        if($count>0)
                        {
                            //Message available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get all the contact messages and details
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $contact = $row['contact'];
                                $message = $row['message'];
                                $contact_date = $row['contact_date'];
                                $status = $row['status'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $contact; ?></td>
                                        <td><?php echo $message; ?></td>
                                        <td><?php echo $contact_date; ?></td>
                                        <td>
                                            <?php
                                            //Message Received, On Hold, Replied, Cancelled
                                                if($status == "Message Received")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Hold")
                                                {
                                                    echo "<label style = 'color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Replied")
                                                {
                                                    echo "<label style = 'color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style = 'color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-contact.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Contact Message not available
                            echo "<tr><td colspan='12' class='error'>Customer message not available.</td></tr>";
                        }
                    ?>

                </table>

            </div>
        </div>
        <!-----Main Content Section Ends----->
        <br /><br />

<?php include('partials/footer.php'); ?>