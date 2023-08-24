<?php
if(isset($message)){
foreach($message as $message){
    echo '
<div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
    ';
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
    <link rel="stylesheet" href="css/sample.css">

    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <button><a href="login_form.php">Login</a></button>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="home.php"><img src="images/Coffee Dearly IG Profile (1).png" height="100px" width="100px"></a>

            <nav class="navbar">
                <a href="home.php">HOME</a>
                <a href="meet_the_founder.php">ABOUT</a>
                <a href="shop.php">SHOP</a>
                <a href="orders.php">ORDERS</a>
                <a href="#">CONTACT</a>
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
                <a href="cart.php"><i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span>
                </a>
            </div>

            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
        </div>
    </div>

</header>