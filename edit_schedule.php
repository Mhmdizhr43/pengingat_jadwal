<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: view_schedule.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$schedule_id = $_GET['id'];

// Ambil data jadwal berdasarkan ID
$sql = "SELECT * FROM schedules WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$schedule_id, $user_id]);
$schedule = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$schedule) {
    header('Location: view_schedule.php');
    exit();
}

// Proses pembaruan data jadwal jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $schedule_date = $_POST['schedule_date'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "UPDATE schedules SET title = ?, description = ?, schedule_date = ?, reminder_time = ? WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $schedule_date, $reminder_time, $schedule_id, $user_id]);

    header('Location: view_schedule.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule - Aplikasi Pengingat Jadwal</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
        }
        nav {
            text-align: center;
            margin: 20px 0;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #0056b3;
        }
        main {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #0056b3;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h2>Edit Schedule</h2>
    </header>

    <nav>
        <a href="view_schedule.php">Kembali ke My Schedules</a>
    </nav>

    <main>
        <form method="post">
            <input type="text" name="title" value="<?= htmlspecialchars($schedule['title']) ?>" required>
            <textarea name="description"><?= htmlspecialchars($schedule['description']) ?></textarea>
            <input type="date" name="schedule_date" value="<?= htmlspecialchars($schedule['schedule_date']) ?>" required>
            <input type="time" name="reminder_time" value="<?= htmlspecialchars($schedule['reminder_time']) ?>" required>
            <button type="submit">Update Schedule</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Aplikasi Pengingat Jadwal</p>
    </footer>
</body>
</html>
