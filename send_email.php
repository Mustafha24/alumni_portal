<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['email'];
    $subject = 'Test Email';
    $message = 'This is a test email sent from your website.';
    $headers = 'From: mustafha.ahmad24@gmail.com';

    if (mail($to, $subject, $message, $headers)) {
        echo 'Email sent successfully.';
    } else {
        echo 'Email could not be sent.';
    }
} else {
    header('Location: email_form.html');
    exit;
}
?>
