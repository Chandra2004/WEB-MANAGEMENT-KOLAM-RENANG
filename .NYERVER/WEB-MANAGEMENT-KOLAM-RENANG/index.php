<?php
ob_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Helpers/helpers.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT_DIR', __DIR__);

// 1. Load Environment & Core Services
require_once __DIR__ . '/bootstrap/app.php';

// 2. Load Routes (Environment is now available)
require_once __DIR__ . '/routes/web.php';
require_once __DIR__ . '/routes/system.php';

require_once __DIR__ . '/routes/testing.php';

// 3. Run Application
\TheFramework\App\Router::run();



// require __DIR__ . '/vendor/autoload.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// $mail = new PHPMailer(true);

// try {

//     // SMTP
//     $mail->isSMTP();
//     $mail->Host = 'smtp.hostinger.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'noreply@khafidswimmingclub.com';
//     $mail->Password = 'Khafidswimming#))^3006'; 
//     $mail->SMTPSecure = 'ssl';
//     $mail->Port = 465;

//     // Email
//     $mail->setFrom('noreply@khafidswimmingclub.com', 'WEB KSC');
//     $mail->addAddress('chandratriantomo123@gmail.com');

//     $mail->Subject = 'SMTP Test';
//     $mail->Body = 'Jika email ini sampai berarti SMTP berhasil.';

//     $mail->send();

//     echo "STATUS: SUCCESS - Email berhasil terkirim";

// } catch (Exception $e) {

//     echo "STATUS: FAILED - Email gagal terkirim <br>";
//     echo "ERROR: {$mail->ErrorInfo}";
// }