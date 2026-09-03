<?php
session_start();
require_once 'db.php';


 if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'Employee') {
    header("Location: dashboard.php");
    exit();
} 

$stmt = $pdo->query("SELECT * FROM tournaments WHERE status = 'Active'");
$active_tournaments = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIUB Tournament Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .hero {
            background-color: #0b1e3f;
            color: #ffffff;
            padding: 60px 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 40px;
        }
        .hero h1 {
            font-size: 38px;
            margin-bottom: 12px;
        }
        .hero p {
            font-size: 16px;
            color: #d1d5db;
            max-width: 650px;
            margin: 0 auto 24px auto;
            line-height: 1.5;
        }
        .hero-btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0056b3;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 6px;
        }
        .hero-btn-outline {
            background-color: transparent;
            border: 2px solid #ffffff;
        }
        .hero-btn:hover {
            opacity: 0.9;
        }
        .tourney-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .tourney-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            border-top: 4px solid #0056b3;
        }
        .tourney-card h3 {
            margin-bottom: 8px;
            color: #0b1e3f;
        }
        .tourney-card p {
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div style="font-weight:bold; font-size:18px;">AIUB TOURNAMENT</div>
        <div>
            <a href="index.php">Home</a>
            <a href="login.php">Sports Desk Sign In</a>
            <a href="student_registration.php">Student Registration</a>
            <a href="register.php">Register Staff</a>
        </div>
    </div>

    <div class="container">
        
        <div class="hero">
            <h1>Compete. Connect. Conquer.</h1>
            <p>The official tournament and sports management platform for American International University-Bangladesh.</p>
            <div>
                <a href="login.php" class="hero-btn">Sports Desk Login</a>
                <a href="student_registration.php" class="hero-btn hero-btn-outline">Student Registration</a>
            </div>
        </div>

        
        <h2 style="margin-bottom: 20px; color: #0b1e3f;">Active Tournaments & Championships</h2>
        <div class="tourney-grid">
            <?php if (count($active_tournaments) > 0): ?>
                <?php foreach ($active_tournaments as $tourney): ?>
                    <div class="tourney-card">
                        <span class="badge badge-pending"><?= htmlspecialchars($tourney['sport_name']); ?></span>
                        <h3 style="margin-top: 10px;"><?= htmlspecialchars($tourney['name']); ?></h3>
                        <p>Status: <strong>Active</strong></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No active championships scheduled at this moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>