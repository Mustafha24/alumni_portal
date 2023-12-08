<?php
include './connection.php';
session_start(); // Start the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve answer and question ID from the POST data
    $answer = $_POST['answer'];
    $questionId = $_POST['questionId'];
    $alumni_email=$_POST['email'];
   

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Alumni_Answers (question_id, alumni_email, answer_text) VALUES ($questionId, '$alumni_email', '$answer')";

    if ($conn->query($sql) === TRUE) {
        echo "Answer submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
