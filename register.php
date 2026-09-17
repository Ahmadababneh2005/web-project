<?php
session_start();
require 'db.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
        $message = 'Please complete all fields.';
        $messageType = 'error';
    } elseif ($password !== $confirmPassword) {
        $message = 'Passwords do not match.';
        $messageType = 'error';
    } else {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = :email OR username = :username');
        $check->execute([
            ':email' => $email,
            ':username' => $username
        ]);

        if ($check->fetch()) {
            $message = 'Username or email already exists.';
            $messageType = 'error';
        } else {
            $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            $message = 'Registration successful. You can now sign in.';
            $messageType = 'success';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | CourseShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <main class="auth-wrapper">
        <section class="auth-intro">
            <p class="eyebrow">COURSESHOP</p>
            <h2>Create your shopping account.</h2>
            <p>Register once, then browse the catalog, open product details, and keep items in your cart.</p>
            <div class="auth-feature">
                <strong>Simple registration</strong>
                <span>Your username can use any non-empty syntax, including names such as username12.</span>
            </div>
            <div class="auth-feature">
                <strong>Protected dashboard</strong>
                <span>After login, PHP sessions protect the dashboard and shopping pages.</span>
            </div>
        </section>
        <section class="auth-card">
            <a class="brand auth-brand" href="index.php">CourseShop</a>
            <h1>Create Account</h1>
            <p class="muted">Register to access the dashboard and shop products.</p>

            <?php if ($message !== ''): ?>
                <p class="form-message <?= htmlspecialchars($messageType) ?>"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form id="registerForm" action="register.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="e.g. username12">
                <small class="field-error" id="usernameError"></small>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="you@example.com">
                <small class="field-error" id="emailError"></small>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required pattern="\w{4,}[-#@].*" placeholder="Example: pass#123">
                <small class="field-error" id="passwordError"></small>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Repeat your password">
                <small class="field-error" id="confirmPasswordError"></small>

                <button type="submit" class="primary-btn full-btn">Register</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="login.php">Login</a></p>
        </section>
    </main>
    <script src="js/validation.js"></script>
</body>
</html>
