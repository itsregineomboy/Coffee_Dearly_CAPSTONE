<header class="header">

    <div class="flex">
        <img src="images/Coffee Dearly IG Profile (1).png" height="100px" width="100px">
        <a href="admin_page.php" class="logo">ADMIN<span> PANEL</span></a>
        <nav class="navbar">
            <a href="admin_page.php">Home</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_users.php">Users</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
            <div>New <a href="login_form.php">Login</a> | <a href="register_form.php">Register</a></div>
        </div>

    </div>
</header>