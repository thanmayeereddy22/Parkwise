<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$booking_id = $_POST['booking_id'] ?? null;
$user_id = $_SESSION['user_id'];

if ($booking_id) {
    $stmt = $conn->prepare("UPDATE bookings SET payment_status = 'Paid' WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $booking_id, $user_id);

    if ($stmt->execute()) {
        // Auto redirect using JavaScript
        echo "<script>
                alert('Payment marked as successful!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<p style='color:red;'>Update failed: " . $stmt->error . "</p>";
    }
} else {
    echo "<p style='color:red;'>Booking ID not received.</p>";
}
?>

<!-- Manual link if JS fails -->
<p>If you're not redirected, <a href="dashboard.php">click here to go to your homepage</a>.</p>

