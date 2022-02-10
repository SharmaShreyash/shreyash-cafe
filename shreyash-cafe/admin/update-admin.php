<?php include('partials/menu.php'); ?>

<div class ="main-content">
    <div class ="wrapper">
        <h1> Update Admin</h1>

        <br/><br/>
        <?php
            
            //get the ID of Selected admin to be Updated

            $id =$_GET ['id'];

            // create SQL query to get deatils of admin

            $sql ="SELECT * FROM tbl_admin WHERE id =$id";

            // Execute the query
            $res = mysqli_query($conn,$sql);


            // check wheather the query executed successfully or not
             if($res == true)
            {
                //Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count == 1)
                {
                    //get the details
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row ['full_name'];
                    $username = $row ['username'];
                }
                else
                {
                    // redirect to Manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
    

        ?>

        <form action ="" method ="POST">

            <table class ="tbl-30">
                <tr>
                    <td> Full Name : </td>
                    <td> 
                        <input type ="text" name="full_name" value ="<?php echo $full_name; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td> Username : </td>
                    <td> 
                        <input type ="text" name="username" value ="<?php echo $username;?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan ="2">
                        <input type="hidden" name  ="id" value="<?php echo $id;?>">
                        <input type ="submit" name="submit" value ="Update Admin" class ="btn-secondary"> 
                    </td>
                </tr>
            </table>

        </form>        
    </div>
</div>

<?php 

    // Checking whether submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Getting all the values from form to update 
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create a SQL Query to Update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id ='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn,$sql);

        // Check whether the query executed successfuly or not
        if($res == true)
        {
            // Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";

            //Rediredt to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
        else
        {
            //Faild to Update admin
            //echo "Failed to Update Admin";

            // Create Session varibale to display message
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin. Try Again !!</div>";

            //Rediredt to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

        }   
    } 
?>





<?php include('partials/footer.php'); ?>