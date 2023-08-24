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
    <title>Home</title>

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

    <!--placed orders section start-->

    <section class="placed-orders">
        <h2>PLACED ORDERS</h2>
        <div class="box-container">

            <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
    ?>
            <div class="box">
                <p>NAME : <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p>EMAIL : <span><?php echo $fetch_orders['number']; ?></span> </p>
                <p>NUMBER : <span><?php echo $fetch_orders['email']; ?></span> </p>
                <p>ADDRESS : <span><?php echo $fetch_orders['address']; ?></span> </p>
                <p>PRODUCT : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                <p>TOTAL : <span>₱<?php echo $fetch_orders['total_cost']; ?></span> </p>
            </div>
            <?php
    }
    }else{
        echo '<p class="empty">no orders placed yet!</p>';
    }
    ?>
        </div>

    </section>
    <!--placed orders section ends-->
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