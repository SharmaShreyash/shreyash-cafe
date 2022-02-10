<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class ="main-content">
            <div class ="wrapper">
                <h1>Manage Categories</h1>

                </br></br></br></br>

                <?php
                    if(isset($_SESSION['add'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['add']; // Display session message
                        unset($_SESSION['add']); //Removing session message
                    }
                    if(isset($_SESSION['remove'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['remove']; // Display session message
                        unset($_SESSION['remove']); //Removing session message
                    }
                    if(isset($_SESSION['delete'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['delete']; // Display session message
                        unset($_SESSION['delete']); //Removing session message
                    }
                    if(isset($_SESSION['no-category-found'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['no-category-found']; // Display session message
                        unset($_SESSION['no-category-found']); //Removing session message
                    }
                    if(isset($_SESSION['update'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['update']; // Display session message
                        unset($_SESSION['update']); //Removing session message
                    }
                    if(isset($_SESSION['upload'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['upload']; // Display session message
                        unset($_SESSION['upload']); //Removing session message
                    }
                    if(isset($_SESSION['failed-remove'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['failed-remove']; // Display session message
                        unset($_SESSION['failed-remove']); //Removing session message
                    }

                ?>
                </br></br>
                
                <!-- Button to Add Admin -->
                <a href = "<?php echo SITEURL;?>admin/add-category.php" class = "btn-primary">Add Category</a>

                </br></br></br></br>

                    <table class = "tbl-users"> 
                            <tr> 
                                <th> Sr. No. </th>
                                <th> Title </th>
                                <th> Image </th>
                                <th> Feature </th>
                                <th> Active </th>
                                <th> Actions </th>
                            </tr>

                            <?php 

                                // Query to get all category from database
                                $sql = "SELECT * FROM tbl_category";

                                //Execute query
                                $res = mysqli_query($conn,$sql);

                                // count rows
                                $count =mysqli_num_rows($res);

                                // create serial number variable and assign value as 1.
                                $sn =1;

                                // check whether we have data in databse or not
                                if($count>0)
                                {
                                    // if we have data in database
                                    // we get the data and display
                                    while($row =mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title =$row['title'];
                                        $image_name =$row['image_name'];
                                        $featured =$row['featured'];
                                        $active = $row['active'];
                                        ?>
                                        <tr>
                                            <td> <?php echo $sn++;?>. </td>
                                            <td> <?php echo $title;?> </td>

                                            <td> 
                                                <?php 
                                                    //checling image name is available or not
                                                    if($image_name != "")
                                                    {
                                                        //displlay the image
                                                        ?>
                                                        <img src ="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        // display the message
                                                        echo "<div class ='error'>Image not added.</div>";
                                                    }
                                                
                                                
                                                ?> 
                                            </td>
                                            
                                            <td> <?php echo $featured;?> </td>
                                            <td> <?php echo $active;?> </td>
                                            <td> 
                                            <a href = "<?php echo SITEURL;?>admin/update-category.php? id=<?php echo $id;?>" class = "btn-secondary">Update Category</a>
                                            <a href = "<?php echo SITEURL;?>admin/delete-category.php? id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class = "btn-danger">Delete Category</a>
                                                </td>
                                        </tr>
                                        <?php

                                    }

                                }
                                else
                                {
                                    // if we dont have data, display the mesaage inside table
                                    ?>
                                    <tr>
                                        <td colspan ="6"><div class ="error">No category Added.</div></td>
                                    </tr>

                                    <?php

                                }
                            
                            ?>

                            

                           
                    </table>

            </div>
        </div>
        <!-- Menu Contetn Section Ends -->


<?php include('partials/footer.php'); ?>