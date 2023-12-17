<?php 

    //Includes Constants Page
    include('../config/constant.php');  


    //echo "delete food page";

    if(isset($_GET['id']) AND isset($_GET['image_name'])) {


       //Get the value and Delete
        // echo "Get the value and Delete";

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

         //Remove the physical image file that is avalibale

         if ($image_name!=""){
            //Image is avaliable so remove it
            $path = "../images/food/".$image_name;

            //Remove the Image
            $remove = unlink ($path);


            //If failed to remove image then add an error message and stop the process
            if($remove==false){

                //Set the session Message
                $_SESSION['remove'] = "<div class='error'>Failed to remove food Image.</div>";

                //Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-food.php');

                //Stop the process
                die ();
            }



        }


        //Delete from Database
        //SQL Query to delete data from database
        $sql = "Delete from tbl_food where id=$id";


        //Execute the query
        $res = mysqli_query($conn,$sql);

        //check whether the data is delete from database
        if($res==true){

            //Set Success Message and Redirect
            $_SESSION['delete-food'] = "<div class='success'>Food Deleted successfully.</div>";

            //Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{

            //Set Fail Message and Redirect
            $_SESSION['delete-food'] = "<div class='error'>Failed to Delete the Food.</div>";

            //Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-food.php');


        }




    }
    else {

        //Redirect to Manage Food Page
        //echo "Redirect"
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }




?>

