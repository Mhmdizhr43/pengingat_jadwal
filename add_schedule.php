<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $schedule_date = $_POST['schedule_date'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "INSERT INTO schedules (user_id, title, description, schedule_date, reminder_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $title, $description, $schedule_date, $reminder_time]);

    header('Location: dashboard.php');
    exit();
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
</body>
</html>
