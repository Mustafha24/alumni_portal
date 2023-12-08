<?php
error_reporting(E_ALL);
ini_set('display_errors','on');
include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sno, name, designation, about,url FROM testimonials";
$result = $conn->query($sql);
$testimonials = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($testimonials);
?>
