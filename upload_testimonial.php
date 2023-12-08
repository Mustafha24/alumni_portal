<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include './connection.php';

if (isset($_FILES['image'])) {
    if ($_FILES["image"]["error"] === 0) {
        $targetDir = "uploads/testimonials/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $name = $_POST['name'];
        $designation=$_POST['designation'];
        $about=$_POST['about'];
        echo "<script>alert('$designation')</script>";
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save the image URL in the database

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $url = "./" . $targetFile; // Modify this URL accordingly
            $sql = "INSERT INTO testimonials(NAME,DESIGNATION,ABOUT,URL) VALUES ('$name','$designation','$about', '$url')";

            if ($conn->query($sql) === true) {
                echo "Image uploaded successfully!";
            } else {
                echo "SQL Error: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Error uploading the image.";
        }
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
    }
}
?>
