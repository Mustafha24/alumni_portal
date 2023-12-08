<?php
include './connection.php';

session_start();
    $email = $_SESSION['alumni'];
    // Validate and sanitize the input data
    $story_title = $_POST['story_title'];
    $story_content =$_POST['story_content'];
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the success story into the database
    $sql = "INSERT INTO success_stories (alumni_id, story_title, story_content) VALUES ('$email', '$story_title', '$story_content')";

    if ($conn->query($sql) === true) {
        echo "Success story submitted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
