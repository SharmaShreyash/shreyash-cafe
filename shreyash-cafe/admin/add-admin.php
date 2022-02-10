<?php include('partials/menu.php'); ?>

<div class ="main-content">
    <div class ="wrapper">
        <h1> Add Admin </h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['add'])) // checking whether the session is set or not
            {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); //Removing session message
            }

        ?>


        <form action="" method="POST">
        <table class ="tbl-30">
            <tr>
                <td> Full Name : </td>
                <td> <input type ="text" name="full_name" placeholder ="Enter Your Name"></td>
            </tr>
            <tr>
                <td> Username : </td>
                <td> <input type ="text" name="username" placeholder ="Enter Username"></td>
            </tr>
            <tr>
                <td> Password : </td>
                <td> <input type ="password" name="password" placeholder ="Enter Password"></td>
            </tr>
            <tr>
                <td colspan ="2">
                    <input type ="submit" name="submit" value ="Add Admin" class ="btn-secondary"> 
                </td>
            </tr>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database


    // Check whether the submit is clicked or not

    if( isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        // Get the data from form
        $full_name = $_POST['full_name'];
        $username  = $_POST['username'];
        $password  = md5($_POST['password']);// We use MD5 to encrypt password

        // SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";
        //echo $sql; // check sql is working


        // Executing Query and Saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Checking whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //echo "Data Inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "Admin Added Succesfully";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //echo "Failed to Insert data";
            // Create a session variable to display message
            $_SESSION['add'] = "Failed to Add Admin";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    }

?>