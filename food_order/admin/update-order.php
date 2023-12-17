<?php include('../admin/partials/menu.php');  ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php

        //Check whether id is set or not
        if(isset($_GET['id'])){

            // echo $_GET['id'];

            //Get the order details
            $id = $_GET['id'];

            // echo $id;
            //Get all oher details based on this id
            //SQL query to select the alldetails based on the id
            $sql = "Select * from tbl_order where id=$id";

            //Execute the query 
            $res = mysqli_query($conn,$sql);
            // print_r($res);

            //Count Rows
            $count = mysqli_num_rows($res);


            // print_r($count);

            if ($count==1){

            
                // print_r($count);
                //Order details avaliable
                $row = mysqli_fetch_assoc($res);
                // print_r($row);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                // echo $food." ,".$price." ,".$qty." ,".$status." ,".$customer_name." ,".$customer_contact." ,".$customer_email." ,".$customer_address;
           

            }
            else{

                    //Order details not avaliable
                    //Redirect to manage order php
                   header('location:'.SITEURL.'admin/manage-order.php');


            }

        }
        else{

            //Redirect to manage order php
           header('location:'.SITEURL.'admin/manage-order.php'); 


        }


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td style="display: flex";>Food Name </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price </td>
                    <td><b> $ <?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty </td>
                    <td>
                        <input  type='number' name='qty' value="<?php echo $qty;?>">
                    </td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>
                        <Select name="status">
                            <option <?php if($status=="Ordered"){ echo "selected";}?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){ echo "selected";}?>value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){ echo "selected";}?>value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){ echo "selected";}?>value="Cancelled">Cancelled</option>
                        </Select>
                    </td>


                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo  $price;?>">
                        <input type="submit" name="submit" value="update order" class="btn-secondary">
                    </td>

                </tr>

            </table>
        </form>

        <?php

        if (isset($_POST['submit'])){


            //echo clicked
            //Get all the values from the form

            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            //Write SQL query to update the value
            $sql2 = "Update tbl_order SET 
            
            qty = $qty, 
            total = $total, 
            status = '$status', 
            customer_name= '$customer_name', 
            customer_contact='$customer_contact', 
            customer_email = '$customer_email',
            customer_address='$customer_address' where id=$id ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);


            //check whether update or not
            if ($res==true){

                //Updated
                $_SESSION['updated'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');


            }
            else{

                $_SESSION['updated'] = "<div class='error'>Failed to update the Order</div>";
                header('location:'.SITEURL.'admin/manage-order.php');


            }

             
        }


        ?>

    </div>
</div>


<?php include('../admin/partials/footer.php'); ?>