<?php include('../admin/partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php

        //1. Get the ID for selected admin
        $id = $_GET['id'];

        //2. Create SQL query to get the details.
        $sql = "Select * from tbl_admin where id=$id";

        //3. Establish the connection 
        $res = mysqli_query($conn, $sql);
        

        //Check whether the query is executed or not.
        if($res==true){

            

            //Check whether the data is avaliable or not
            $count = mysqli_num_rows($res);

            //Check whether we have admin data or not.
            if($count==1){

                //Get the details
                echo "Admin Avaliable";

                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
                // echo $full_name;
                // echo $username;
            }
            else{

                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }


        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>

                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                     </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update_Admin" Class="btn-secondary">

                    </td>

                </tr>
            </table>
        </form>

    </div>


</div>

<?php

//Chek whether submit is clicked or not

if (isset($_POST['submit'])){

    // echo "Button Clicked";
    //Get all the values from form to update

    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];


    //Create a sql query to update admin
    $sql = "Update tbl_admin SET 
    full_name='$full_name', username='$username' where id='$id'";

    //Execute the query 
    $res = mysqli_query($conn, $sql);


    //Check whether the query executed successfully or not

    if($res==true){

        //Query Executed and Admin Updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Succesfully.</div>";
        //Redirect to manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        //Failed to update Admin
        $_SESSION['Update'] = "<div class='error'>Failed to Update Admin.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>

<?php include('../admin/partials/footer.php'); ?>