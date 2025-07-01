<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alerts & Reminders | ParkWise</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="form-container">
    <h2>Alerts & Reminders</h2>
    <p>Coming soon: Get alerts for your bookings, expiring slots, and more!</p>
</div>
</body>
</html>
