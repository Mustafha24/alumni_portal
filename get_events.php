<?php
include './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['get_events'])) {
    $events = $conn->query("SELECT * FROM events");
    $eventData = array();

    foreach ($events as $event) {
        $eventData[] = array(
            'id'=>$event['id'],
            'title' => $event['title'],
            'schedule' => $event['schedule'],
            'content' => $event['content'],
            'banner' => $event['banner']
        );
    }

    header('Content-Type: application/json');
    echo json_encode($eventData);
}
?>
