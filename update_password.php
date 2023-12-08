<?php
session_start();
include './connection.php';

$response = [];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email']; // Assuming email is sent from the form
$role = $_SESSION['role']; // Retrieve the role from the session
$newPassword = $_POST['password'];

// Hash the new password before updating the database
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Update the password for the corresponding email in the appropriate table
$tableName = ($role === 'alumni') ? 'alumni' : 'student'; // Adjust table names as needed
$sql = "UPDATE $tableName SET PASSWORD='$hashedPassword' WHERE EMAIL='$email'";

if ($conn->query($sql) === TRUE) {
    $response['status'] = "success";
} else {
    $response['status'] = "error";
}

echo json_encode($response);
$conn->close();
?>
