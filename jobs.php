<?php
session_start();
if(!(isset($_SESSION['alumni']) || isset($_SESSION['admin']))){
    header("Location:./login.php");
}

$_SESSION['mailid']=$_SESSION['alumni']?$_SESSION['alumni']:$_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Jobs</title>
    <link rel="icon" href="./assets/img/logo.png"/>
    <!-- Include Bootstrap CSS and JS here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Job Listings</h1>

        <!-- Display job listings here -->
        <div id="jobListings"></div>
    </div>

    <button class="btn btn-primary btn-lg rounded-circle fixed-bottom fixed-right mr-4 mb-4" data-toggle="modal" data-target="#jobModal" style="width: 60px; height: 60px;">
        <i class="fas fa-plus" style="font-size: 24px;"></i>
    </button>

    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel">Add New Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <form>
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" class="form-control" id="companyName" placeholder="Enter company name">
                        </div>
                        <div class="form-group">
                            <label for="roleName">Role Name</label>
                            <input type="text" class="form-control" id="roleName" placeholder="Enter role name">
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" placeholder="Enter salary">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" placeholder="Enter job description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="link_to_apply">Link To Apply</label>
                            <input type="text" class="form-control" id="link_to_apply" placeholder="Enter URL">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter job location">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="post_job">Post Job</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery (make sure they are included before the </body> tag) -->
   <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap and Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Load job listings on page load
        loadJobListings();

        // Post job
        $('#post_job').on('click', function (e) {
            e.preventDefault();
            var formData = {
                companyName: $('#companyName').val(),
                roleName: $('#roleName').val(),
                salary: $('#salary').val(),
                description: $('#description').val(),
                location: $('#location').val(),
                link: $('#link_to_apply').val(),
                action: 'add'
            }
            $.ajax({
                type: 'POST',
                url: 'handle_jobs.php',
                data: formData,
                success: function (response) {
                    // Reset the form
                    $('#companyName').val('');
                    $('#roleName').val('');
                    $('#salary').val('');
                    $('#description').val('');
                    $('#link_to_apply').val('');
                    $('#location').val('');

                    // Close the modal
                    $('#jobModal').modal('hide');

                    // Show SweetAlert
                    showSuccessAlert(response);

                    // Reload job listings after posting
                    loadJobListings();
                },
                error: function (error) {
                    console.error('Error:', error);
                    showErrorAlert("Error posting job details.");
                }
            });
        });

        // Function to load job listings
        function loadJobListings() {
            $.ajax({
                type: 'GET',
                url: 'load_job_listings.php', // Create a new PHP file to handle loading job listings
                success: function (response) {
                    $('#jobListings').html(response);
                },
                error: function (error) {
                    console.error('Error:', error);
                    showErrorAlert("Error loading job details.");
                }
            });
        }

        // Function to delete a job
        window.deleteJob = function (jobId) {
            // Use SweetAlert for confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed deletion
                    $.ajax({
                        type: 'POST',
                        url: 'handle_jobs.php',
                        data: { action: 'delete', jobId: jobId },
                        success: function (response) {
                            showSuccessAlert(response);
                            loadJobListings(); // Reload job listings after deletion
                        },
                        error: function (error) {
                            console.error('Error:', error);
                            showErrorAlert("Error deleting job.");
                        }
                    });
                }
            });
        }

        // Function to show success alert
        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                timer: 2000, // Set a timer for auto-close (in milliseconds)
                showConfirmButton: false
            });
        }

        // Function to show error alert
        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
                timer: 2000, // Set a timer for auto-close (in milliseconds)
                showConfirmButton: false
            });
        }
    });
</script>



</body>

</html>
