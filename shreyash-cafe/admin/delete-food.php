<?php

    //Include constants.php file here
    include('../config/constants.php');

    //check whether  the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // get the value and delete 
        $id = $_GET['id'];
        $image_name=$_GET['image_name'];

        // remove the physical image file if avaiable
        if($image_name != "")
        {
            //image is available. Removing it.
            $path ="../images/Food/".$image_name;

            // remove the image
            $remove = unlink($path);

            // if failed to remove image then add an error message and it stop the process
            if($remove == false)
            {
                // setting the session message
                $_SESSION['upload'] ="<div class = 'error'> Failed to Remove Food Image. </div>";

                // redirect to manage category page
                header('location'.SITEURL.'admin/manage-food.php');

                //stop the process
                die();

            }

        }

        // delete data from database
        // Sql query to delete data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        // execute the query
        $res = mysqli_query($conn,$sql);

        // checking whether the data is deleted from data base or not
        if($res == true)
        {
            // Create Session varibale to display message
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";

            //Rediredt to manage admin page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // Create Session varibale to display message
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";

            //Rediredt to manage admin page
            header('location:'.SITEURL.'admin/manage-food.php');

        }

    }
    else
    {
        // Create Session varibale to display message
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";

        //Rediredt to manage admin page
        header('location:'.SITEURL.'admin/manage-food.php');


    }


?>