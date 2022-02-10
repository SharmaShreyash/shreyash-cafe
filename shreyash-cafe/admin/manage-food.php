<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class ="main-content">
            <div class ="wrapper">
                <h1>Manage Food</h1>
                <br/><br/><br/><br/>
                       
                <!-- Button to Add Admin -->
                <a href = "<?php echo SITEURL; ?>admin/add-food.php" class = "btn-primary">Add Food</a>

                <br/><br/><br/><br/>

                <?php
                    if(isset($_SESSION['add'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['add']; // Display session message
                        unset($_SESSION['add']); //Removing session message
                    }
                    if(isset($_SESSION['delete'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['delete']; // Display session message
                        unset($_SESSION['delete']); //Removing session message
                    }
                    if(isset($_SESSION['upload'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['upload']; // Display session message
                        unset($_SESSION['upload']); //Removing session message
                    }
                    if(isset($_SESSION['unauthorized'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['unauthorized']; // Display session message
                        unset($_SESSION['unauthorized']); //Removing session message
                    }
                    if(isset($_SESSION['update'])) // checking whether the session is set or not
                    {
                        echo $_SESSION['update']; // Display session message
                        unset($_SESSION['update']); //Removing session message
                    }

                ?>

                    <table class = "tbl-users"> 
                            <tr> 
                                <th> Sr. No. </th>
                                <th> Title </th>
                                <th> Price </th>
                                <th> Image </th>
                                <th> Feature </th>
                                <th> Active </th>
                                <th> Actions </th>


                            </tr>

                            <?php 
                                // creating sql query to get all foods
                                $sql ="SELECT * FROM tbl_food";

                                // Execute the query
                                $res = mysqli_query($conn,$sql);

                                // counting rows if have any food items
                                $count = mysqli_num_rows($res);
                                
                                // create serial number variable and assign value as 1.
                                 $sn =1;

                                if($count>0)
                                {
                                    while($row =mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $price = $row['price'];
                                        $image_name = $row['image_name'];
                                        $featured = $row['featured'];
                                        $active = $row['active'];

                                        ?> 
                                            <tr>
                                                <td> <?php echo $sn++;?>.</td>
                                                <td> <?php echo $title;?> </td>
                                                <td> <?php echo $price;?></td>
                                                <td>
                                                    <?php 
                                                        //checling image name is available or not
                                                        if($image_name == "")
                                                        {
                                                            // display the message
                                                            echo "<div class ='error'>Image not added.</div>";
                                                        }
                                                        else
                                                        {
                                                            //displlay the image
                                                            ?>
                                                            <img src ="<?php echo SITEURL;?>images/Food/<?php echo $image_name;?>" width="100px">
                                                            <?php

                                                        }
                                                    
                                                    
                                                    ?>                                                    
                                                </td>
                                                <td> <?php echo $featured;?> </td>
                                                <td> <?php echo $active;?> </td>
                                                <td> 
                                                <a href = "<?php echo SITEURL; ?>admin/update-food.php? id=<?php echo $id;?>" class = "btn-secondary">Update Food</a>
                                                <a href = "<?php echo SITEURL; ?>admin/delete-food.php? id=<?php echo $id;?> &image_name=<?php echo $image_name; ?>" class = "btn-danger">Delete Food</a>
                                                    </td>
                                            </tr>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    // food not added in databse
                                    echo "<tr> <td colspan ='7' class='error'> Food not Added Yet.</td> </tr>";
                                }
                            ?>

                            

                    </table>

            </div>
        </div>
        <!-- Menu Contetn Section Ends -->


<?php include('partials/footer.php'); ?>