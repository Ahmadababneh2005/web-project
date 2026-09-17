<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | CourseShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar container">
            <a class="brand" href="dashboard.php">CourseShop</a>
            <button class="menu-button" id="menuButton" type="button">Menu</button>
            <div class="nav-links" id="navLinks">
                <a href="dashboard.php">Dashboard</a>
                <a class="active" href="products.php">Products</a>
                <a href="cart.php">Cart <span class="cart-badge" id="cartCount">0</span></a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <main class="container page-section">
        <div class="section-heading split-heading">
            <div>
                <p class="eyebrow">CATALOG</p>
                <h1>Products</h1>
                <p class="muted">Choose a product and add it to your cart.</p>
            </div>
            <a class="secondary-btn" href="cart.php">View Cart</a>
        </div>

        <section class="product-grid">
            <?php foreach ($products as $product): ?>
                <article class="product-card">
                    <a class="product-image" href="product-details.php?id=<?= htmlspecialchars($product['id']) ?>">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </a>
                    <div class="product-card-body">
                        <p class="product-category"><?= htmlspecialchars($product['category']) ?></p>
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                        <div class="product-card-bottom">
                            <strong>$<?= htmlspecialchars($product['price']) ?></strong>
                            <a class="text-link" href="product-details.php?id=<?= htmlspecialchars($product['id']) ?>">Details</a>
                        </div>
                        <button
                            class="primary-btn full-btn add-cart-button"
                            type="button"
                            data-id="<?= htmlspecialchars($product['id']) ?>"
                            data-name="<?= htmlspecialchars($product['name']) ?>"
                            data-price="<?= htmlspecialchars($product['price']) ?>"
                            data-image="<?= htmlspecialchars($product['image']) ?>"
                        >Add to Cart</button>
                        <p class="inline-message"></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <script src="js/site.js"></script>
    <script src="js/product-list.js"></script>
</body>
</html>
