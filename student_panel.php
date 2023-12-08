<?php
session_start();
if (!isset($_SESSION['student_email'])) {
    header('Location: ./login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" href="./assets/img/logo2.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }

        .toggler-icon {
            color: black;
            font-size: 28px;
            margin: 10px;
            cursor: pointer;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
        }

        nav {
            background-color: #333;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            width: 230px;
            left: -230px;
            transition: left 0.3s;
        }

        nav h3 pre{
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            margin-top:10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 12px;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        nav a:hover {
            background-color: #555;
            color: cyan;
        }

        nav h3 pre:hover {
            color: cyan;
        }

        nav a.active {
            background-color: #555;
        }

        .content-container {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        @media (min-width: 768px) {
            nav {
                left: 0;
            }

            .content-container {
                margin-left: 230px;
            }
        }
    </style>
</head>

<body class="d-flex">

    
    <span class="toggler-icon" onclick="toggleSidebar()"><i class="bi bi-list"></i></span>

    <nav class="flex-column p-3" id="sidebar">
        <h3 style="margin-left:50px;">STUDENT PANEL</h3>
        <a href="./index.php" class="nav-link" onclick="toggleSidebar()"><i class="bi bi-house-door"></i> Home</a>
        <a href="./show_jobs.php" class="nav-link" onclick="toggleSidebar()"><i class="bi bi-card-text"></i> Show Jobs</a>
        <a href="./insights.php" class="nav-link" onclick="toggleSidebar()"><i class="bi bi-megaphone-fill"></i> Discussion Forums</a>
        <a href="./forgot_password.php" class="nav-link" onclick="toggleSidebar()"><i class="bi bi-key"></i> Reset Password</a>
        <a href="./logout.php" class="nav-link" onclick="toggleSidebar()"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </nav>

    <div class="content-container flex-grow-1" id="content">
        <!-- Content will be loaded here -->
        <h3 class="text-center">STUDENT PANEL</h3>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function toggleSidebar() {
            var sidebar = $('#sidebar');
            var contentContainer = $('.content-container');

            if (sidebar.css('left') === '0px') {
                sidebar.css('left', '-230px');
                contentContainer.css('margin-left', '0');
            } else {
                sidebar.css('left', '0');
                contentContainer.css('margin-left', '230px');
            }
        }

        $(document).ready(function() {
            $('.nav-link').click(function(e) {
                e.preventDefault();
                var href = $(this).attr('href');

                if (href === './index.php' || href==="./logout.php") {
                    window.location.href =href;
                } else {
                    loadContent(href);
                    toggleSidebar();
                    $('.nav-link').removeClass('active'); 
                    $(this).addClass('active'); 
                }
            });

            function loadContent(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('#content').html(data);
                    },
                    error: function() {
                        $('#content').html('Error loading content.');
                    }
                });
            }
        });
    </script>

</body>

</html>
