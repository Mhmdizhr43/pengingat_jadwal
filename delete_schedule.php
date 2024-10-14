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

// Hapus jadwal berdasarkan ID
$sql = "DELETE FROM schedules WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$schedule_id, $user_id]);

header('Location: view_schedule.php');
exit();
?>
