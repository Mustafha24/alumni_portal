<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            border-radius: 5px;
        }
        .responsive-img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container">
                <div class="form-container">
                    <h2 class="text-center">File Upload Form</h2>
                    <form action="upload_image.php" method="post" enctype="multipart/form-data" id="upload-form">
                        <div class="mb-3">
                            <label for="image" class="form-label">Select File</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for "title" class="form-label">Text Input</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </form>
                </div>
    </div>

    <h2 class="text-center mt-5">Uploaded Images</h2>
    <div  class="container text-center">
        <div class="row" id="image-list">

        </div>
        <!-- Images will be displayed here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteImage(imageId) {
            $.ajax({
                url: "delete_image.php",
                type: "POST",
                data: {
                    id: imageId
                },
                success: function(data) {
                    alert(data);
                    loadImages();
                }
            });
        }

        // Define loadImages in the global scope
        function loadImages() {
            $.ajax({
                url: "get_images.php",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let imageList = $('#image-list');
                    imageList.empty(); // Clear the previous images
                    $.each(data, function(key, val) {
                        // Create a responsive image card
                        let imageCard = `<div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="${val.url}" class="card-img-top responsive-img" alt="Image">
                                <div class="card-body">
                                    <h5 class="card-title">${val.title}</h5>
                                    <button class="btn btn-danger" onclick="deleteImage(${val.id})">Delete</button>
                                </div>
                            </div>
                        </div>`;
                        imageList.append(imageCard);
                    });
                }
            });
        }

        $(document).ready(function() {
            // Call the function to load images on page load
            loadImages();

            // Submit the upload form using AJAX
            $("#upload-form").submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(form[0]);
                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        alert(data);
                        loadImages();
                        form[0].reset();
                    }
                });
            });
        });
    </script>
</body>

</html>
