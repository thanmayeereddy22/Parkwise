<?php
session_start();
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=? AND role='admin'");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: manage_lots.php");
        exit;
    } else {
        $message = "Invalid credentials or not an admin.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | ParkWise</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Admin Login</h2>
    <?php if ($message): ?>
        <div class="error"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login as Admin</button>
    </form>
    <p><a href="index.php">← Back to Home</a></p>
</div>
</body>
</html>
