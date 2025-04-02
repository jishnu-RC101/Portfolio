<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/phpmailer/Exception.php';
require '../assets/vendor/phpmailer/PHPMailer.php';
require '../assets/vendor/phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiving_email_address = 'testprojectpython7@gmail.com';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server (Gmail in this case)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@gmail.com'; // Your email
        $mail->Password   = 'your-email-password';  // Your email password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email Details
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);
        $mail->Subject = $subject;
        $mail->Body    = "From: $name\nEmail: $email\n\nMessage:\n$message";

        // Send Email
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request!";
}
?>
