<?php
include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events WHERE schedule > NOW()"; // Fetch upcoming events
$result = $conn->query($sql);

$upcoming_events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event = array(
            'banner' => $row['banner'],
            'title' => $row['title'],
            'schedule' => $row['schedule'],
            'content' => $row['content']
        );
        $upcoming_events[] = $event;
    }
}

$conn->close();

// Send the upcoming events in JSON format
header('Content-Type: application/json');
echo json_encode($upcoming_events);
?>
