<?php
session_start();
include './connection.php';

// if (!isset($_SESSION['alumni'])) {
//     header('Location: ./login.php');
//     exit;
// }

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
    <title>Update Profile</title>
    <link rel="icon" href="./assets/img/logo.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>

        p{
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 1.3rem;
        }
        span{
            font-weight: bolder;
        }

        .container {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            box-shadow: 0px 0px 12px white, inset 0px 0px 18px grey;
            border-radius: 10px;
            width: 60ch;
            transition: box-shadow 0.3s ease;
            /* Add transition for a smooth effect */
        }

        .container:hover {
            box-shadow: 0px 0px 40px white, inset 0px 0px 40px grey;
            /* Adjust the values as needed */
        }

        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border:2px solid rgba(0,0,0,0.6);
            /* background-color: rgba(0, 0, 0, 0.3); */
        }

        .profile-details {
            padding: 1.25rem;
            margin-top: 10px;
            /* Add margin for separation from the image */
        }

        @media (max-width: 768px) {
            img {
                width: 100px;
                height: 100px;
            }

            .container {
                width: 80%;
            }
        }

        .custom-modal-width {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>

</head>

<body>

    <div class="container">
        <img class="img-fluid" src="<?php echo $alumniDetails['url']; ?>" alt="Profile Image">
        <div class="profile-details">
            <p class=""><span>Name :</span><?php echo $alumniDetails['full_name']; ?></p>
            <p class=""><span>Email :</span><?php echo $alumniDetails['email']; ?></p>
            <button type="button" class="btn btn-info" id="edit-details-button">Edit Details</button>
        </div>
    </div>


    <!-- Modal for editing details -->
    <div class="modal" id="editDetailsModal">
        <div class="modal-dialog custom-modal-width">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Alumni Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->

                <div class="modal-body">
                    <form name="update" id="update-profile-form" enctype="multipart/form-data" onsubmit="return validateForm()" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name">Full Name:</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $alumniDetails['full_name']; ?>" required>
                                    <div class="error-message" id="full_name-error"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="graduation_year">Graduation Year:</label>
                                    <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="<?php echo $alumniDetails['graduation_year']; ?>" required>
                                    <div class="error-message" id="graduation_year-error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department:</label>
                                    <input type="text" class="form-control" id="department" name="department" value="<?php echo $alumniDetails['department']; ?>">
                                    <div class="error-message" id="department-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $alumniDetails['email']; ?>" required>
                                    <div class="error-message" id="email-error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role:</label>
                                    <input type="text" class="form-control" id="role" name="role" value="<?php echo $alumniDetails['role']; ?>" required>
                                    <div class="error-message" id="role-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="company">Working At:</label>
                                    <input type="text" class="form-control" id="company" name="company" value="<?php echo $alumniDetails['company']; ?>" required>
                                    <div class="error-message" id="company-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package">Package:</label>
                                    <input type="number" class="form-control" id="package" name="package" value="<?php echo $alumniDetails['package']; ?>" required>
                                    <div class="error-message" id="package-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?php echo $alumniDetails['phone_number']; ?>" required>
                                    <div class="error-message" id="phone_number-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <textarea class="form-control" id="address" name="address" rows="4" required><?php echo $alumniDetails['address']; ?></textarea>
                                    <div class="error-message" id="address-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile_image">Profile Image:</label>
                                    <input type="file" class="form-control" id="profile_image" name="image">
                                    <div class="error-message" id="profile_image-error"></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" id="update-profile-button">Update Profile</button>

                    </form>
                </div>

                <!-- Modal Footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="update-profile-button">Update Profile</button>
                </div> -->

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function validateForm() {
            var isValid = true;

            // Reset error messages for all fields
            var fields = ['full_name', 'graduation_year', 'department', 'email', 'role', 'company', 'package', 'phone_number', 'address', 'profile_image'];
            fields.forEach(function(field) {
                document.getElementById(field + '-error').textContent = '';
            });

            // Validate Full Name
            var fullName = document.getElementById('full_name').value;
            if (fullName.trim() === '') {
                document.getElementById('full_name-error').textContent = 'Full Name is required';
                isValid = false;
            }

            // Validate Graduation Year
            var graduationYear = document.getElementById('graduation_year').value;
            if (isNaN(graduationYear) || graduationYear < 1900 || graduationYear > new Date().getFullYear()) {
                document.getElementById('graduation_year-error').textContent = 'Invalid Graduation Year';
                isValid = false;
            }

            // Validate Department
            var department = document.getElementById('department').value;
            if (department.trim() === '') {
                document.getElementById('department-error').textContent = 'Department is required';
                isValid = false;
            }

            // Validate Email
            var email = document.getElementById('email').value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('email-error').textContent = 'Invalid email address';
                isValid = false;
            }

            // Validate Role (Add similar validation for other fields)

            // ...

            return isValid;
        }
    </script>

    <script>
        $(document).ready(function() {


            $('#edit-details-button').click(function() {
                $('#editDetailsModal').modal('show');
            });


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

</body>

</html>