<?php
require_once 'db.php';
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST['student_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $role = 'Employee';



    try {
        $stmt = $pdo->prepare("INSERT INTO users (student_id, name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $name, $email, $password, $role]);
        $message = "<div class='message msg-success'>Registration successful! <a href='login.php'>Login here</a></div>";
    } catch (PDOException $e) {
        $message = "<div class='message msg-error'>Error: Employee ID or Email already exists.</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="auth-box">
        <h2>Register Employee</h2>
        <?= $message; ?>
        <form method="POST" action="register.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" name="student_id" id="student_id" required placeholder="EMP-01">
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn">Register</button>
            <p style="margin-top: 15px; font-size: 13px; text-align: center;">
                Already registered? <a href="login.php">Sign In</a>
            </p>
        </form>
    </div>

    <script>
        function validateForm() {
            var pass = document.getElementById('password').value;
            if (pass.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>