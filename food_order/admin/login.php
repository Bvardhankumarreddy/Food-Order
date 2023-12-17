<?php include('../config/constant.php');?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head> 

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1><br><br>


            <?php

                if (isset($_SESSION['login'])){

                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }

                if (isset( $_SESSION['no-login-message'])){

                    echo   $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
            ?>

            <br>
            <!-- Login Form Starts Here -->

            <form action="" method="POST" class='text-center'>

            <label >Username:</label> <br>
            <input type="text" name="username" placeholder="Enter username" class='text-center'><br><br>
            <label class='text-center'>Password:</label><br>
            <input type="password" name="password" placeholder="Enter password" class='text-center'><br><br>
            <input type="Submit" name="submit"  value="login" class="btn-primary"><br><br>
            </form>


            <p class='text-center'>Created By - <a href="https://bvardhankumarreddy.github.io/Portfolio/">Bhopathi Vardhan Kumar Reddy</a></p>

        </div>





    </body>

</html>

<?php

    if (isset($_POST['submit'])){

        //Process for Login
        //1. Get the Data from Login Form
       // $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        //$password = md5($_POST['password']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not.
        $sql = "SELECT * from tbl_admin where username= '$username' and password='$password'";


        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1){

            //User Avaliable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it.
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');

        }
        else{

            //User not Avalibale and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }


    }


?>