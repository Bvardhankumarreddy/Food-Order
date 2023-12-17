<?php include('../admin/partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php

            if (isset($_SESSION['add'])){

                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])){

                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>
        <!--- Add category form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary"/>
                </tr>
            </table>
        </form>
        <!--- Add category form Ends -->

        <?php

        if(isset($_POST['submit'])){

           // echo 'clicked';

           //1. Get the value from Category form
           $title = $_POST['title'];

           //For radio input, we need to check whether the button is selected or not.

           if (isset($_POST['featured'])){
                //Get the value from form 
                $featured = $_POST['featured'];
           }
           else{

                $featured = 'No';
           }

           if (isset($_POST['active'])){

                //Get the value from form 
                $active = $_POST['active'];

            }

            else{

                $active = 'No';

            }

            //Check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);

            //die(); //Break the code here

            if(isset($_FILES['image']['name']))
            {
                //Upload the Image
                //To upload image we need image name, source path and destination Path
                $image_name = $_FILES['image']['name'];
                // print_r($image_name);

                //Upload the image if only selected

                if ($image_name != ""){

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
                        header('location:'.SITEURL.'admin/dd-category.php');
                        
                        //Stop the process
                        die();
                    }
                }  

            }
            else{

                //Don't upload image and set image_name as blank
                $image_name="";
            }

            //2. Create an SQL query to onsert the data into table.
            $sql = "Insert INTO tbl_category SET
                    title='$title',
                    image_name = '$image_name',
                    featured='$featured',
                    active = '$active'
            ";

            // print_r($sql); exit;
            
            //3. Execute the query and Save in Database

            $res = mysqli_query($conn, $sql);

            if ($res==true){
                
                //Query executed and category added
                $_SESSION['add'] = "<div class='success'>Category Added Succesfully.</div>";

                //Redirect to Manage category Page
                header('location:'.SITEURL.'admin/manage-category.php');

            }

            else{

                //Failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to add category</div>";

                //Redirect to Manage category Page
                header('location:'.SITEURL.'admin/add-category.php');


            }

        }

        ?>




    </div>
</div>





<?php include('../admin/partials/footer.php'); ?>