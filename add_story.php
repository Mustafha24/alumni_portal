<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Story</title>
    <link href="assets/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0d8fc2;
        }

        label {
            font-weight: bold;
            color: #19d9ea;
        }

        .form-control {
            margin-bottom: 20px;
        }

        button {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Share Your Success Story</h2>
        <form method="post" id="success-story-form">
            <div class="mb-3">
                <label for="story_title" class="form-label">Story Title:</label>
                <input type="text" class="form-control" id="story_title" name="story_title" required>
            </div>
            <div class="mb-3">
                <label for="story_content" class="form-label">Story Content:</label>
                <textarea class="form-control" id="story_content" name="story_content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Success Story</button>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var form = $('#success-story-form');
            form.submit(function (e) {
                e.preventDefault(); 
                var formData = form.serialize();
                $.ajax({
                    type: 'POST',
                    url: 'handle_story.php',
                    data: formData,
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your success story has been submitted successfully.',
                        });
    
                        form.trigger('reset');
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong! Please try again.',
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
