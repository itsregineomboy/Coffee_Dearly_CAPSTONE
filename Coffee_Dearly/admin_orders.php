<?php

include'config.php';

session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login_form.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>
    <?php include 'admin_header.php'; ?>

    <div class="orders">
        <h2 class="title">Placed Orders</h2>
        <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
        <div class="box">
            <table class="box-table">
                <thead>
                    <tr>
                        <th>USER ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>NUMBER</th>
                        <th>ADDRESS</th>
                        <th>TOTAL PRODUCTS</th>
                        <th>TOTAL COST</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        <p><span><?php echo $fetch_orders['user_id'];?></span></p>
                    </td>
                    <td>
                        <p><span><?php echo $fetch_orders['name'];?></span></p>
                    </td>
                    <td>
                        <p><span><?php echo $fetch_orders['email'];?></span></p>
                    </td>
                    <td>
                        <p><span><?php echo $fetch_orders['number'];?></span></p>
                    </td>
                    <td>
                        <p><span><?php echo $fetch_orders['address'];?></span></p>
                    </td>
                    <td>
                        <p><span><?php echo $fetch_orders['total_products'];?></span></p>
                    </td>
                    <td>
                        <p><span><?php echo $fetch_orders['total_cost'];?></span></p>
                    </td>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <td><a href="admin_orders.php?update=<?php echo $fetch_orders['id']; ?>"
                                onclick="return confirm('Proceed with the update?')" class="option-btn">Update</a>
                            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>"
                                onclick="return confirm('Delete this order');" class="delete-btn">Delete</a>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
        <?php
                }
            }else{
                echo '<p class="empty"> No orders placed yet!</p>';
            }
        ?>
    </div>









    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>