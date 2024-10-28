<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// require 'config.php';

// $sql = "SELECT schedules.id, schedules.title, schedules.description, users.email 
//         FROM schedules 
//         JOIN users ON schedules.user_id = users.id 
//         WHERE schedules.schedule_date = CURDATE() 
//         AND schedules.reminder_time = CURTIME()";

// $stmt = $pdo->query($sql);
// $reminders = $stmt->fetchAll();

$reminders = 
[
    'email' => 'wy15069@gmail.com',
    'title' => 'Jadwal Matkuliah',
    'description' => 'Pukul 10.00 Matakuliah Basis Data masuk !!'           
];


function kirimEmail($useremail,$title, $subjek, $pesan) {
    $mail = new PHPMailer(true);
    
    try {
       
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'arilmuhammad06@gmail.com'; 
        $mail->Password   = 'qbpd uogx qwbe hpog '; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;

        // set pengirim dan pesan 
        $mail->setFrom('arilmuhammad06@gmail.com', $title);
        $mail->addAddress($useremail);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = $subjek;
        $mail->Body    = $pesan;

        // Send email
        $mail->send();
        echo 'Email berhasil terkirim';
    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}



    $to = $reminders['email'];
    $subject = "Reminder: " . $reminders['title'];
    $message = $reminders['description'];
    // $headers = "From: no-reply@yourdomain.com";

    kirimEmail($to, $reminders['title'], $subject, $message);


        


    // mail($to, $subject, $message, $headers);


?>
