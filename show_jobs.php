<?php 
session_start();
if(!(isset($_SESSION['student_email']) || isset($_SESSION['alumni']) || isset($_SESSION['admin']))){
    header("Location:./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Jobs</title>
    <link href="assets/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .card-text {
            color: #555;
            margin-bottom: 10px;
        }

        .card-text strong {
            color: #333;
        }

        .card-body {
            padding: 15px;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Job Details</h2>
        <div class="row" id="data-container"></div>
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to retrieve and display data
            function fetchData() {
                $.ajax({
                    url: 'handle_show_jobs.php', 
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(response) {
                        $.each(response, function(index, item) {
                            $('#data-container').append(`
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title">${item.companyName}</h5>
                                            <p class="card-text"><strong>Role:</strong> ${item.roleName}</p>
                                            <p class="card-text"><strong>Salary:</strong> ${item.salary}</p>
                                            <p class="card-text"><strong>Description:</strong> ${item.description}</p>
                                            <p class="card-text"><strong>Link to Apply:</strong> ${item.url ? item.url : 'NA'}</p>
                                            <p class="card-text">Posted By: ${item.posted_by}</p>
                                            <p class="card-text">Posted At: ${item.posted_at}</p>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    },
                });
            }
            fetchData();
        });
    </script>
</body>
</html>
