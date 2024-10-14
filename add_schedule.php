<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $schedule_date = $_POST['schedule_date'];
    $reminder_time = $_POST['reminder_time'];

    try {
        $sql = "INSERT INTO schedules (user_id, title, description, schedule_date, reminder_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $title, $description, $schedule_date, $reminder_time]);

        header('Location: dashboard.php');
        exit();
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Add Schedule</title>
</head>
<body>
    <h2>Add Schedule</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="description" placeholder="Description"></textarea><br>
        <input type="date" name="schedule_date" required><br>
        <input type="time" name="reminder_time" required><br>
        <button type="submit">Add Schedule</button>
    </form>
    <a href="index.php" class="back-button">Kembali ke Menu Awal</a>
</body>
</html>
