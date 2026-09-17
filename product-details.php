<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = 0;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}
$sql = 'SELECT * FROM products WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details | CourseShop</title>
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
        <?php if (!$product): ?>
            <section class="empty-state">
                <h1>Product not found</h1>
                <p>The selected product does not exist.</p>
                <a class="primary-btn" href="products.php">Back to Products</a>
            </section>
        <?php else: ?>
            <a class="back-link" href="products.php">← Back to products</a>
            <section class="detail-layout">
                <div class="detail-image-wrap">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="detail-content">
                    <p class="product-category"><?= htmlspecialchars($product['category']) ?></p>
                    <h1><?= htmlspecialchars($product['name']) ?></h1>
                    <p class="detail-price">$<?= htmlspecialchars($product['price']) ?></p>
                    <p class="detail-description"><?= htmlspecialchars($product['description']) ?></p>
                    <button
                        class="primary-btn"
                        id="detailAddButton"
                        type="button"
                        data-id="<?= htmlspecialchars((string)$product['id']) ?>"
                        data-name="<?= htmlspecialchars($product['name']) ?>"
                        data-price="<?= htmlspecialchars((string)$product['price']) ?>"
                        data-image="<?= htmlspecialchars($product['image']) ?>"
                    >Add to Cart</button>
                    <p class="inline-message" id="detailMessage"></p>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <script src="js/site.js"></script>
    <?php if ($product): ?>
    <script src="js/product-details.js"></script>
    <?php endif; ?>
</body>
</html>
