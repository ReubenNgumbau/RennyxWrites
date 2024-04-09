<?php
session_start(); // Add this line if you're using sessions

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['message'];

    require("./PHPMailer-master/src/PHPMailer.php");
    require("./PHPMailer-master/src/SMTP.php");
    require("./PHPMailer-master/src/Exception.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl'; // or 'tls'
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "reubenngumbau@gmail.com";
    $mail->Password = "gxvaleaoazrjzzfy";
    $mail->SetFrom('reubenngumbau@gmail.com', 'Website Notifications');
    $mail->addReplyTo($email);
    $mail->Subject = "Contact Subject: $subject";
    $mail->Body = "<h5>Contact Notification</h5><br><b>Name:</b>$name<br><b>Email:</b>$email<br><h5>Message:</h5><br><p>$body</p>";
    $mail->AddAddress('muthokingumbau@zetech.ac.ke');

    if ($mail->Send()) {
        $_SESSION['status'] = "message sent";
        $_SESSION['more'] = "Thanks for Your Message, we shall get in touch soon!";
        $_SESSION['status_code'] = "success";
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
