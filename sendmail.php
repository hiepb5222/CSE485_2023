<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function send($mailR)
{
  $mail = new PHPMailer(true);

  try {
    // SMTP configuration for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'duchai2211@gmail.com'; // Replace with your Gmail email address
    $mail->Password = 'mpyoumbwdvwmjiua'; // Replace with your Gmail password or app-specific password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom('dinhduy2012001@gmail.com', 'Your Name');
    $mail->addAddress($mailR, 'Recipient Name');
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email message';

    // Send email
    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }

}

?>