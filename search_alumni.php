<?php
include './connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search for alumni by name
if (isset($_POST['search'])) {
    $searchName = $_POST['searchName'];
    $query = "SELECT id, full_name, email FROM alumni_profile WHERE full_name LIKE '%$searchName%'";
    $result = $conn->query($query);

    $alumniList = [];
    while ($row = $result->fetch_assoc()) {
        $alumniList[] = $row;
    }

    echo json_encode($alumniList);
    exit();
}

// Alumni Details
if (isset($_POST['alumniDetails'])) {
    $alumniID = $_POST['alumniDetails'];

    // Fetch alumni details
    $query = "SELECT * FROM alumni_profile WHERE id = $alumniID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $alumniData = $result->fetch_assoc();
        echo json_encode($alumniData);
    } else {
        echo "Alumni details not found.";
    }

    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .modal-body {
        background-color: #f8f9fa; /* Set background color */
        padding: 20px; /* Add padding for content */
    }

    .alumni-detail {
        border-bottom: 1px solid #ddd; /* Add border between details */
        padding: 10px 0; /* Add padding to details */
    }

    .alumni-detail strong {
        margin-right: 10px; /* Add spacing between label and value */
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Search Alumni</h2>
        <form action="alumni.php" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search by name" name="searchName" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="search">Search</button>
                </div>
            </div>
        </form>
        <div class="row" id="alumniCards"></div>
    </div>

    <!-- Alumni Details Modal -->
<div class="modal fade" id="alumniModal" tabindex="-1" role="dialog" aria-labelledby="alumniModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alumniModalLabel">Alumni Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="alumni-detail"><strong>Full Name:</strong> <span id="alumniFullName"></span></p>
                            <p class="alumni-detail"><strong>Graduation Year:</strong> <span id="alumniGradYear"></span></p>
                            <p class="alumni-detail"><strong>Department:</strong> <span id="alumniDepartment"></span></p>
                            <p class="alumni-detail"><strong>Email:</strong> <span id="alumniEmail"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="alumni-detail"><strong>Role:</strong> <span id="alumniRole"></span></p>
                            <p class="alumni-detail"><strong>Company:</strong> <span id="alumniCompany"></span></p>
                            <p class="alumni-detail"><strong>Package:</strong> <span id="alumniPackage"></span></p>
                            <p class="alumni-detail"><strong>Phone Number:</strong> <span id="alumniPhoneNumber"></span></p>
                            <p class="alumni-detail"><strong>Address:</strong> <span id="alumniAddress"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('document').ready(function() {
            $(document).on('click', '.view-details', function() {
                var alumniID = $(this).data('alumni-id');

                $.ajax({
                    url: 'search_alumni.php',
                    type: 'POST',
                    data: {
                        'alumniDetails': alumniID
                    },
                    // Success callback in your AJAX request
                    success: function(data) {
                        var alumniDetails = JSON.parse(data);

                        // Update modal content with alumni details
                        $('#alumniFullName').text(alumniDetails.full_name);
                        $('#alumniGradYear').text(alumniDetails.graduation_year);
                        $('#alumniDepartment').text(alumniDetails.department);
                        $('#alumniEmail').text(alumniDetails.email);
                        $('#alumniRole').text(alumniDetails.role);
                        $('#alumniCompany').text(alumniDetails.company);
                        $('#alumniPackage').text(alumniDetails.package);
                        $('#alumniPhoneNumber').text(alumniDetails.phone_number);
                        $('#alumniAddress').text(alumniDetails.address);
                    }

                });
            });


            $('form').submit(function(e) {
                e.preventDefault();
                var searchName = $('input[name="searchName"]').val();

                $.ajax({
                    url: 'search_alumni.php',
                    type: 'POST',
                    data: {
                        'search': 'true',
                        'searchName': searchName
                    },
                    success: function(data) {
                        console.log(data)
                        var alumniList = JSON.parse(data);

                        var alumniCards = $('#alumniCards');
                        alumniCards.empty();

                        alumniList.forEach(function(alumni) {
                            var alumniCard = `
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">NAME: ${alumni.full_name}</h5>
                                            <p class="card-text">EMAIL: ${alumni.email}</p>
                                        </div>
                                        <div class="card-footer">
                                            
                                        <button type="button" class="btn btn-primary view-details" data-alumni-id="${alumni.id}" data-toggle="modal" data-target="#alumniModal">View Details</button>


                                        </div>
                                    </div>
                                </div>
                            `;

                            alumniCards.append(alumniCard);
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>