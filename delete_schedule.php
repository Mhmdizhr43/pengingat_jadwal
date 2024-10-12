<?php
require 'config.php';

if (isset($_GET['id'])) {
    $sql = "DELETE FROM schedules WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
}

header('Location: dashboard.php');
exit();
?>
