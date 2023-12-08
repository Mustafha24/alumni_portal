<?php
session_start();
include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alumni_email = $_SESSION['mailid'];

$query = "SELECT * FROM jobs WHERE POSTED_BY = '$alumni_email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Company: ' . $row['COMPANY_NAME'] . '</h5>
                    <p class="card-text">Role: ' . $row['ROLE_NAME'] . '</p>
                    <p class="card-text">Salary: ' . $row['SALARY'] . '</p>
                    <p class="card-text">Descritpion: ' . $row['DESCRIPTION'] . '</p>
                    <p class="card-text">Location: ' . $row['LOCATION'] . '</p>
                    <a href="' . $row['URL'] . '" class="btn btn-primary">Apply</a>
                    
                    <!-- Add delete button -->
                    <button class="btn btn-danger" onclick="deleteJob(' . $row['ID'] . ')">Delete</button>
                </div>
            </div>';
    }
} else {
    echo 'No job listings available.';
}

$conn->close();
?>
