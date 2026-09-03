<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE (email = ? OR student_id = ?) AND role = 'Employee'");
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials or account does not exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-box">
        <h2>Sports Desk Sign In</h2>
        <?php if (!empty($error)): ?>
            <div class="message msg-error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label>Email or Employee ID</label>
                <input type="text" name="identifier" required placeholder="tariqul@aiub.edu">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Sign In</button>
            <p style="margin-top: 15px; font-size: 13px; text-align: center;">
                Need an account? <a href="register.php">Register</a>
            </p>
        </form>
    </div>
</body>
</html>