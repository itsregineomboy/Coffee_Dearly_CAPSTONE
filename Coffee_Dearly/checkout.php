<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
header('location:login_form.php');
}

if(isset($_POST['order_btn'])){
$name = mysqli_real_escape_string($conn, $_POST['name']);
$number = $_POST['number'];
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address'].', '. $_POST['country']);

$total_cost = 0;
$cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($cart_query) > 0){
    while($cart_item = mysqli_fetch_assoc($cart_query)){
        $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
        $total_cost += $sub_total;
    }
}

$total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND email = '$email' AND number = '$number' AND address = '$address' AND total_products = '$total_products' AND total_cost = '$total_cost'") or die('query failed');

if($total_cost == 0){
    $message[] = 'Your cart is empty';
}else{
    if(mysqli_num_rows($order_query) > 0){
        $message[] = 'Order already placed!'; 
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, email, number, address, total_products, total_cost) VALUES('$user_id', '$name', '$email','$number', '$address', '$total_products', '$total_cost')") or die('query failed');
        $message[] = 'Order placed successfully!';
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    }
}

}


?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECKOUT</title>

    <!--bootsrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php include 'header.php'; ?>
    <?php  
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select_cart) > 0){
        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
?>
    <?php
    }
}else{
    echo '<p class="empty">Your cart is empty</p>';
}
?>
    <section class="checkout">
        <form action="" method="post">
            <h3>Place your order</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>NAME:</span>
                    <input type="text" name="name" required placeholder="Enter your name">
                </div>
                <div class="inputBox">
                    <span>PHONE NUMBER:</span>
                    <input type="number" name="number" required placeholder="Enter your phone number">
                </div>
                <div class="inputBox">
                    <span>EMAIL:</span>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>
                <div class="inputBox">
                    <span>COMPLETE ADDRESS:</span>
                    <input type="text" name="address" required placeholder="Enter complete address">
                </div>
                <div class="inputBox">
                    <span>COUNTRY:</span>
                    <input type="text" name="country" required placeholder="e.g. Philippines">
                </div>
            </div>
            <input type="submit" value="order now" class="btn" name="order_btn">
        </form>

    </section>



    <!-- contact section starts -->

    <section class="contact" id="contact">
        <h1 class="heading"><span>CONTACT</span> US </h1>
        <div class="row">

            <form action="">
                <input type="text" placeholder="Name" class="box">
                <input type="email" placeholder="Email" class="box">
                <input type="number" placeholder="Number" class="box">
                <textarea name="" class="box" placeholder="Message" id="" col="30" rows="10"></textarea>
                <input type="submit" value="send message" class="btn">
            </form>

            <div class="iframe">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d981.3243634155091!2d123.8845413!3d10.3180629!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a99fd114acbdab%3A0x7c29b4c6fd76350c!2sBox%20Mini%20Studios%20-%20Guadalupe!5e0!3m2!1sen!2sph!4v1685349611057!5m2!1sen!2sph"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- contact section ends-->
    <!-- footer section starts-->
    <section class="footer">
        <div class="col-3"></div>
        <a href="#" class="top">Back to top</a>
        <div class="copyright">&copy; Copyright 2023 Coffee Dearly</div>
    </section>
    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>