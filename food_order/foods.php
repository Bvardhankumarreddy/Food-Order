<?php  include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Getting all the foods from database that are active and featured
            //SQL query
            $sql2 = "Select * from tbl_food where active='Yes' and featured='Yes' Limit 6";

            //Excute the query
            $res2 = mysqli_query($conn, $sql2);

            //Count rows
            $count2 = mysqli_num_rows($res2);
            
            //Check whether food avaliable or not.
            if($count2>0){
                 
                //Food avaliable
                while($row=mysqli_fetch_assoc($res2)){

                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                //Check Whether image avaliable or not
                                if ($image_name==""){

                                    //Image not avaliable
                                    echo "<div class'error'>Image not avaliable</div>";
                                    

                                }
                                else{

                                    //Image Avaliable
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $row['image_name'];?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php


                                }


                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $row['title'];?></h4>
                            <p class="food-price"><?php echo $row['price'];?></p>
                            <p class="food-detail">
                                <?php echo $row['description'];?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $row['id'];?>" class="btn btn-primary">Order Now</a>
                        </div>
                            </div>

                    <?php
                }
            }

            else{

                //Food not avaliable 
                echo "<div class='error'>Food not avaliable.</div>";

            }

            ?>

            
            
            
            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php  include('partials-front/footer.php');?>