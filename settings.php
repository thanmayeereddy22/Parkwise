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
    <title>Settings | ParkWise</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="form-container">
    <h2>Settings</h2>
    <p>Coming soon: Update preferences, themes, and notification options.</p>
</div>
</body>
</html>
