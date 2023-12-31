<?php
    include('../admin/partials/menu.php');  

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 

        //Check whether the id is set or not
        if(isset($_GET['id'])){

            //Get the ID and all other details
            // echo "Getting the data";
            $id = $_GET['id'];
            //Create an SQL query to get all the other details
            $sql = "Select * from tbl_category where id=$id";

            //Execute the query
            $res = mysqli_query($conn,$sql);

            //count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1){

                //Get all the data
                $row=mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else {

                //redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category Not found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else {

            //redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>

                <tr>
                    <td style="display:flex;">Current Image: </td>
                    <td>
                        <?php

                            if($current_image != "")
                            {
                                //Display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="100px">
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
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];



            //2. Updating New Image if selected
            //Check whether image is upload or not
            if(isset($_FILES['image']['name'])){

                //Get the image details
                $image_name = $_FILES['image']['name'];

                //Check whether image avaliabel or not
                if($image_name){

                    //Image Avaliable
                    //A.Upload New Image

                    //Auto rename the image
                    //Get the extensionof our img (jpg, png, gf, etc)
                    $ext = end(explode('.',$image_name));

                    //Rename the Image
                    $image_name = "Food_Category_".rand(000, 9999).'.'.$ext;


                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    //Finally Upload the image 
                    $upload = move_uploaded_file($source_path,$destination_path);

                    //Check whether the image is uploaded or not.
                    //And if the image is not uploaded then we will stop the process and redirect the error message.

                    if ($upload==false){

                        //Set message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload the image.</div>";
                        //Redirect to add category page
                        header('location:'.SITEURL.'admin/add-category.php');
                        
                        //Stop the process
                        die();
                    }

                    //B. Remove the current Image
                    if($current_image!=""){

                        $remove_path = "../images/category/".$current_image;

                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        //If failed to remove then display message and stop the process
                        if($remove==false){

                            //Failed to remove image
                            $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current Image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die(); //Stop the process
                         }


                    }
                    



                    //Remove the current image
                }
                else {

                    //Image Not avaliable
            
                }


            }
            else{

                $image_name = $current_image;


            }

            //3. Update the Database
            $sql = "UPDATE tbl_category SET
            title='$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            where id=$id
            ";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //4. Redirect to manage category with message
            //Check whether executed or not
            if ($res==true){

                $_SESSION['update'] = "<div class='success'>Catgory Update Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{

                $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');


            }


        }

        ?>


    </div>

</div>

<?php include('../admin/partials/footer.php'); ?>