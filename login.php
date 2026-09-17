<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($login === '' || $password === '') {
        $message = 'Please enter your username/email and password.';
    } else {
        $sql = 'SELECT id, username, email, password FROM users WHERE username = :login OR email = :login LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $login]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['username'] = $userData['username'];
            $_SESSION['email'] = $userData['email'];

            header('Location: dashboard.php');
            exit();
        } else {
            $message = 'Invalid username/email or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CourseShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <main class="auth-wrapper">
        <section class="auth-intro">
            <p class="eyebrow">WELCOME BACK</p>
            <h2>Your products are one login away.</h2>
            <p>Sign in to continue to your dashboard, browse real product photos, and manage your saved cart.</p>
            <div class="auth-feature">
                <strong>Fast product browsing</strong>
                <span>Responsive product cards make the catalog easy to use on phones and computers.</span>
            </div>
            <div class="auth-feature">
                <strong>Saved cart</strong>
                <span>Your cart stays available in the browser using local storage.</span>
            </div>
        </section>
        <section class="auth-card">
            <a class="brand auth-brand" href="index.php">CourseShop</a>
            <h1>Welcome Back</h1>
            <p class="muted">Sign in to continue to your dashboard.</p>

            <?php if ($message !== ''): ?>
                <p class="form-message error"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form id="loginForm" action="login.php" method="POST">
                <label for="login">Username or Email</label>
                <input type="text" id="login" name="login" required placeholder="Username or email">

                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="password" required placeholder="Your password">

                <button type="submit" class="primary-btn full-btn">Login</button>
            </form>

            <p class="auth-switch">No account yet? <a href="register.php">Register</a></p>
        </section>
    </main>
</body>
</html>
