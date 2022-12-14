<?php include('partials-front/menu.php'); ?>

<br /><br /><br />

     <!-- Contact Section Starts Here -->
     <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Contact Us ☎️</h2>
            <br /><br />
			 <!-----This is to display whether admin was able to add or not---->
			 <?php
                    if(isset($_SESSION['contact']))
                    {
                        echo $_SESSION['contact'];   //Displaying session message
                        unset($_SESSION['contact']); //Removing session message
                    }
        ?>
        <br /><br /><br />

            <section id="info">
      <div class="container">
        <div class="info info-image">
          <img src="images/logo.png" alt="Member Image"/>
        </div>
        <div class="info info-text">
          <h3>Our Business Info</h3>
          <div class="info-text-call">
            <h4>Call Now</h4>
            <address>+233248929076</address>
          </div>
        <div class="info-text-email">
            <h4>Email us</h4>
            <address>support@food-order.com</address>
        </div>
        </div>
      </div>
    </section>
    
<section id="message">
	     <div class="container">
		     <div class="message-top">
			    <h3>Send us your message</h3>
			 </div>
			 <div class="message-bottom">
			    <form action="" method="POST">
				   <div class="form-group">
				      <label for="name">Name</label>
					  <input type="text" id="name" name="name" class="input" placeholder="John Doe"/>
				   </div>
				   <div class="form-group">
				      <label for="email">Email</label>
					  <input type="email" id="email" name="email" class="input" placeholder="example123@food.com" />
				   </div>
				   <div class="form-group">
				      <label for="email">Contact Number</label>
					  <input type="tel" id="contact" name="contact" class="input" placeholder="+23324967594" />
				   </div>
				   <div class="form-group">
				       <label for="message">Message</label>
					   <textarea id="message" name="message" placeholder="Message"></textarea>
				   </div>
				   <input type="submit" name="submit" value="Send" class="btn-secondary"/>
				   <button type="button" class="btn-primary" onclick="clearInput()">Clear</button>
				</form>

				<!---Add Message into database---->
				<?php
					//Check whether the submit button is clicked or not
					if(isset($_POST['submit']))
					{
						//echo "Clicked";

						//1. Get values from contact form
						$name = mysqli_real_escape_string($con, $_POST['name']);
						$email = mysqli_real_escape_string($con, $_POST['email']);
						$contact = mysqli_real_escape_string($con, $_POST['contact']);
						$message = mysqli_real_escape_string($con, $_POST['message']);
						$contact_date = date("Y-m-d h:i:sa");
						$status = "Message Received";

						//2. Create SQL Query to Save the data into database
						$sql = "INSERT INTO tbl_contact SET
							name = '$name',
							email = '$email',
							contact = '$contact',
							message = '$message',
							contact_date = '$contact_date',
                            status = '$status'
						";

						//3. Execute Query and save data in database
						$res = mysqli_query($con, $sql) or 
						die(mysqli_query());

						//4. Check Whether the data is inserted or not and display session message
						if($res==TRUE)
						{
							//Data Inserted
							$_SESSION['contact'] = "<div class='success text-center'>Message Sent Successfully.</div>";
							header('location:'.SITEURL.'contact.php');
						}
						else
						{
							//Failed to insert data
							$_SESSION['contact'] = "<div class='error text-center'>Failed to Send Message.</div>";
							header('location:'.SITEURL.'contact.php');
						}
					}
				?>
			 </div>
		 </div>
	  </section>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Contact Section Ends Here -->

    <script>
	      function clearInput(){
		     document.getElementById("name").value = "";
		     document.getElementById("email").value = "";
		     document.getElementById("message").value = "";
		  }
	  </script>

<?php include('partials-front/footer.php'); ?>