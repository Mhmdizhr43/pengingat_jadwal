<?php
require 'config.php';

$sql = "SELECT schedules.id, schedules.title, schedules.description, users.email 
        FROM schedules 
        JOIN users ON schedules.user_id = users.id 
        WHERE schedules.schedule_date = CURDATE() 
        AND schedules.reminder_time = CURTIME()";
        
$stmt = $pdo->query($sql);
$reminders = $stmt->fetchAll();

foreach ($reminders as $reminder) {
    $to = $reminder['email'];
    $subject = "Reminder: " . $reminder['title'];
    $message = $reminder['description'];
    $headers = "From: no-reply@yourdomain.com";

    mail($to, $subject, $message, $headers);
}
?>
