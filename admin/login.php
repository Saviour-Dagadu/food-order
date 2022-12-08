<?php include('../config/constants.php'); ?>

<html class="lead">
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1>
            <br /><br />

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo  $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br /> <br />

            <!------Login Form Starts------>
            <form action="" method="POST" class="text-center">
                Username: <br />
                example@food-order.org<br /><br />
                <input type="text" name="username" placeholder="Enter Username"><br /><br />

                Password <br /><br />
                <input type="password" name="password" placeholder="Enter Password"><br /><br />

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br /><br />S
            </form>
            <!------Login Form Ends------>

            <p class="text-center">Created By - <a href="http://saviourdagadu.netlify.app/">Savi</a></p>
        </div>

    </body>
</html>

<?php

    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, md5($_POST['password']));

        //2. SQL to check whether the username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //3. Execute the Query
        $res = mysqli_query($con, $sql);

        //4. count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //User available and Login success
            $_SESSION['login'] = "<div = class='success tex-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not available
            $_SESSION['login'] = "<div = class='error text-center'>Username or Password did not match</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>