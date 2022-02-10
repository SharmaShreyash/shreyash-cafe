<?php include('partials/menu.php'); ?>



<div class ="main-content">
    <div class ="wrapper">
        <h1> Update Category</h1>

        <br/><br/>

        <?php
            if(isset($_GET['id']))
            {
                // get id and all other details
                $id = $_GET['id'];

                // create sql query to get all other details
                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res2);

                //get all the data
                $row2 = mysqli_fetch_assoc($res2);

                // Getting the individual values of selected food
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category= $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            }
            else
            {
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage-food.php');

            }

        ?>


        <form action ="" method ="POST" enctype ="multipart/form-data">

            <table class ="tbl-30">

                <tr>
                    <td> Title : </td>
                    <td> 
                        <input type ="text" name="title" value ="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td> Description : </td>
                    <td> 
                        <textarea name = "description" cols="30" rows="5"><?php echo $description;?></textarea>                        
                    </td>
                </tr>

                <tr>
                    <td> Price : </td>
                    <td> 
                        <input type ="number" name="price" value="<?php echo $price;?>" >
                    </td>
                </tr>

                <tr>
                    <td> Current Image : </td>
                    <td> 
                    <?php
                            if($current_image == "")
                            {
                                //display message
                                echo"<div class ='error'> Image not Added. </div>";
                                
                            }
                            else
                            {
                                ///Display Image
                                ?>
                                <img src ="<?php echo SITEURL;?>images/Food/<?php echo $current_image?>" width ="100px">
                                <?php
                            }
                        
                        ?>
                    </td>
                </tr>

                <tr>
                    <td> Select New Image : </td>
                    <td> 
                        <input type="file" name ="image">
                    </td>
                </tr>

                <tr>
                    <td> Category : </td>
                    <td> 
                        <select name ="category">
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
                                        $category_id = $row ['id'];
                                        $category_title =$row['title'];

                                        
                                            echo"<option value = '$category_id'> $category_title</option>";
                                    }
                                }
                                else
                                {
                                    // we dont have categories
                                    //echo"<option value ='0'> Not Available. </option>";
                                    ?>
                                        <option <?php if($current_category == $category_id){echo "Selected";}?> value = "<?php echo $category_id;?>"><?php echo $category_title; ?></option>
                                    <?php
                                    
                                }

                            ?>

                        </select>
                    </td>
                </tr>
               
                <tr>
                    <td> Featured : </td>
                    <td> 
                        <input <?php if($featured =="Yes"){echo "checked";}?> type ="radio" name="featured" value ="Yes">Yes
                        <input <?php if($featured =="No"){echo "checked";}?> type ="radio" name="featured" value ="No">No  

                    </td>
                </tr>
                
                <tr>
                    <td> Active : </td>
                    <td> 
                        <input <?php if($active =="Yes"){echo "checked";}?> type ="radio" name="active" value ="Yes">Yes
                        <input <?php if($active =="No"){echo "checked";}?> type ="radio" name="active" value ="No">No
                    </td>
                </tr>

                <tr>
                    <td> 
                        <input type ="hidden" name="current_image" value ="<?php echo $current_image;?>">
                        <input type ="hidden" name="id" value ="<?php echo $id;?>">
                        <input type ="submit" name="submit" value ="Update Food" class ="btn-secondary"> 
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                // getting all values from the form
                $id =$_POST['id'];
                $title =$_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image =$_POST['current_image'];
                $category = $_POST['category'];
                $featured =$_POST['featured'];
                $active =$_POST['active'];

                // update new image if selected
                // checking whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    // getting the image details
                    $image_name = $_FILES['image']['name'];

                    // checking whether image is available or not
                    if($image_name != "")
                    {
                        // Upload the Image
                        // auto rename image
                        // getting the extension of our image(jpg, png, gif, etc) 
                        $ext = end(explode('.', $image_name));

                        // rename the image
                        $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;
                            
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/Food/".$image_name;

                        // uploading image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // checking image upload or not and if the image is not uploaded
                        // we will stop the process and reirect with error message

                        if($upload ==false)
                        {
                            //set message
                            $_SESSION['upload'] = "<div class = 'error'> Failed to upload new image.</div>";
                            // redirect to add manage food page
                            header('location:'.SITEURL.'admin/manage-food.php');   
                            // stop the process
                            die();
                        }
                        
                        // remove the current Image if available
                        if($current_image!= "")
                        {
                            $remove_path ="../images/Food/".$current_image;

                            $remove =unlink($remove_path);

                            // check whether the image is removed or not
                            // if failed to remove then display message and stop the process

                            if($remove == false)
                            {
                                // failed to remove image
                                $_SESSION['failed-remove'] = "<div class ='error'> Failed to remove Current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php'); 
                                // stop the process
                                die();

                            }

                        }
                    }
                    else
                    {
                        $image_name =$current_image;
                    }

                }
                else
                {
                    $image_name =$current_image;

                }

                
                // update the database
                $sql3 ="UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name ='$image_name',
                    category_id = '$category',
                    featured ='$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                // execute the query
                $res3 = mysqli_query($conn,$sql3);

                // redirect to manage category with message
                // cheking whether executed or not
                if($res3 == true)
                {
                    // category update
                    $_SESSION['update'] = "<div class ='success'> Food Update Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // failed to update category
                    $_SESSION['update'] = "<div class ='error'> Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }     
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>