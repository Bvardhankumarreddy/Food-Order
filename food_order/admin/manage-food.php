<?php include('../admin/partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br> 

        <!-- Button to Add admin -->
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
        
        <br><br><br>


        <?php

        if(isset($_SESSION['add'])){


            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['remove'])){


            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete-food'])){


            echo $_SESSION['delete-food'];
            unset($_SESSION['delete-food']);
        }
        if(isset($_SESSION['unauthorize'])){


            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if(isset($_SESSION['no-food-found'])){


            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }
        if(isset($_SESSION['upload'])){


            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove'])){


            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        if(isset($_SESSION['update'])){


            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>


        <table class="tbl-full">
            <tr>
                <th>Sl.No</th>
                <th>Title</th>
                <th>Price(Rs)</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php


            //Create a sql get all the food
            $sql = "Select * from tbl_food";

            //Execute the Execute the query 
            $res = mysqli_query($conn, $sql);


            //Count rows to check whether e have foods or not
            $count = mysqli_num_rows($res);

            //Create a serial number variable and set default value as 1
            $sn = 1;

            if($count>0){

                //We have food in Database
                //Get the Foods from Database and Display
                while($row = mysqli_fetch_assoc($res)){

                    //get the values from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title; ?></td>
                        <td>Rs<?php echo $price; ?></td>
                        <td>
                            <?php  

                            //Check Whether image avaliable or not
                            if($image_name!=""){

                                //Display the Image
                                ?>
                                <img src ="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                                <?php



                            }
                            else{

                                //Display the Message
                                echo "<div class='error'>Image Not Added</div>";
                            }
                            
                            
                            
                            
                            ?>
                        </td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a> 
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a> 
                        </td>


                    </tr>

                    <?php


                }
            }
            else{


                //Food not avaliable in the database
                echo "<tr><td colspan='7' class='error'>Food not added Yet. </td></tr>";
            }

            ?>
           
            
            



        </table>
    </div>

</div>

<?php include('../admin/partials/footer.php'); ?>