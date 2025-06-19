<?php

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// User submitted form (POST method)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userContact = $_POST['phone'];
    $userMessage = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dubeyaayush2004@gmail.com'; // your SMTP email
        $mail->Password   = 'zumrjxlmmkflymne';     // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Server email settings
        $mail->setFrom('aayushkumar.dubey22@spit.ac.in', 'Portfolio Website'); // always your email
        $mail->addAddress('aayushkumar.dubey22@spit.ac.in', 'Aayush Dubey');    // you will receive
        $mail->addReplyTo($userEmail, $userName);  // user's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = '(New Contact Form Message)';
        $mail->Body    = "
            <div style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>
                <h2 style='font-size: 22px;'>- Contact Details -</h2>
                <p><strong>Name:</strong> {$userName}</p>
                <p><strong>Email:</strong> {$userEmail}</p>
                <p><strong>Mobile:</strong> {$userContact}</p>
                <p><strong>Message:</strong> {$userMessage}</p>
            </div>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>