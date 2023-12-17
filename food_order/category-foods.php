
<?php  include('partials-front/menu.php');?>

    <?php

    //Check whether id is passed or not
    if (isset($_GET['category_id'])){

        //category id is set nd get the id
        $category_id = $_GET['category_id'];
        //Get the category title based on category id
        $sql = "Select title from tbl_category where id=$category_id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Get the value from database
        $row = mysqli_fetch_assoc($res);

        //Get the Title
        $category_title = $row['title'];



    }
    else{

        //Category not passed
        //Redirect to Home page
        header('location:'.SITEURL);

    }


    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Create sql query to get foods based on on selected category
            $sql2 = "Select * from tbl_food where category_id=$category_id";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Count the Rows
            $count2 = mysqli_num_rows($res2);

            //Check whether food is avaliable or not
            if($count2>0){

                //Food is avaliable
                while($row2=mysqli_fetch_assoc($res2)){

                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
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
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $row2['image_name'];?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php


                                }


                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $row2['title'];?></h4>
                            <p class="food-price">Rs. <?php echo $row2['price'];?></p>
                            <p class="food-detail">
                                <?php echo $row2['description'];?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $row2['id'];?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    

                    <?php
                } 


            }
            else{

                //Food not avaliable
                echo "<div class='error'>Food not avaliable</div>";

            }

            ?>




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php  include('partials-front/footer.php');?>  