<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link href="./assets/img/logo.png" rel="icon">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/forgot_password.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form id="sendOTPForm" action="send_otp.php" method="post">
                <div class="form-group">
                    <label for="role">Select Role:</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="alumni">Alumni</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Enter your email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Send OTP</button>
                <div class="loader"></div> <!-- Loader -->
            </form>

            <form id="verifyOTPForm" action="verify_otp.php" method="post" style="display: none;">
                <div class="form-group">
                    <label for="otp">Enter OTP:</label>
                    <input type="text" id="otp" name="otp" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Verify OTP</button>
            </form>

            <form id="setPasswordForm" style="display: none;">
                <div class="form-group">
                    <label for="newPassword">Enter New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Set New Password</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sendOTPForm').submit(function(event) {
                event.preventDefault();
                $('.loader').show(); // Show the loader
                $.ajax({
                    type: 'POST',
                    url: 'send_otp.php',
                    data: $('#sendOTPForm').serialize(),
                    success: function(response) {
                        $('.loader').hide(); // Hide the loader on success
                        if (response.trim() === "Email does not exist in alumni table" || response.trim() === "Email does not exist in student table") {
                            swal("Email Not Found!", "This email is not associated with any alumni", "warning");
                        } else {
                            swal("OTP Sent!", "Please check your email for the OTP", "success");
                            $('#sendOTPForm').hide();
                            $('#verifyOTPForm').show();
                        }
                    },
                    error: function() {
                        $('.loader').hide(); // Hide the loader on error
                        swal("Failed to send OTP!", "Please try again", "error");
                    }
                });
            });

            $('#verifyOTPForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'verify_otp.php',
                    data: $('#verifyOTPForm').serialize(),
                    success: function(response) {
                        if (response.trim() === "success") {
                            swal("OTP Verified!", "You can reset your password now", "success");
                            $('#verifyOTPForm').hide();
                            $('#setPasswordForm').show();
                        } else {
                            swal("Invalid OTP!", "Please enter the correct OTP", "error");
                        }
                    },
                    error: function() {
                        swal("Failed to verify OTP!", "Please try again", "error");
                    }
                });
            });

            $('#setPasswordForm').submit(function(event) {
                event.preventDefault();
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                if (newPassword !== confirmPassword) {
                    swal("Passwords don't match!", "Please re-enter your passwords", "error");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'update_password.php',
                        data: {
                            password: newPassword
                        },
                        dataType: 'json', 
                        success: function(response) {
                            if (response.status === "success") {
                                swal("Password Updated!", "Your password has been changed", "success").then(function() {
                                    window.location.replace("logout.php"); 
                                });
                            } else {
                                swal("Failed to update password!", "Please try again", "error");
                            }
                        },
                        error: function() {
                            swal("Failed to update password!", "Please try again", "error");
                        }
                    });
                }
            });

        });
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>