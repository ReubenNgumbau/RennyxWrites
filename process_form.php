<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    if (empty($name) || empty($email) || empty($message) || $email === false) {
        // Handle invalid form data (you may want to redirect back to the form with an error message)
        header("Location: hire_me.php");
        exit();
    }

    // You can customize the email subject and recipient
    $to = "reubenngumbau87@gmail.com";
    $subject = "New Hire Me Form Submission";

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp@gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reubenngumbau87@gmail.com';
        $mail->Password   = 'vbzg dvbc jaib bbuu';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false); // Set to true if you want to send HTML emails
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send the email
        $mail->send();

        // Optionally, you can redirect the user to a thank-you page
        header("Location: thank_you.php");
        exit();
    } catch (Exception $e) {
        // Handle errors, e.g., redirect back to the form with an error message
        header("Location: hire_me.php");
        exit();
    }
} else {
    // If someone tries to access this page directly, redirect them to the hire_me.html page
    header("Location: hire_me.php");
    exit();
}
?>

