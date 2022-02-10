<?php include('../config/constants.php');?>

<html>
    <head>
        <title> Login - Shreyash Cafe</title>
        <link rel ="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class ="login">
            <h1 class ="text-center"> Login</h1>
            </br></br>
            
            <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login']; // Display session message
                        unset($_SESSION['login']); //Removing session message
                    }
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message']; // Display session message
                        unset($_SESSION['no-login-message']); //Removing session message
                    }
            ?>

            </br></br>


            <!-- Login Form -->
            <form action="" method ="POST" class ="text-center">
                Username: </br></br>
                <input type ="text" name ="username" placeholder = "Enter Username"></br></br>
                
                Password: </br></br>
                <input type ="password" name ="password" placeholder = "Enter Password"> </br></br>
                </br></br>
                <input type ="submit" name ="submit" value ="Login" class = "btn-primary">

            </form>
            </br></br>
        <p class ="text-center">All rights reserved. Designed By &copy; <a href="https://www.linkedin.com/in/1-shreyash-sharma/">Shreyash Sharma</a></p>
    </body>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        //getting the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Checking user name and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password='$password' ";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether data/user is available or not
        $count = mysqli_num_rows($res);
        
        if($count ==1)
        {
            // set message Login succesful 
            $_SESSION['login'] = "<div class = 'success'> Login successfully. </div>";
            // to check whether the user is logged in or not and logout will unset it
            $_SESSION['user'] =$username; 

            //Rediredt to manage admin page
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // set message Login succesful 
            $_SESSION['login'] = "<div class = 'error text-center'> Login Failed. Check username or password. </div>";

            //Rediredt to manage admin page
            header('location:'.SITEURL.'admin/login.php');
        }
        

    }
    

?>