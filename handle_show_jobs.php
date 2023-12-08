<?php
include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'companyName' => $row['COMPANY_NAME'],
            'roleName' => $row['ROLE_NAME'],
            'salary' => $row['SALARY'],
            'description' => $row['DESCRIPTION'],
            'location' => $row['LOCATION'],
            'posted_by'=>$row['POSTED_BY'],
            'posted_at' => $row['POSTED_AT'],
            'url'=>$row['URL']
        );
    }

    
    echo json_encode($data);
} else {
    echo "No data found";
}


$conn->close();
?>
