<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    if ($_FILES["image"]["error"] === 0) {
        $targetDir = "uploads/events/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        $title = $_POST['title'];
        $schedule = $_POST['schedule'];
        $content = $_POST['content'];

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $url = "./" . $targetFile; 
            $sql = "INSERT INTO events (title, schedule, content, banner) VALUES ('$title', '$schedule', '$content', '$url')";

            if ($conn->query($sql) === true) {
                echo "Image uploaded successfully!";
            } else {
                echo "SQL Error: " . $conn->error;
            }
        } else {
            echo "Error uploading the image.";
        }
    } 
}
?>
