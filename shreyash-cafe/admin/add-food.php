<?php include('partials/menu.php'); ?>

<div class ="main-content">
    <div class ="wrapper">
        <h1>Add Food</h1>
            </br></br></br></br>

            <?php
                if(isset($_SESSION['upload'])) // checking whether the session is set or not
                {
                    echo $_SESSION['upload']; // Display session message
                    unset($_SESSION['upload']); //Removing session message
                }

            ?>

            <form action="" method="POST" enctype ="multipart/form-data">
                    <table class ="tbl-30">

                        <tr>
                            <td> Title : </td>
                            <td> 
                                <input type ="text" name="title" placeholder ="Food Title">
                            </td>
                        </tr>

                        <tr>
                            <td> Description : </td>
                            <td> 
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td> Price : </td>
                            <td> 
                                <input type ="number" name="price">
                            </td>
                        </tr>

                        <tr>
                            <td> Select Image : </td>
                            <td> 
                                <input type ="file" name="image" >
                            </td>
                        </tr>

                        <tr>
                            <td> Category : </td>
                            <td> 
                                <select name = "category">

                                    <?php 
                                        //display active categories from data bases
                                        // SQL 
                                        $sql ="SELECT * FROM tbl_category WHERE active ='Yes'";

                                        // Execute query
                                        $res = mysqli_query($conn,$sql);

                                        // Count rows to check whether we have categories or not
                                        $count = mysqli_num_rows($res);

                                        //if count > 0 we have categories else not
                                        if($count >0)
                                        {
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                                // getting details of categories
                                                $id = $row ['id'];
                                                $title =$row['title'];

                                                ?>
                                                    <option value = "<?php echo $id;?>"><?php echo $title; ?></option>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            // we dont have categories
                                            ?>
                                            <option value ="0"> No categories Found</option>
                                            <?php
                                        }


                                    
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td> Featured : </td>
                            <td> 
                                <input type ="radio" name="featured" value ="Yes">Yes
                                <input type ="radio" name="featured" value ="No">No 

                            </td>
                        </tr>

                        <tr>
                            <td> Active : </td>
                            <td> 
                                <input type ="radio" name="active" value ="Yes">Yes
                                <input type ="radio" name="active" value ="No">No 
                            </td>
                        </tr>

                        <tr>
                            <td colspan ="2">
                                <input type ="submit" name="submit" value ="Add Food" class ="btn-secondary"> 
                            </td>
                        </tr>


                    </table>
            </form>
            <?php
                // Check whether the submit is clicked or not

                if(isset($_POST['submit']))
                {

                    // Get the data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST ['price'];
                    $category =$_POST['category'];

                    // for radio input, we need to check whether the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        // get the value from for
                        $featured =$_POST['featured'];                        
                    }
                    else
                    {
                        // set the default value
                        $featured ="No";
                    }
                    
                    if(isset($_POST['active']))
                    {
                        $active =$_POST['active'];                        
                    }
                    else
                    {
                        $active="No";
                    }

                    // cheking whether the image is selected and set value accordingly.
                    if(isset($_FILES['image']['name']))
                    {
                        //we need source, path and name of the image and destination
                        $image_name = $_FILES['image']['name'];

                        //Upload the image only if image is selected
                        if($image_name != "")
                        {

                            // auto rename image
                            // getting the extension of our image(jpg, png, gif, etc) 
                            $ext = end(explode('.', $image_name));

                            // rename the image
                            $image_name = "Food-Name-".rand(000,999).'.'.$ext;
                            
                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/Food/".$image_name;

                            // uploading image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // checking image upload or not and if the image is not uploaded
                            // we will stop the process and reirect with error message

                            if($upload ==false)
                            {
                                //set message
                                $_SESSION['upload'] = "<div class = 'error'> Failed to upload image.</div>";
                                // redirect to add category page
                                header('location:'.SITEURL.'admin/add-food.php');   
                                // stop the process
                                die();
                            }
                        }
                    }                    
                    else
                    {
                         // dont upload image and set the image name and value
                        $image_name ="";
                    }
                    

                    // SQL Query to save the data into database
                     $sql2 = "INSERT INTO tbl_food SET
                     title = '$title',
                     description = '$description',
                     price = $price,
                     image_name = '$image_name',
                     category_id = $category,
                     featured = '$featured',
                     active ='$active'
                     ";

                    // Executing Query and Saving data into database
                    $res2 = mysqli_query($conn, $sql2);

                    // Checking whether the (query is executed) data is inserted or not and display appropriate message
                    if($res2 == true)
                    {
                        //echo "Data Inserted";
                        // Create a session variable to display message
                        $_SESSION['add'] = "<div class ='success'> Food Added Succesfully. </div>";
                        //Redirect Page to Manage category
                        header("location:".SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        /// Create a session variable to display message
                        $_SESSION['add'] = "<div class ='error'> Failed to add Food. </div>";
                        //Redirect Page to Manage category
                        header("location:".SITEURL.'admin/manage-food.php');
                    }
                }                    
            ?>
     </div>
</div>

<?php include('partials/footer.php'); ?>
