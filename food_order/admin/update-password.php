<?php include('../admin/partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br> 

        <?php

        if(isset($_GET['id'])){

            $id = $_GET['id'];
        }

        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Old Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="old password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>
            </table>
            
        </form>
    </div>
</div>
<?php

        if(isset($_POST['submit'])){

            //echo "clicked";


            //1.Get the Data from Form
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);


            //2.Check Whether the user with current ID and current passowrd exists or not.

            $sql = "Select * from tbl_admin where id=$id and password='$current_password'";

            //Execute the Query
            $res = mysqli_query($conn,$sql);

            if ($res==true){

                //Check whether data is not avaliable or not.
                $count = mysqli_num_rows($res);

                if ($count==1){

                    //User exists and password can be changed
                    // echo "User Found";

                    //Check whether the new password is matching with confirm password
                    if($new_password==$confirm_password){

                        //Update the Password
                        // echo "Password Match";

                        $sql2 = "Update tbl_admin set password='$new_password' where id=$id";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res==true){
                            
                            //Display the success message
                            $_SESSION['Change-Pwd'] = "<div class='success'>Password Changed Successfully.</div>"; 

                            //Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else{

                            //Display the error message
                            $_SESSION['Change-Pwd'] = "<div class='error'>Failed to change passowrd.</div>"; 

                            //Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else{

                        //Redirect to Manage admin page with an error message
                        $_SESSION['password-not-matching'] = "<div class='error'>New Password is not matching Confirm Passowrd.</div>"; 

                        //Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }

                }
                else{

                    //User doesn't exists and password cannot be changed

                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>"; 

                    //Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }


            }

            //3.Check Whether New password and confirm password match or not.


        }





?>

<?php include('../admin/partials/footer.php'); ?>