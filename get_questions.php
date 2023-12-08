<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM Student_Questions";
$result = $conn->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $question = [
        'id' => $row['question_id'],
        'text' => $row['question_text'],
        'student_email' => $row['student_email'],
        'timestamp' => $row['timestamp'] 
    ];
    $questions[] = $question;
}

echo json_encode($questions);

$conn->close();
?>
