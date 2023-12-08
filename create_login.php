<?php

include './connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    if ($file["error"] == UPLOAD_ERR_OK && is_uploaded_file($file["tmp_name"])) {
        $excelData = [];
        $handle = fopen($file["tmp_name"], "r");

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $excelData[] = $data;
        }

        fclose($handle);

        $result = ["success" => true, "message" => "Data imported successfully!"];

        foreach ($excelData as $row) {
            $sno = $row[0];
            $name = $row[1];
            $email = $row[2];
            $password = $row[3];
            $role = $_POST['role']; // Added to get the selected role from the dropdown

            // Hash the password
            $hashedPassword = hashPassword($password);

            // Insert into the appropriate table based on the selected role
            if ($role == "alumni") {
                $sqlAlumni = "INSERT INTO alumni (sno, name, email, password) VALUES ('$sno', '$name', '$email', '$hashedPassword')";

                if (!$conn->query($sqlAlumni)) {
                    $result["success"] = false;
                    $result["message"] = "Error inserting into alumni table: " . $conn->error;
                    break; // Exit the loop if an error occurs
                }

                $sqlAlumniInfo = "INSERT INTO alumni_profile (id, email) VALUES ('$sno','$email')";
                
                if (!$conn->query($sqlAlumniInfo)) {
                    $result["success"] = false;
                    $result["message"] = "Error inserting into alumni_profile table: " . $conn->error;
                    break; // Exit the loop if an error occurs
                }
            } elseif ($role == "student") {
                $sqlStudent = "INSERT INTO student (sno, name, email, password) VALUES ('$sno', '$name', '$email', '$hashedPassword')";

                if (!$conn->query($sqlStudent)) {
                    $result["success"] = false;
                    $result["message"] = "Error inserting into student table: " . $conn->error;
                    break; // Exit the loop if an error occurs
                }
            }
        }

        echo json_encode($result);
        exit; // Terminate the script after sending the JSON response
    } else {
        echo json_encode(["success" => false, "message" => "File upload failed!"]);
        exit; // Terminate the script after sending the JSON response
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data</title>
    <link href="assets/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        .container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }

        .custom-file-label {
            overflow: hidden;
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Excel Upload</h2>
        <form id="uploadForm" enctype="multipart/form-data">
           
            <div class="form-group">
                <label for="role">Select Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="alumni">Alumni</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file">Choose Excel File (CSV):</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file" accept=".csv" required>
                    <label class="custom-file-label" for="file">Choose file</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Upload</button>
        </form>
        <div id="message" class="mt-3"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function () {
        $("#uploadForm").submit(function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                type: "POST",
                url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        $("#message").html("<div class='alert alert-success'>" + result.message + "</div>");
                        Swal.fire({
                            icon: 'success',
                            title: 'Data imported successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            window.location.href = 'admin_panel.php';
                        });
                    } else {
                        $("#message").html("<div class='alert alert-danger'>" + result.message + "</div>");
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: result.message,
                            showConfirmButton: true
                        });
                    }
                },
                error: function () {
                    $("#message").html("<div class='alert alert-danger'>An unexpected error occurred.</div>");
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        showConfirmButton: true
                    });
                }
            });
        });
    });
    </script>
</body>
</html>