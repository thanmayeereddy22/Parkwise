<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT b.id, p.location_name, b.booking_time, b.created_at
    FROM bookings b
    JOIN parking_lots p ON b.lot_id = p.id
    WHERE b.user_id = ?
    ORDER BY b.booking_time DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bookings | ParkWise</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Your Parking Bookings</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Location</th>
                <th>Booking Time</th>
                <th>Booked On</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['location_name']) ?></td>
                    <td><?= date('d M Y, h:i A', strtotime($row['booking_time'])) ?></td>
                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No bookings found yet.</p>
    <?php endif; ?>

    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</div>
</body>
</html>
