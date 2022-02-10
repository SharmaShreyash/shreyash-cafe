<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class ="main-content">
            <div class ="wrapper">
                <h1>Manage Admin</h1>
                
                <br/><br/>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; // Display session message
                        unset($_SESSION['add']); //Removing session message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; // Display session message
                        unset($_SESSION['delete']); //Removing session message_
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; // Display session message
                        unset($_SESSION['update']); //Removing session message_
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found']; // Display session message
                        unset($_SESSION['user-not-found']); //Removing session message_
                    }
                    if(isset($_SESSION['password-not-match']))
                    {
                        echo $_SESSION['password-not-match']; // Display session message
                        unset($_SESSION['password-not-match']); //Removing session message_
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd']; // Display session message
                        unset($_SESSION['change-pwd']); //Removing session message_
                    }

                ?>
                <br/><br/><br/><br/>

                <!-- Button to Add Admin -->
                <a href = "add-admin.php" class = "btn-primary">Add Admin</a>

                <br/><br/><br/><br/>

                    <table class = "tbl-users"> 
                            <tr> 
                                <th> Sr. No. </th>
                                <th> Full Name </th>
                                <th> Username </th>
                                <th> Actions </th>
                            </tr>

                            <?php
                                //Query to get all admin
                                $sql = "SELECT * FROM tbl_admin";
                                //Execute the query
                                $res = mysqli_query($conn,$sql);

                                $sn=1; //Creating a variable and assigning a value

                                // check whether the query is executed or not
                                if($res == TRUE)
                                {
                                    //Count Rows to check whether we have data in databse or not
                                    $count = mysqli_num_rows($res); // Function to get all the rows in databse

                                    //check the num of rows
                                    if ($count>0)
                                    {
                                        //we have data in databse
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            //using while loop to get all the data from database.
                                            //and while loop will run as long as we have data in database


                                            // get individual data
                                            $id =$rows['id'];
                                            $full_name = $rows['full_name'];
                                            $username = $rows['username'];
                                            
                                            //display the value in our table
                                            ?>
                                            <tr>
                                                <td> <?php echo $sn++;?> </td>
                                                <td> <?php echo $full_name;?> </td>
                                                <td> <?php echo $username;?> </td>
                                                <td> 
                                                <a href ="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary"> Change Password</a>
                                                <a href = "<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>"class = "btn-secondary">Update Admin</a>
                                                <a href = "<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class = "btn-danger">Delete Admin</a>
                                                    </td>
                                            </tr>


                                            <?php

                                        }
                                    }
                                    else
                                    {

                                    }
                                }

                            ?>
                    </table>
            </div>
        </div>
        <!-- Menu Contetn Section Ends -->
<?php include('partials/footer.php'); ?>