<?php
session_start(); // Start the session to access session variables

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered OTP
    $enteredOTP = $_POST['otp'];

    // Assuming the stored OTP is in the session variable, adjust this according to your actual storage method
    $expectedOTP = $_SESSION['otp']; // Retrieve the stored OTP from the session

    // Compare the entered OTP with the expected OTP
    if ($enteredOTP == $expectedOTP) {
        $_SESSION['isVerified'] = true;
        echo "success"; // If the OTPs match, return success
        // Perform further actions if needed
    } else {
        echo "failure"; // If the OTPs don't match, return failure
    }
}
?>
