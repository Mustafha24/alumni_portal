<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if (isset($_FILES['image'])) {
    if ($_FILES["image"]["error"] === 0) {
        $targetDir = "uploads/gallery/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $title = $_POST['title'];

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save the image URL in the database
            $conn = new mysqli("localhost", "root", "Ahmad@lapi74", "test");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $url = "./" . $targetFile; // Modify this URL accordingly
            $sql = "INSERT INTO images (title, url) VALUES ('$title', '$url')";

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
