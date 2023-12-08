<?php
session_start();
include './connection.php';
$response = [];
$uname = $_REQUEST['email'];
$pass = $_REQUEST['password'];
$role = $_REQUEST['role'];

session_unset();
$uname = $conn->real_escape_string($uname);

$sql = "SELECT PASSWORD FROM $role WHERE EMAIL = '$uname'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pfromdb = $row['PASSWORD'];
    
    // Verify password
    if (password_verify($pass, $pfromdb)) {
        $response['status'] = true;
        if ($role == "admin") {
            $_SESSION['admin'] = $uname;
            $response['url'] = "admin_panel.php";
        } elseif ($role == "alumni") {
            $_SESSION[$role] = $uname;
            $response['url'] = "alumni_panel.php";
        }
        elseif ($role == "student") {
            $_SESSION[$role] = $uname;
            $response['url'] = "student_panel.php";
            $_SESSION['student_email']=$uname;
        }
         else {
            $response['url'] = "login.php";
        }
    } else {
        $response['status'] = false;
        $response['url'] = "";
    }
} else {
    $response['status'] = false;
    $response['url'] = "";
}

echo json_encode($response);
?>
