<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Handle Add
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_lot'])) {
    $location = $_POST['location_name'];
    $total = intval($_POST['total_slots']);
    $available = intval($_POST['available_slots']);

    $stmt = $conn->prepare("INSERT INTO parking_lots (location_name, total_slots, available_slots) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $location, $total, $available);
    $stmt->execute();
    $message = "Parking lot added successfully!";
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM parking_lots WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage_lots.php");
    exit;
}

// Fetch all lots
$result = $conn->query("SELECT * FROM parking_lots ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Parking Lots | ParkWise Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Manage Parking Lots</h2>

    <?php if (!empty($message)): ?>
        <div class="success"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="location_name" placeholder="Location Name" required>
        <input type="number" name="total_slots" placeholder="Total Slots" required>
        <input type="number" name="available_slots" placeholder="Available Slots" required>
        <button type="submit" name="add_lot">Add Parking Lot</button>
    </form>

    <h3>Existing Parking Lots</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Location</th>
            <th>Total</th>
            <th>Available</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['location_name']) ?></td>
                <td><?= $row['total_slots'] ?></td>
                <td><?= $row['available_slots'] ?></td>
                <td><a href="manage_lots.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="admin_logout.php" class="btn logout">Logout</a></p>
</div>
</body>
</html>
