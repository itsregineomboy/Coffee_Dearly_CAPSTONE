<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
header('location:login_form.php');
}

if(isset($_POST['update_cart'])){
$cart_id = $_POST['cart_id'];
$cart_quantity = $_POST['cart_quantity'];
mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
$message[] = 'Cart quantity updated!';
}

if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];
mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
header('location:cart.php');
}

if(isset($_GET['delete_all'])){
mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
header('location:cart.php');
}

?>



<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

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

    <section class="shopping-cart">
        <div class="title">
            <h2>Product Added</h2>
        </div>

        <div class="box-container">
            <?php
$grand_total = 0;
 $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_cart) > 0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
?>
            <div class="box">
                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times"
                    onclick="return confirm('delete this from cart?');"></a>
                <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100rem" alt="">
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <div class="price">₱<?php echo $fetch_cart['price']; ?></div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" name="update_cart" value="update" class="option-btn">
                </form>
                <div class="sub-total">SUBTOTAL :
                    <span>₱<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?></span>
                </div>
            </div>
            <?php
$grand_total += $sub_total;
}
}else{
echo '<p class="empty">Your cart is empty</p>';
}
?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>"
                onclick="return confirm('delete all from cart?');">DELETE ALL</a>
        </div>

        <div class="cart-total">
            <h2>GRAND TOTAL: <span>₱<?php echo $grand_total; ?></span></h2>
            <div class="flex">
                <a href="shop.php" class="option-btn">Continue shopping</a>
                <a href="checkout.php" class="option-btn" <?php echo ($grand_total > 1)?'':'disabled'; ?>>Proceed to
                    Checkout</a>
            </div>
        </div>
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