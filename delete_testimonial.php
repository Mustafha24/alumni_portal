<?php
include './connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $testimonialId = $_POST["id"];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve image URL from the database
    $selectSql = "SELECT URL FROM testimonials WHERE sno = $testimonialId";
    $result = $conn->query($selectSql);
    $imageData = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        // Get the image URL
        $imageURL = $imageData['URL'];
        if ($imageURL) {
            // Delete the image
            if (unlink($imageURL)) {
                // Image deleted successfully, proceed to delete the entry in the database
                $deleteSql = "DELETE FROM testimonials WHERE sno = $testimonialId";
                if ($conn->query($deleteSql) === TRUE) {
                    echo "Testimonial and associated image deleted successfully.";
                } else {
                    echo "Error deleting testimonial: " . $conn->error;
                }
            } else {
                echo "Failed to delete image.";
            }
        } else {
            echo "Image URL not found in the database.";
        }
    } else {
        echo "No image found for the given testimonial ID.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
