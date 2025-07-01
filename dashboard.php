<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | ParkWise</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <p>You are logged in as <strong><?php echo $_SESSION['role']; ?></strong>.</p>

        <div class="dashboard-actions">
            <a href="book_parking.php" class="btn">📍 Book a Parking Spot</a>
            <a href="view_bookings.php" class="btn">🧾 View Your Bookings</a>
            <a href="logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
