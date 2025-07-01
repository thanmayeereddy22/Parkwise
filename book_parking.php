<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';

// Handle booking submission
if (isset($_POST['book'])) {
    $user_id     = $_SESSION['user_id'];
    $lot_id      = $_POST['lot_id'];
    $booking_time = $_POST['booking_time'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, lot_id, booking_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $lot_id, $booking_time);

    if ($stmt->execute()) {
    $booking_id = $stmt->insert_id; // Get the ID of the newly inserted booking
    header("Location: payment.php?slot_id=" . $booking_id); // Redirect to payment page
    exit();
} else {
    $error = "Booking failed: " . $conn->error;
}

}

// Fetch parking lots
$lots_result = $conn->query("SELECT * FROM parking_lots");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Parking | ParkWise</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Book a Parking Spot</h2>

    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST" action="">
        <label for="lot_id">Select Parking Lot:</label>
        <select name="lot_id" required>
            <option value="">-- Choose --</option>
            <?php while ($row = $lots_result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['location_name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label for="booking_time">Select Time:</label>
        <input type="datetime-local" name="booking_time" required>

        <button type="submit" name="book">Book Now</button>
    </form>

    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</div>
</body>
</html>
