<?php include('partials-front/menu.php');?>

<!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            // sql query
            $sql ="SELECT * FROM tbl_category WHERE active='Yes'";

            $res =mysqli_query($conn,$sql);

            // count rows to check cat. availa or not
            $count = mysqli_num_rows($res);

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
                            
                            ?>
                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>
                    <?php

                                }
                    }
                }
            else
            {
                // categories not found
                echo"<div class ='error'> Categories not found. </dvi>";
            }
            
            
            
            ?>
         <div class="clearfix"></div>
     </div>
 </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php');?>   