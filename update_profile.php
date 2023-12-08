<?php
session_start();
include './connection.php';

if (!isset($_SESSION['alumni'])) {
    header('Location: ./login.php');
    exit;
}

$alumniEmail = $_SESSION['alumni'];

// Database connection code (replace with your own)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch alumni details based on email
$sql = "SELECT * FROM alumni_profile WHERE email = '$alumniEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $alumniDetails = $result->fetch_assoc();

    // Close the database connection
    $conn->close();
} else {
    // If no matching alumni found, redirect to login
    $conn->close();
    header('Location: ./login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
    <link rel="icon" href="./assets/img/logo.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            width: 100%;
            border-style: solid;
            border-color: black;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 30px auto;
            max-width: 500px;
            background: transparent;
            backdrop-filter: blur(15px);
            background-color:#243444;
        }

        h2 {
            color: rgb(13, 143, 194);
        }

        label {
            font-weight: bold;
            color: rgb(25, 217, 234);
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            padding: 10px;
            cursor: text;
            transition: 0.2s;
        }

        .form-control {
            width: 100%;
            padding: 5px;
            margin: 30px 0;
            border-radius: 4px;
            outline: 0;
            font-size: 15px;
            color: rgb(15, 10, 10);
            border-width: 2px black;

        }

    .profile-image-container {
        width: 150px; /* Set the desired width */
        height: 150px; /* Set the desired height */
        overflow: hidden;
        border-radius: 50%;
        margin: 0 auto; /* Center the image horizontally */
        background-color: grey;
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

        .error-message {
            font-size: 1.2em;
            color: red;
            top: -10px;
        }

        .btn-info {
            color: white;
        }

        .btn-info:hover {
            color: white;
        }

        button {
            width: 30%;
            height: 40px;
            border: none;
            outline: none;
            border-radius: 80px;
            cursor: pointer;
            font-size: 1em;
            margin: 20px;
            box-shadow: 0 0 5px cyan, 0 0 25px cyan;
        }

        button:hover {
            box-shadow: 0 0 5px cyan,
                0 0 25px rgb(0, 102, 255), 0 0 50px cyan, 0 0 100px cyan, 0 0 200px cyan;
            color: white;
        }

        form {
            width: 100%;
            max-width: 600px;

        }

        .mb-3 {
            margin-bottom: 30px;
            position: relative;
        }

        input:focus~label,
        input:valid~label,
        textarea:focus~label,
        textarea:valid~label {
            top: -34px;
            font-size: 18px;
        }

        input:hover {
            border-width: 3px;

        }

        textbox,
        input[type="text"],
        input[type="number"],
        input[type="email"] {
            border-radius: 20px;
        }
    </style>
    <script>
        function validateForm() {
            var full_name = document.forms["update"]["full_name"].value;
            var email = document.forms["update"]["email"].value;
            var graduation_year = document.forms["update"]["graduation_year"].value;
            var department = document.forms["update"]["department"].value;
            var phone_number = document.forms["update"]["phone_number"].value;
            var address = document.forms["update"]["address"].value;

            var full_nameErrorMessage = document.getElementById("full_name-error");
            var emailErrorMessage = document.getElementById("email-error");
            var graduation_yearErrorMessage = document.getElementById("graduation_year-error");
            var departmentErrorMessage = document.getElementById("department-error");
            var phone_numberErrorMessage = document.getElementById("phone_number-error");
            var addressErrorMessage = document.getElementById("address-error");


            full_nameErrorMessage.innerHTML = "";
            emailErrorMessage.innerHTML = "";
            graduation_yearErrorMessage.innerHTML = "";
            departmentErrorMessage.innerHTML = "";
            phone_numberErrorMessage.innerHTML = "";
            addressErrorMessage.innerHTML = "";


            var isValid = true;

            if (full_name === "") {
                full_nameErrorMessage.innerHTML = "Name must be filled out";
                isValid = false;
            }
            if (email === "") {
                emailErrorMessage.innerHTML = "Email is required";
                isValid = false;
            } else if (!validateEmail(email)) {
                emailErrorMessage.innerHTML = "Email must be valid";
                isValid = false;
            }

            if (graduation_year === "") {
                graduation_yearErrorMessage.innerHTML = "graduation year must be filled out";
                isValid = false;
            }
            if (department === "") {
                departmentErrorMessage.innerHTML = "department must be filled out";
                isValid = false;
            }
            if (phone_number === "") {
                phone_numberErrorMessage.innerHTML = "phone_number must be filled out";
                isValid = false;
            } else if (phone_number.length !== 10) {
                phone_numberErrorMessage.innerHTML = "Phone number must be 10 digits";
                isValid = false;
            }
            if (address === "") {
                addressErrorMessage.innerHTML = "address must be filled out";
                isValid = false;
            }
            return isValid;
        }

        function validateEmail(email) {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email);
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Update Your Alumni Profile</h2>
        <div class="profile-image-container mb-3">
            <img id="profile-image" class="profile-image" src="<?php echo $alumniDetails['url']; ?>" alt="Profile Image">
        </div>
        <form name="update" id="update-profile-form" enctype="multipart/form-data" onsubmit="return validateForm()" method="post" novalidate>
            <div class="mb-3">

                <input type="text" class="form-control" id="full_name" name="full_name" required>
                <label for="full_name" class="form-label">Full Name:</label>
                <div class="error-message" id="full_name-error"></div>
            </div>

            <div class="mb-3">

                <input type="number" class="form-control" id="graduation_year" name="graduation_year" required>
                <label for="graduation_year" class="form-label">Graduation Year:</label>
                <div class="error-message" id="graduation_year-error"></div>
            </div>
            <div class="mb-3">

                <input type="text" class="form-control" id="department" name="department" required>
                <label for="department" class="form-label">Department:</label>
                <div class="error-message" id="department-error"></div>
            </div>
            <div class="mb-3">

                <input type="email" class="form-control" id="email" name="email" required>
                <label for="text" class="form-label">Email:</label>
                <div class="error-message" id="email-error"></div>
            </div>
            <div class="mb-3">

                <input type="text" class="form-control" id="role" name="role" required>
                <label for="role" class="form-label">Role</label>
                <div class="error-message" id="role-error"></div>
            </div>
            <div class="mb-3">


                <input type="text" class="form-control" id="company" name="company" required>
                <label for="company" class="form-label">Working At:</label>
                <div class="error-message" id="company-error"></div>
            </div>
            <div class="mb-3">


                <input type="number" class="form-control" id="package" name="package" required>
                <label for="package" class="form-label">Package:</label>
                <div class="error-message" id="package-error"></div>
            </div>
            <div class="mb-3">

                <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                <label for="phone_number" class="form-label">Phone Number:</label>
                <div class="error-message" id="phone_number-error"></div>
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
                <label for="address" class="form-label">Address:</label>
                <div class="error-message" id="address-error"></div>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" id="profile_image" name="image">
                <label for="image" class="form-label">Profile Image:</label>
                <div class="error-message" id="profile_image-error"></div>
            </div>
            <button type="submit" class="btn btn-info" id="update-profile-button">Update Profile</button>
            <button type="button" class="btn btn-info"><a href="./index.php" style="all:unset">Back To Home</a></button>

        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            $(document).ready(function() {
                var email = '<?php echo $_SESSION['alumni']; ?>';
                $('#email').val(email);

                $('#full_name').val('<?php echo $alumniDetails['full_name']; ?>');
                $('#graduation_year').val('<?php echo $alumniDetails['graduation_year']; ?>');
                $('#department').val('<?php echo $alumniDetails['department']; ?>');
                $('#email').val('<?php echo $alumniDetails['email']; ?>');
                $('#role').val('<?php echo $alumniDetails['role']; ?>');
                $('#company').val('<?php echo $alumniDetails['company']; ?>');
                $('#package').val('<?php echo $alumniDetails['package']; ?>');
                $('#phone_number').val('<?php echo $alumniDetails['phone_number']; ?>');
                $('#address').val('<?php echo $alumniDetails['address']; ?>');


                // Select the form by its ID
                var form = $('#update-profile-form');

                // Attach a submit event listener to the form
                form.submit(function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    var formData = new FormData(form[0]);


                    // Send an AJAX POST request to the server
                    $.ajax({
                        type: 'POST',
                        url: 'handle_profile.php',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            // alert(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Profile Updated!',
                                text: 'Your profile has been successfully updated.',
                            }).then(() => {
                                // Reset the form
                                form.trigger('reset');
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again.',
                            });
                        }
                    });
                });
            });
        </script>


    </div>
</body>

</html>