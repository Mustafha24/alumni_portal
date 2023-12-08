<?php
session_start();
include('./assets/mailing/smtp/PHPMailerAutoload.php');

$organizationEmail = "a0742482@gmail.com";

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];

    $subject = "Message from $name";
    
    // Create a structured message for the recipient
    $fullMessage = "
    <html>
    <head>
        <title>Message Details</title>
    </head>
    <body>
        <h2>Message Details</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    </body>
    </html>
    ";

    if (smtp_mailer($organizationEmail, $subject, $fullMessage)) {
        echo "Message sent successfully to the organization!";
    } else {
        echo "Failed to send the message.";
    }
} else {
    echo "Missing data";
}

function smtp_mailer($to,$subject, $msg){
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
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}
?>
