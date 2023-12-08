<?php
include './connection.php';
session_start();


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question_id'])) {
    $questionId = $_POST['question_id'];

    $sql = "SELECT * FROM Alumni_Answers WHERE question_id = $questionId";
    $result = $conn->query($sql);

    $answers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $answer = [
                'text' => $row['answer_text'],
                'email' => $row['alumni_email'],
                'date' => $row['answer_date']
                // You can add more fields if needed.
            ];
            $answers[] = $answer;
        }
    }

    echo json_encode($answers);
}

$conn->close();
?>
