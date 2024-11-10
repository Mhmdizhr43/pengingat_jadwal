<<<<<<< HEAD
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
=======
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function kirimEmail($useremail,$title, $subjek, $pesan) {
    $mail = new PHPMailer(true);
    
    try {
       
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fadlinan347@gmail.com'; 
        $mail->Password   = 'epwh adez vldo rchv'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;

        // set pengirim dan pesan 
        $mail->setFrom('fadlinan347@gmail.com', $title);
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

// require 'config.php';


// START LOGIC PEmeriksaaan Waktu dalam  DBMS

$sql = "SELECT * FROM <schedules> WHERE <reminder_time> BETWEEN NOW() AND (NOW() + INTERVAL 2 HOUR)";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$reminders = $stmt->fetchAll(PDO::FETCH_ASSOC);
// tes
// if ($reminders) { 
var_dump($reminders);
//     foreach ($reminders as $reminder) {
//         kirimEmail($to, $reminders['send_reminder'], $subject, $message);
//     }
// } else {
//     echo "Tidak ada jadwl dalam 2 jam ke depan.";
// } 

// END

// $reminders = 
// [
//
//     'email' => 'fadlinan347@gmail.com',
//     'title' => 'Jadwal Matkuliah',
//     'description' => 'Pukul 10.00 Matakuliah Basis Data masuk !!'           
// ];

?>
>>>>>>> 3813e710646feb28cd50bf7681d689b7c0a31991
