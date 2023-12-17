<?php include('../admin/partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>


        <br><br>

        <?php

        if(isset($_SESSION['upload'])){


            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data" >
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" row="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>

                        <input type="number" name="price">

                    </td>

                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            //Create PHP code to display ategories from database
                            //1.Create SQL to get all active categories from database
                            $sql1 = "Select * from tbl_category where active='Yes'";

                            //Execute the query
                            $res = mysqli_query($conn, $sql1);

                            //Count Rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);
                            // print_r()

                            //If the count is greater than zero, we have categories else we don't have categories
                            if($count>0){

                                //We have Categories
                                while($row = mysqli_fetch_assoc($res)){

                                    //get the details of the categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    // echo $id .''.$title.'';
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php


                                }
                            }
                            else{

                                //We don't have categories
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }

                            //2. Display the Options


                            ?>
                            <!-- <option value="1">Food</option> -->
                            <!-- <option value="2">Snacks</option> -->
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary" >

                    </td>
                </tr>

            </table>

        </form>
        <?php

        //Check whether the button is clicked or not
        if(isset($_POST['submit'])){

            //Add the Food in Database
            //echo "Clicked";

            //1. Get the Data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //Check whether radio button clicked for featured and active are checked or not
            if(isset($_POST['featured'])){

                $featured = $_POST['featured'];

            }
            else{

                $featured = "No"; //Setting the default value 
            }
            if(isset($_POST['active'])){

                $active = $_POST['active'];

            }
            else{

                $active = "No";//Setting the default value
            }

            //2. Upload the Image if selected
            //Check whether the select image is clicked or not and upload the image only if the image is selected
            if(isset($_FILES['image']['name'])){

                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //Check whether the image is selected or not and upload the image only if selected
                if($image_name!=""){

                    //Image is Selected
                    //A. Rename the Image
                    //Get the extension of selected image (jpg, png, gif, etc)
                    $ext = end(explode('.',$image_name));

                    //Create New Name for Image
                    $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image name may be "Food-Name-657.jpg"

                    //B. Upload the image
                    //Get the src path and destination path.


                    //Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //Destination Path for the image to upload
                    $dest = "../images/food/".$image_name;

                    //Finally upload the food image
                    $upload = move_uploaded_file($src, $dest);

                    //Check whether image upload or not
                    if ($upload ==false){

                        //Failed to upload the image
                        //Redirect to Add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the Image.</div>" ;
                        header('location:'.SITEURL.'admin/add-food.php');
                        //Stop the process
                        die();
                    }

                }

            }
            else{

                $image_name = ""; //Setting the default value is blank
            }

            


            //3. Insert into Database


            //Create a sql query to save or add food
            //For numerical we don't not need to pass value inside quotes '' But for string value it is complusory to add quotes
            $sql = "Insert into tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";

            //Execute the query 
            $res = mysqli_query($conn, $sql);

            if ($res==true){

                //Data inserted successfully
                $_SESSION['add'] = "<div Class='success'>Food Added Succesfully</div>";
                //Redirect MAnage-food.php
                header('location:'.SITEURL.'admin/manage-food.php');


            }
            else{

                //Failed to Insert Data
                $_SESSION['add'] = "<div Class='error'>Failed to Add Food...</div>";
                //Redirect to Manage-food.php
                header('location:'.SITEURL.'admin/manage-food.php');


            }

            //4. Redirect with Message to Manage Food



        }


        ?>
    </div>
</div>




<?php include('../admin/partials/footer.php'); ?>