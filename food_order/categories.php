<?php  include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //Display all the categories that are active
                //SQl query
                $sql = "Select * from tbl_category where active='Yes'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                //Check whether categories available or not
                if ($count>0){


                    while ($row = mysqli_fetch_assoc($res)) {

                        //Get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $row['id'];?>">
                            <div class="box-3 float-container">
                                <?php
                                    if ($image_name=""){

                                        //Display meesage if image not avaliable
                                        echo "<div class='error'>Image not Avaliable</div>";

                                    }
                                    else {

                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $row['image_name'];?>" alt="Pizza" class="img-responsive img-curve">

                                    <?php
                                    }
                                    ?>

                                 <h3 class="float-text text-white"><?php echo $row['title']?></h3>
                            </div>
                        </a>



                        <?php




                    }


                }
                else{

                    //Display the error message
                    echo "<div class='error'>Category Not found</div>";
                }



            ?>

           

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

 <?php  include('partials-front/footer.php'); ?>