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

<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <button><a href="register_form.php">SIGNUP/LOGIN</a></button>
        </div>
    </div>
    <!--header 2-->
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

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="search_page.php" class="fas fa-search"></a>
                <div id="user-btn" class="fas fa-user"></div>
                <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i>
                    <span>(<?php echo $cart_rows_number; ?>)</span>
                </a>
            </div>

            <div class="user-box">
                <p>Hi, <span><?php echo $_SESSION['user_name']; ?></span></p>
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
        </div>
    </div>
    <!--header 2-->

</header>