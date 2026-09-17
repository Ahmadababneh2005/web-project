<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | CourseShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar container">
            <a class="brand" href="dashboard.php">CourseShop</a>
            <button class="menu-button" id="menuButton" type="button">Menu</button>
            <div class="nav-links" id="navLinks">
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php">Products</a>
                <a class="active" href="cart.php">Cart <span class="cart-badge" id="cartCount">0</span></a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <main class="container page-section">
        <div class="section-heading split-heading">
            <div>
                <p class="eyebrow">YOUR ORDER</p>
                <h1>Shopping Cart</h1>
                <p class="muted">Update quantities or remove products.</p>
            </div>
            <a class="secondary-btn" href="products.php">Continue Shopping</a>
        </div>

        <div id="cartRoot"></div>
    </main>

    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="js/site.js"></script>
    <script type="text/babel" src="js/react-cart.js"></script>
</body>
</html>
