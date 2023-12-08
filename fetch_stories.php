<?php
include './connection.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch all success stories with alumni URLs
$sql = "SELECT s.story_title, s.story_content, s.alumni_id, a.url
        FROM success_stories s
        LEFT JOIN alumni_profile a ON s.alumni_id = a.email";
$result = $conn->query($sql);

$success_stories = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $success_story = array(
            'story_title' => $row['story_title'],
            'story_content' => $row['story_content'],
            'alumni_id' => $row['alumni_id'],
            'alumni_url' => $row['url']
        );
    
        $success_stories[] = $success_story;
    }
}


// Close the database connection
$conn->close();

// Send the success stories in JSON format
header('Content-Type: application/json');
echo json_encode($success_stories);
?>


