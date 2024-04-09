<?php
session_start(); // Start the session

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
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = "reubenngumbau87@gmail.com";
    $mail->Password = "gxvaleaoazrjzzfy";
    $mail->SetFrom('reubenngumbau@gmail.com', 'Website Notifications');
    $mail->addReplyTo("$email");
    $mail->Subject = "Contact Subject: $subject";
    $mail->Body = "<h5>Contact Notification</h5><br><b>Name:</b>$subject<br><b>Email:</b>$email<br><h5>Message:</h5><br><p>$body</p>";
    $mail->AddAddress('muthokingumbau@zetech.ac.ke');

    if ($mail->Send()) {
        $_SESSION['status'] = "message sent";
        $_SESSION['more'] = "Thanks for Your Message, we shall get in touch soon!";
        $_SESSION['status_code'] = "success";
        
        // Redirect to your success page or display the success message here
        header("Location: success.php"); // Change 'success.php' to your actual success page
        exit();
    } else {
        $_SESSION['status'] = "message not sent";
        $_SESSION['more'] = "Sorry, an error occurred while sending your message.";
        $_SESSION['status_code'] = "error";
        
        // Redirect to your error page or display the error message here
        header("Location: error.php"); // Change 'error.php' to your actual error page
        exit();
    }
}
?>


