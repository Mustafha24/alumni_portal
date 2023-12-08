<?php
session_start();
include './connection.php';

if (isset($_SESSION['alumni'])) {
    
    $alumniEmail = $_SESSION['alumni'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $full_name = $_POST['full_name'];
    $graduation_year = $_POST['graduation_year'];
    $department = $_POST['department'];
    $role = $_POST['role'];
    $company = $_POST['company'];
    $package = $_POST['package'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Check if an image is uploaded
    if (isset($_FILES['image']) && $_FILES["image"]["error"] === 0) {
        $targetDir = "uploads/profiles/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $url = "./" . $targetFile; // Modify this URL accordingly
        } else {
            switch ($_FILES["image"]["error"]) {
                case 1:
                    echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                    break;
                case 2:
                    echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                    break;
                case 3:
                    echo "The uploaded file was only partially uploaded.";
                    break;
                case 4:
                    echo "No file was uploaded.";
                    break;
                case 6:
                    echo "Missing a temporary folder.";
                    break;
                case 7:
                    echo "Failed to write the file to disk.";
                    break;
                default:
                    echo "Unknown file upload error.";
            }
            exit;
        }
    }

    // Check if the image was uploaded and update the profile with the image path
    if (isset($url)) {
        $sql = "UPDATE alumni_profile
            SET full_name = '$full_name', graduation_year = '$graduation_year', department = '$department',
                role = '$role', company = '$company', package = '$package',
                phone_number = '$phone_number', address = '$address', url = '$url'
            WHERE email = '$alumniEmail'";
    } else {
        // No image uploaded, update the profile without the image path
        $sql = "UPDATE alumni_profile
            SET full_name = '$full_name', graduation_year = '$graduation_year', department = '$department',
                role = '$role', company = '$company', package = '$package',
                phone_number = '$phone_number', address = '$address'
            WHERE email = '$alumniEmail'";
    }

    if ($conn->query($sql) === true) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: ./login.php');
    exit;
}
?>
