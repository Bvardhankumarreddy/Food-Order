<?php

    //Include Constant File
    include('../config/constant.php');


    //Check whether the id and image_name value is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name'])) {

        //Get the value and Delete
        // echo "Get the value and Delete";

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        //Remove the physical image file that is avalibale

        if ($image_name!=""){
            //Image is avaliable so remove it
            $path = "../images/category/".$image_name;

            //Remove the Image
            $remove = unlink ($path);


            //If failed to remove image then add an error message and stop the process
            if($remove==false){

                //Set the session Message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category Image.</div>";

                //Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');

                //Stop the process
                die ();
            }

        }

        //Delete from Database
        //SQL Query to delete data from database
        $sql = "Delete from tbl_category where id=$id";


        //Execute the query
        $res = mysqli_query($conn,$sql);

        //check whether the data is delete from database
        if($res==true){

            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted successfully.</div>";

            //Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');


        }
        else{

            //Set Fail Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete the Category.</div>";

            //Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');


        }

        //Redirect to Manage Category Page with Message
    }
    else {

        //refirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>