<?php include('partials/menu.php');?>

        <!-- Main Content Section Starts -->
        <div class ="main-content">
            <div class ="wrapper">
                <h1>DASHBOARD</h1>
                </br></br>

                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login']; // Display session message
                        unset($_SESSION['login']); //Removing session message
                    }
                ?>
                 </br></br>
                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Categories
                </div>
                <div class="clearFix"></div>
            </div>
        </div>
        <!-- Menu Contetn Section Ends -->

<?php include('partials/footer.php'); ?>