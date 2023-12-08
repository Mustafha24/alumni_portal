<?php
session_start();
include('./assets/mailing/smtp/PHPMailerAutoload.php');
include './connection.php';

$email = $_POST['email'];
$role = $_POST['role']; // Retrieve the selected role from the form
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['email'] = $email;
$_SESSION['role'] = $role; // Save the role in the session
$message = "OTP Code for verification is '$otp' !!!!";

// Database connection and checking email existence based on the role
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableName = ($role === 'alumni') ? 'alumni' : 'student'; // Adjust table names as needed

$sql = "SELECT * FROM $tableName WHERE EMAIL='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Email exists in the table, proceed with sending OTP
    echo smtp_mailer($email, 'Verification', $message);
} else {
    // Email doesn't exist in the table
    echo "Email does not exist in $tableName table"; // Modify this response as needed
}

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "a0742482@gmail.com";
    $mail->Password = "txjl qltp sdrj tyfy";
    $mail->SetFrom("a0742482@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}
?>
