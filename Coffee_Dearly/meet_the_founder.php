<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login_form.php');
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

if(mysqli_num_rows($check_cart_numbers) > 0){
    $message[] = 'already added to cart!';
    }else{
    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
    $message[] = 'product added to cart!';
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet the Founder</title>

    <!--bootsrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="meet_the_founder.css">
    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!--header section starts-->

    <header class="header">

        <div class="header-1">
            <div class="flex">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <p> New <a href="login_form.php">Login</a> | <a href="register_form.php">Register</a> </p>
            </div>
        </div>

        <div class="header-2">
            <div class="flex">
                <a href="home.php"><img src="images/Coffee Dearly IG Profile (1).png" height="100px" width="100px"></a>

                <nav class="navbar">
                    <a href="home.php">HOME</a>
                    <a href="meet_the_founder.php">ABOUT</a>
                    <a href="shop.php">SHOP</a>
                    <a href="contact.php">CONTACT</a>
                </nav>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Shop by Roast </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Blonde Roast</a></li>
                        <li><a class="dropdown-item" href="#">Medium Roast</a></li>
                        <li><a class="dropdown-item" href="#">Medium-Blonde Roast</a></li>
                        <li><a class="dropdown-item" href="#">Dark Roast</a></li>
                    </ul>
                </div>
                <div class="icons">
                    <div id="menu-btn" class="fas fa-bars"></div>
                    <a href="search_page.php" class="fas fa-search"></a>
                    <div id="user-btn" class="fas fa-user"></div>
                    <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
                    <a href="cart.php"> <i class="fas fa-shopping-cart"></i>
                        <span>(<?php echo $cart_rows_number; ?>)</span>
                    </a>
                </div>

                <div class="user-box">
                    <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                    <a href="logout.php" class="delete-btn">logout</a>
                </div>
            </div>
        </div>

    </header>
    <!--header section ends-->

    <!--about section starts-->
    <section class="about" id="about">
        <div class="row">
            <div class="image-container">
                <img src="images/founder copy.webp">
                <h3>Regine Omboy</h3>
            </div>

            <div class="content">
                <h2>About the Founder</h2></br>
                <p> I've been drinking coffee for the last 3 years and it part of my day to day life. Because of my
                    passion in making coffee at home and experimenting new recipe I told myself one day that I gonna
                    start my own business in coffee industry. I can still remember the time when I tasted an Iced
                    Coffee from a well-known brand for the first time wayback 2021 when I started working in
                    corporate job, I was blown away by the taste of it.
                    So this e-commerce shop is a very important shop wherein people who likes to explore other
                    choices of brands of coffee beeans and the way it was roasted from blonde to dark roast. It is
                    an easy access shop so that customer don't need to go to other places in searching for a
                    specific brand or type of roast. </p></br>
                <p>Coffee is bean part of our lives. Sometimes, we just all need a coffee, and prayer to pull ourselves
                    together. To me, it gives a therapeutic effect in me. </br>
                    “ Stressed, blessed, and coffee obsessed.” Have a great day always! </p></br>
                <h3>My personal social accounts you can reach me out:</h3></br>
                </br>
                <a target="blank" href="https://www.instagram.com/_regineomboy_/"><i
                        class="fab fa-instagram fa-lg "></i></a>
                <a target="blank" href="https://www.facebook.com/regine.omboy"><i
                        class="fab fa-facebook fa-lg "></i></i></a>
                <a target="blank" href="https://www.linkedin.com/in/regine-omboy-a119b5215//"><i
                        class="fab fa-linkedin fa-lg "></i></a>
            </div>
        </div>
    </section>
    <!--about section ends-->

    <!-- footer section starts-->
    <section class="footer">
        <div class="col-3"></div>
        <a href="#" class="top">Back to top</a>
        <div class="copyright">&copy; Copyright 2023 Coffee Dearly</div>
    </section>
    <!-- footer section ends -->



    <!--custom admin js file link-->
    <script src="js/script.js"></script>

</body>

</html>