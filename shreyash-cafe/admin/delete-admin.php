<?php

    //Include constants.php file here
    include('../config/constants.php');

    //get the ID of admin to be deleted

    $id =$_GET ['id'];

    // create SQL query to delete admin

    $sql ="DELETE FROM tbl_admin WHERE id =$id";

    // Execute the query
    $res = mysqli_query($conn,$sql);

    // check wheather the query executed successfully or not
    if($res == true)
    {
        //Query executed succcesfully and admin deleted
        //echo "Admin Deleted";

        // Create Session varibale to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

        //Rediredt to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else{
        //Faild to delete admin
        //echo "Failed to Delete Admin";

         // Create Session varibale to display message
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again !!</div>";

         //Rediredt to manage admin page
         header('location:'.SITEURL.'admin/manage-admin.php');

    }

    // redirect to manage admin page with message (success/error)





?>