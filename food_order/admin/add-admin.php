<?php include('../admin/partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php

        if(isset($_SESSION['add'])) //Checking Whether session is set or not
        {

            echo $_SESSION['add']; //Display the Session Message if SET
            unset($_SESSION['add']);//Remove the Session Message
        }
        ?>
 
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td> <input type="text" name="full_name" placeholder="Enter  Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td> <input type="text" name="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td> <input type="password" name="password" placeholder="Enter Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" Value="Add Admin" Class="btn-secondary"/>
                    </td>
                </tr>
            </table>


        </form>
    </div>

</div>


<?php include('../admin/partials/footer.php'); ?>

<?php

//Process the Value from the form

//Check whether the submit button is clicked or not

if(isset($_POST['submit'])){

    //Button Clicked
    // echo "Button Clicked";

    //Get the Data from the FORM 

    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $password = md5($_POST['password']); //passowrd encryption with md5

    // echo $name;
    // echo $email;
    // echo $password;
    echo 'hi';
    //2. SQL QUERY to SAVE the data into database

    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username ='$username',
            password='$password' ";

    // echo $sql;
   
    //3. Execute query and save to the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    // print_r($res);
    //4. Check whether Query is executed or not.
    if($res==TRUE){

        echo 'hi';
        //Data Inserted
        // echo "Data Inserted";
        //Create session variable to display a message
        $_SESSION['add'] = "Admin added succesfully";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{

        //Data Not Inserted
        // echo "Data Not Inserted";
        //Failed to insert data
        //Create session variable to display a message
        $_SESSION['add'] = "Failed to add admin";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/add-admin.php');

    }

}





?>