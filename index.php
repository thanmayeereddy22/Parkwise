<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ParkWise – Smart Parking System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #121212;
            color: #eee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #1f1f1f;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            border-bottom: 2px solid #444;
        }

        .navbar h1 {
            color: #00bcd4;
            font-size: 28px;
            margin: 0;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin-left: 25px;
        }

        .navbar ul li a {
            color: #eee;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #00bcd4;
        }

        .home-container {
            max-width: 600px;
            margin: 50px auto;
            background: #1e1e1e;
            padding: 40px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.4);
        }

        .home-container h1 {
            color: #00bcd4;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .home-container p {
            color: #ccc;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            background-color: #00bcd4;
            color: #121212;
            padding: 10px 20px;
            margin: 10px 5px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #0097a7;
        }

        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
            padding: 20px;
        }

        .feature-box {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            width: 30%;
            text-align: center;
        }

        .feature-box h3 {
            color: #00bcd4;
        }

        .feature-box p {
            color: #aaa;
        }

        .footer {
            text-align: center;
            padding: 25px;
            background-color: #1f1f1f;
            border-top: 2px solid #444;
            color: #aaa;
            margin-top: 60px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>ParkWise</h1>
   <ul>
    <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="alerts.php">Alerts & Reminders</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    <?php endif; ?>
</ul>

</div>

<div class="home-container">
    <h1>ParkWise</h1>
    <p>Your Smart Parking Spot Finder & Reservation System</p>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login.php" class="btn">User Login</a>
        <a href="register.php" class="btn">Register</a>
        <a href="admin_login.php" class="btn">Admin Login</a>
    <?php else: ?>
        <a href="dashboard.php" class="btn">Go to Dashboard</a>
    <?php endif; ?>
</div>

<div class="features">
    <div class="feature-box">
        <h3>Live Availability</h3>
        <p>Check real-time parking spot status with instant booking confirmation.</p>
    </div>
    <div class="feature-box">
        <h3>Hassle-Free Booking</h3>
        <p>Plan in advance or book on the go from any device seamlessly.</p>
    </div>
    <div class="feature-box">
        <h3>24/7 Support</h3>
        <p>Need help? Our support team is always here for you.</p>
    </div>
</div>

<div class="footer">
    📞 Emergency Contact: <strong>+91 98765 43210</strong><br>
    ✉️ Helpdesk Email: <strong>support@parkwise.in</strong>
</div>

</body>
</html>
