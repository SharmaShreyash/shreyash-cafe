<?php include('partials-front/menu.php');?>

    <!-- FOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 

                // Create SQL Query to display categories from database
                $sql ="SELECT * FROM tbl_category WHERE active ='Yes' AND featured ='Yes' LIMIT 3";
                //execute query
                $res =mysqli_query($conn,$sql);

                // count rows to check cat. availa or not
                $count =mysqli_num_rows($res);

                if($count>0)
                {
                    //get all the data
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id =$row ['id'];
                        $title =$row['title'];
                        $image_name =$row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                            <?php
                                // cheking image is availbale or not
                                if($image_name=="")
                                {
                                    echo "<div class ='error'> Image not Avilable. </div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                            ?>
                           <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    // redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class ='error'> Category not found.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');
                }            
            ?>            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                // Create SQL Query to display categories from database
                $sql2 ="SELECT * FROM tbl_food WHERE active ='Yes' AND featured ='Yes' LIMIT 6";
                //execute query
                $res2 =mysqli_query($conn,$sql2);

                // count rows to check cat. availa or not
                $count2 =mysqli_num_rows($res2);

                // checking food available or not
                if($count2>0)
                {
                    //get all data(food available)
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id =$row2['id'];
                        $title =$row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name =$row2['image_name'];
                        ?>
                       <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                // cheking image is availbale or not
                                if($image_name=="")
                                {
                                    echo "<div class ='error'> Image not Avilable. </div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                            
                            ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail">
                                <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    // redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class ='error'> Category not found.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            ?>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    

    <!-- Contact Section Start Here 
    <section class="contact" id="contact">
        <div class="container text-center">
            <div class="text-center">
                <h2 class="title">Contact me </h2>
                    <div class="contact-content">
                        <div class ="text-center"> 
                            <div class="icons">
                                <div class="row">
                                <i class="fas fa-user"></i>
                            <div class="info">
                            <div class="head">Name</div>
                                <div class="sub-title">Shreyash Sharma</div>
                            </div>
                            <div class="info">
                            <div class="head">Address</div>
                                <div class="sub-title">25 Myrtle Avenue, Bridgeport, CT - 06604</div>
                            </div>
                            <div class="info">
                            <div class="head">Email</div>
                                <div class="sub-title">sharmashreyash.16@gmail.com</div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>  
            </div>
        </div>
    </section>
    contact section Ends Here -->

<?php include('partials-front/footer.php');?>   