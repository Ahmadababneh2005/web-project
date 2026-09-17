<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$productStmt = $pdo->prepare('SELECT * FROM products');
$productStmt->execute();
$productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
$totalProducts = count($productRows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | CourseShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar container">
            <a class="brand" href="dashboard.php">CourseShop</a>
            <button class="menu-button" id="menuButton" type="button">Menu</button>
            <div class="nav-links" id="navLinks">
                <a class="active" href="dashboard.php">Dashboard</a>
                <a href="products.php">Products</a>
                <a href="cart.php">Cart <span class="cart-badge" id="cartCount">0</span></a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="container hero-content">
                <div>
                    <p class="eyebrow">YOUR ACCOUNT</p>
                    <h1>Hello, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h1>
                    <p>Manage your account, browse products, and keep track of your cart.</p>
                    <a class="primary-btn" href="products.php">Browse Products</a>
                </div>
                <div class="hero-panel">
                    <span>Signed in as</span>
                    <strong><?= htmlspecialchars($_SESSION['email']) ?></strong>
                </div>
            </div>
        </section>

        <section class="container dashboard-section">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">OVERVIEW</p>
                    <h2>Dashboard</h2>
                </div>
            </div>

            <div class="stat-grid">
                <article class="stat-card">
                    <span class="stat-label">Total Products</span>
                    <strong><?= htmlspecialchars((string)$totalProducts) ?></strong>
                    <a href="products.php">View catalog</a>
                </article>
                <article class="stat-card">
                    <span class="stat-label">Cart Items</span>
                    <strong id="dashboardCartCount">0</strong>
                    <a href="cart.php">Open cart</a>
                </article>
                <article class="stat-card">
                    <span class="stat-label">Account</span>
                    <strong>Active</strong>
                    <span class="muted">Session protected</span>
                </article>
            </div>

            <div class="quick-grid">
                <a class="quick-card" href="products.php">
                    <span>01</span>
                    <h3>Explore Products</h3>
                    <p>Browse the full product catalog.</p>
                </a>
                <a class="quick-card" href="cart.php">
                    <span>02</span>
                    <h3>Review Cart</h3>
                    <p>Change quantities or remove items.</p>
                </a>
                <a class="quick-card" href="logout.php">
                    <span>03</span>
                    <h3>Logout</h3>
                    <p>End the current protected session.</p>
                </a>
            </div>
        </section>
    </main>

    <script src="js/site.js"></script>
</body>
</html>
