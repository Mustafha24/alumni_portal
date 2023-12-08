<?php
include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); 

if (isset($_POST['question']) && isset($_SESSION['student_email'])) {
    $question = $conn->real_escape_string($_POST['question']);
    $student_email = $conn->real_escape_string($_SESSION['student_email']);

    $insertQuestion = "INSERT INTO Student_Questions (student_email, question_text) VALUES ('$student_email', '$question')";
    $conn->query($insertQuestion);
}

$conn->close();
?>
