<?php
include './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];

    $getImageQuery = $conn->query("SELECT banner FROM events WHERE id = $eventId");
    $image = $getImageQuery->fetch_assoc()['banner'];

    // Delete event
    $deleteEventQuery = $conn->query("DELETE FROM events WHERE id = $eventId");

    if ($deleteEventQuery && $conn->affected_rows > 0) {
        // Remove image file
        if (file_exists($image)) {
            unlink($image); // Remove the image file
        }

        echo "Event deleted successfully!";
    } else {
        echo "Failed to delete the event.";
    }
    $conn->close();
}
?>
