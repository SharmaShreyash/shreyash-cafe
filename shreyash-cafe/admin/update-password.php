<?php include('partials/menu.php'); ?>
    <div class ="main-content">
        <div class ="wrapper">
            <h1> Change Password</h1>
            </br></br>

            <?php  
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>

            <form action ="" method ="POST">
                <table class ="tbl-30">
                <tr>
                    <td> Current Password: </td>
                    <td>
                        <input type ="password" name = "current_password" placeholder ="Current Password">
                </tr>
                <tr>
                    <td> New Password: </td>
                    <td>
                        <input type ="password" name = "new_password" placeholder ="New Password">
                </tr>
                <tr>
                    <td> Confirm Password: </td>
                    <td>
                        <input type ="password" name = "confirm_password" placeholder ="Confirm Password">
                </tr>
                <tr>
                    <td colspan ="2">
                        <input type="hidden" name  ="id" value="<?php echo $id;?>">
                        <input type ="submit" name="submit" value ="Change Password" class ="btn-secondary">                        
                    </td>
                </tr>
            </form>

        </div>
    </div>
    
    <?php 
        // checking whether the submit buttonis clicked or not
        if(isset($_POST['submit']))
        {
            // get the data from form
            $id = $_POST['id'];
            $current_password = md5 ($_POST['current_password']);
            $new_password = md5 ($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // check whether the user with current ID and current password exists or not
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";

            // Execute the query
            $res = mysqli_query($conn,$sql);
            if($res == true)
            {
                // check whether data is available or not
                $count = mysqli_num_rows($res);
                if($count ==1)
                {
                    //check whether the new password and confirm password match or not
                    if($new_password == $confirm_password)
                    {
                        // update the password
                        $sql2 = "UPDATE tbl_admin SET
                            password = '$new_password'
                            WHERE id = $id
                        ";

                        //Execute the query
                        $res2 = mysqli_query($conn,$sql2);

                        //checking whether the query executed
                        if($res2==true)
                        {
                            // set message 
                            $_SESSION['change-pwd'] = "<div class = 'success'> Password Changed successfully. </div>";

                            //Rediredt to manage admin page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else{
                            // set message 
                            $_SESSION['change-pwd'] = "<div class = 'error'> Password changed Failed !!!. </div>";

                            //Rediredt to manage admin page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        // set message 
                        $_SESSION['password-not-match'] = "<div class = 'error'> Password did not matched. </div>";

                        //Rediredt to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                }
                else
                {
                    // user does not exists set message 
                    $_SESSION['user-not-found'] = "<div class = 'error'> User Not Found. </div>";

                    //Rediredt to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

            // check whether the new password and confirm password match or not

            // chnage password if all above is true
        }
    
    
    
    
    ?>



<?php include('partials/footer.php'); ?>