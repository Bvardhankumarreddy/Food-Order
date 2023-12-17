<?php

//Incude Constant.php 
include('../config/constant.php');
//1. Get the ID of Admin to be deleted
$id = $_GET['id'];
//2. Create SQL query to Delete Admin
$sql = "Delete From tbl_admin where id=$id";


//Execute the Query
$res = mysqli_query($conn, $sql);


//Check Wheter the query is successfully executed or not
if($res==true){

    //Query Executed successfully and Admin Deleted
    //echo "Admin Deleted"
    //Create Session Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    //Redirect to Manage Admin Page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again Later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3. Redirect to Manage Amdin page with message



?>