<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDERS</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>
    <section class="head">
        <h2>placed orders</h2>
    </section>
    <div class="placed-orders">
        <div class="table">

            <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
    ?>
            <table class="box-table">
                <thead>
                    <tr>
                        <td>
                            <a href="myorder.php?update=<?php echo $fetch_products['id']; ?></a>
                        </td>
                    </tr>
                </thead>
            </table>
            <?php
    }
    }else{
        echo '<p class="empty">no orders placed yet!</p>';
    }
    ?>
        </div>

    </div>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src=" js/script.js"></script>

</body>

</html>