<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Contact Message</h1>
        <br /><br />

        <?php
            //Check if the id is set or not
            if(isset($_GET['id']))
            {
                //Get the contact messages details
                $id = $_GET['id'];

                //get all other details based on this id
                //SQL Query to get the contact message details
                $sql = "SELECT * FROM tbl_contact WHERE id=$id";
                //Execute the Query
                $res = mysqli_query($con, $sql);
                //count rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Details available
                    $row=mysqli_fetch_assoc($res);

                    $name = $row['name'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $message = $row['message'];
                    $status = $row['status'];
                }
                else
                {
                    //Details not available and redirect to manage order page
                    header('location:'.SITEURL.'admin/manage-contact.php');
                }
            }
            else
            {
                //redirect ro manage order page
                header('location:'.SITEURL.'admin/contact-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td><b><?php echo $name; ?></b></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><b><?php echo $email; ?></b></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><b><?php echo $contact; ?></b></td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td>
                        <textarea name="message" cols="30" rows="5"><?php echo $message; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Message Received"){echo "selected";} ?> value="Message Received">Message Received</option>
                            <option <?php if($status=="On Hold"){echo "selected";} ?> value="On Hold">On Hold</option>
                            <option <?php if($status=="Replied"){echo "selected";} ?> value="Replied">Replied</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="contact" value="<?php echo $contact; ?>">

                        <input type="submit" name="submit" value="Update Message" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            //Check if the update button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //Get all values from form
                $id = $_POST['id'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $message = mysqli_real_escape_string($con, $_POST['message']);
                $status = $_POST['status'];

                //Update the values
                $sql2 = "UPDATE tbl_contact SET
                    message = '$message',
                    status = '$status'
                    WHERE id=$id
                ";

                //Execute the query
                $res2 = mysqli_query($con, $sql2);

                //Check whether updated or not
                //Redirect to manage contact with message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success tex-center'>Contact Message Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-contact.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error tex-center'>Failed to Updated Contact Message.</div>";
                    header('location:'.SITEURL.'admin/manage-contact.php');
                }

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>