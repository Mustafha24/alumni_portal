<?php
session_start();
include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            // Add job to the database
            $companyName = $_POST['companyName'];
            $roleName = $_POST['roleName'];
            $salary = $_POST['salary'];
            $description = $_POST['description'];
            $location = $_POST['location'];
            $url = $_POST['link'];
            $alumni = $_SESSION['mailid'];

            $sql = "INSERT INTO jobs (COMPANY_NAME, ROLE_NAME, SALARY, DESCRIPTION, URL, LOCATION, POSTED_BY)
                    VALUES ('$companyName', '$roleName', '$salary', '$description', '$url', '$location', '$alumni')";

            if ($conn->query($sql) === TRUE) {
                echo "Job details added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($_POST['action'] === 'delete') {
            // Delete job from the database
            $jobId = $_POST['jobId'];
            $sql = "DELETE FROM jobs WHERE ID = $jobId";

            if ($conn->query($sql) === TRUE) {
                echo "Job deleted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>
