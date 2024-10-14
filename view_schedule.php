<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil semua jadwal pengguna dari database
$sql = "SELECT * FROM schedules WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Schedules - Aplikasi Pengingat Jadwal</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
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
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-links a {
            color: #007BFF;
            text-decoration: none;
            margin-right: 10px;
        }
        .action-links a:hover {
            text-decoration: underline;
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
        <h2>My Schedules</h2>
    </header>

    <nav>
        <a href="index.php">Kembali ke Menu Awal</a>
        <a href="add_schedule.php">Tambah Jadwal Baru</a>
    </nav>

    <main>
        <?php if (count($schedules) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Reminder Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td><?= htmlspecialchars($schedule['title']) ?></td>
                            <td><?= htmlspecialchars($schedule['description']) ?></td>
                            <td><?= htmlspecialchars($schedule['schedule_date']) ?></td>
                            <td><?= htmlspecialchars($schedule['reminder_time']) ?></td>
                            <td class="action-links">
                                <a href="edit_schedule.php?id=<?= $schedule['id'] ?>">Edit</a>
                                <a href="delete_schedule.php?id=<?= $schedule['id'] ?>" onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; margin-top: 20px;">Tidak ada jadwal yang ditemukan. Tambahkan jadwal baru!</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Aplikasi Pengingat Jadwal</p>
    </footer>
</body>
</html>
