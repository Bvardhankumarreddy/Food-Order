<?php include('../admin/partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php

            //Check whether the id is set or not
            if(isset($_GET['id'])){

                //Get the ID and all other details
                // echo "Getting the data";
                $id = $_GET['id'];

                //Create an SQL query to get all the other details
                $sql = "Select * from tbl_food where id=$id";

                //Execute the query
                $res = mysqli_query($conn,$sql);
                
                 //count the rows to check whether the id is valid or not
                 $count = mysqli_num_rows($res);

                if($count>0){

                //Get all the data
                    $row2=mysqli_fetch_assoc($res);
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                }
                else {

                    //redirect to manage food with session message
                    $_SESSION['no-food-found'] = "<div class='error'>Food Not found.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }


            }
            else {

                //redirect to Manage Category
                $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        ?>

<form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" row="5" ><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price (RS): </td>
                    <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                </tr>

                <tr>
                    <td style="display:flex;">Current Image: </td>
                    <td>
                        <?php

                            if($current_image != "")
                            {
                                //Display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px">
                                <?php

                            }
                            else{

                                //Display Message
                                echo "<div class='error'>Image Not Added</div>";

                                
                            }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php

                            //Query to Get Active Categories
                            $sql1 = "SELECT * from tbl_category where active='Yes'";

                            //Execute the query
                            $res = mysqli_query($conn,$sql1);

                            //Count rows
                            $count = mysqli_num_rows($res);

                            //Check whether category avalibale or not
                            if($count>0){

                                while($row = mysqli_fetch_assoc($res)){

                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    ?>
                                    echo <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>;

                                    <?php


                                }

                            }
                            else{

                                //Category not available 
                                echo "<option value='0'>Category Not avaliable</option>";
                            }


                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=='Yes'){echo 'checked';} ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=='No'){echo 'checked';} ?> type="radio" name="featured" value="No">No
                    </td>

                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=='Yes'){echo 'checked';} ?>  type="radio" name="active" value="Yes">Yes

                        <input <?php if($active=='No'){echo 'checked';} ?> type="radio" name="active" value="No">No
                    </td>

                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        if (isset($_POST['submit'])){

            // echo "Clicked";
            //1.Get all the values from our form
            $id =   $_POST['id'];
            $title =   $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];



            //2. Updating New Image if selected
            //Check whether image is upload or not
            if(isset($_FILES['image']['name'])){

                //Get the image details
                $image_name = $_FILES['image']['name'];

                //Check whether image avaliabel or not
                if($image_name!=""){

                    //Image Avaliable
                    //A.Upload New Image

                    //Auto rename the image
                    //Get the extensionof our img (jpg, png, gf, etc)
                    $ext = end(explode('.',$image_name));

                    //Rename the Image
                    $image_name = "Food-Name-".rand(000, 9999).'.'.$ext;


                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/food/".$image_name;

                    //Finally Upload the image 
                    $upload = move_uploaded_file($source_path,$destination_path);

                    //Check whether the image is uploaded or not.
                    //And if the image is not uploaded then we will stop the process and redirect the error message.

                    if ($upload==false){

                        //Set message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload the image.</div>";
                        //Redirect to add category page
                        header('location:'.SITEURL.'admin/add-food.php');
                        
                        //Stop the process
                        die();
                    }

                    //B. Remove the current Image
                    if($current_image!=""){

                        $remove_path = "../images/food/".$current_image;

                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        //If failed to remove then display message and stop the process
                        if($remove==false){

                            //Failed to remove image
                            $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current Image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die(); //Stop the process
                        }


                    }


                }

                else {

                    $image_name = $current_image; //Default image when image not selected
                }


            }
            else{

                

                $image_name = $current_image; //Default image whem button is not clicked.


            }

            //3. Update the Database
            $sql3 = "UPDATE tbl_food SET
            title='$title',
            price='$price',
            description='$description',
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            where id=$id
            ";

            //Execute the query
            $res3 = mysqli_query($conn, $sql3);

            //4. Redirect to manage category with message
            //Check whether executed or not
            if ($res3==true){

                $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{

                $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');


            }


        }

        ?>


    </div>
</div>

<?php include('../admin/partials/footer.php'); ?>