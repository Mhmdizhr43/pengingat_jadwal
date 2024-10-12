<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM schedules WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$schedules = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <h2>Your Schedules</h2>
    <a href="add_schedule.php">Add New Schedule</a>
    <ul>
        <?php foreach ($schedules as $schedule): ?>
            <li>
                <?= htmlspecialchars($schedule['title']) ?> - <?= $schedule['schedule_date'] ?>
                <a href="delete_schedule.php?id=<?= $schedule['id'] ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
