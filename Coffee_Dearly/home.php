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
    $message[] = 'Already added to cart!';
    }else{
    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
    $message[] = 'Product added to cart!';
    }

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

    <!-- home section starts-->
    <section class="home" id="home">
        <div class="content">
            <h3>CHOOSE YOUR ROAST</h3><span> From your favorite brand</span>
            <p>We have variety of roast from Blonde to Dark</p>
            <a href="shop.php" class="btn">Shop Now</a>
        </div>
    </section>
    <!--home section ends-->

    <!--about section starts-->

    <section class="about" id="about">
        <h1 class="heading"><span>ABOUT</span> COFFEE DEARLY</h1>
        <div class="row">
            <div class="video-container">
                <video autoplay loop muted poster="images/about2.jpeg" id="background">
                    <source src="images/about2.mp4">
                </video>
                <h3>Ice or Hot?</h3>
            </div>

            <div class="content">
                <h2>WHY CHOOSE US?</h2>
                <p>Coffee dearly offers variety of coffee beans of different roast from different brands. All customers
                    request is at paramount important
                    that's why coffee dearly gives it's best quality service to the customers. The founder itself have
                    so much value in coffee as she is a coffee
                    lover and it is part her day to day life.</p>
                <a href="meet_the_founder.php" class="btn">Meet the Founder</a>
            </div>
        </div>
    </section>
    <!--about section ends-->

    <!-- icon section starts-->

    <section class="icons-container">
        <h2>What we do</h2>
        <div class="icons">
            <img src="images/icon1.png" height="80rem" width="80rem" alt="">
            <div class="info">
                <h3>ROAST TODAY, DELIVERED TOMORROW</h3>
                <span>Roasted by partner brands of your choice</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icon2.png" height="80rem" width="80rem" alt="">
            <div class="info">
                <h3>BRANDS OF YOUR CHOICE</h3>
                <span>Choose your favorite coffee brands and we deliver them to you hassle-free</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icon3.png" height="80rem" width="80rem" alt="">
            <div class="info">
                <h3>YOUR DEMAND IS AT PARAMOUNT IMPORTANT</h3>
                <span>We make sure all your demands are safe and secure</span>
            </div>
        </div>
    </section>
    <!-- icon section ends-->
    <!-- partner section starts-->
    <section class="partner-brands">
        <h2>PARTNER BRANDS</h2>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/1.png" height="100%" width="100%" class="d-block w-100" alt="Starbucks">
                </div>
                <div class="carousel-item">
                    <img src="images/2.png" height="100%" width="100%" class="d-block w-100" alt="Good Cup Coffee Co.">
                </div>
                <div class="carousel-item">
                    <img src="images/3.png" height="100%" width="100%" class="d-block w-100"
                        alt="Coffee Bean Tea & Leaf">
                </div>
                <div class="carousel-item">
                    <img src="images/4.png" height="100%" width="100%" class="d-block w-100" alt="Press Coffee">
                </div>
                <div class="carousel-item">
                    <img src="images/5.png" height="100%" width="100%" class="d-block w-100" alt="Bo's Coffee">
                </div>
                <div class="carousel-item">
                    <img src="images/6.png" height="100%" width="100%" class="d-block w-100" alt="PicaBean Housee">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- partner section ends-->

    <!--product section starts-->
    <section class="products">

        <h2 class="title">Featured Products</h2>

        <div class="box-container">

            <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
            <form action="" method="post" class="box">
                <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?> " height="300rem"
                    width="300rem" alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">₱<?php echo $fetch_products['price']; ?></div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
    }
    }else{
        echo '<p class="empty">No products added yet!</p>';
    }
    ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="shop.php" class="option-btn">Load more</a>
        </div>

    </section>

    <!-- contact section starts -->

    <section class="contact" id="contact">
        <h1 class="heading"><span>CONTACT</span> US</h1>
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




    <!--custom admin js file link-->
    <script src="js/script.js"></script>


</body>

</html>