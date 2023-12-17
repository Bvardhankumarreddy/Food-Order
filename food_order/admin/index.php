<?php include('../admin/partials/menu.php'); ?>

        <!-- Main content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                
                <br><br>


                <?php

                if (isset($_SESSION['login'])){

                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                
                ?>

                <br><br>


                <div class="col-4 text-center">
                    <?php

                    //Sql query
                    $sql = "Select * from tbl_category";
                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php

                    //Sql query
                    $sql1 = "Select * from tbl_food";
                    //Execute the query
                    $res1 = mysqli_query($conn, $sql1);

                    $count1 = mysqli_num_rows($res1);

                    ?>
                    <h1><?php echo $count1; ?></h1>
                    <br>
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php

                    //Sql query
                    $sql2 = "Select * from tbl_order";
                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);

                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Total Orders
                </div>
                <div class="col-4 text-center">
                    <?php

                    //Sql query
                    $sql3 = "Select sum(total) as Total from tbl_order where status='Delivered'";
                    //Execute the query
                    $res3 = mysqli_query($conn, $sql3);

                    //Get the value
                    $row3 = mysqli_fetch_assoc($res3);

                    //Get the Total revenue
                    $total_revenue = $row3['Total'];

                    ?>
                    <h1>Rs.<?php  echo $total_revenue; ?></h1>
                    <br>
                    Revenue Generated
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content Section Ends -->

<?php include('../admin/partials/footer.php'); ?>