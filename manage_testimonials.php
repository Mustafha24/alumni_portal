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
            width:100px;
            height:100px;
            border-radius: 50%;
            height: auto;
            margin:0 auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Testimonial Upload Form</h2>
            <form action="upload_testimonial.php" method="post" enctype="multipart/form-data" id="testimonial-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation">
                </div>
                <div class="mb-3">
                    <label for="about" class="form-label">About</label>
                    <textarea class="form-control" id="about" name="about" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Add Testimonial</button>
            </form>
        </div>
    </div>

    <h2 class="text-center mt-5">Testimonials</h2>
    <div class="container text-center">
        <div class="row" id="testimonial-list">
            <!-- Testimonials will be displayed here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteTestimonial(testimonialId) {
            $.ajax({
                url: "delete_testimonial.php",
                type: "POST",
                data: {
                    id: testimonialId
                },
                success: function(data) {
                    alert(data);
                    loadTestimonials();
                }
            });
        }

        function loadTestimonials() {
            $.ajax({
                url: "load_testimonials.php",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let testimonialList = $('#testimonial-list');
                    testimonialList.empty(); // Clear the previous testimonials
                    $.each(data, function(key, val) {
                        // Create a testimonial card
                        let testimonialCard = `<div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="${val.url}" class="card-img-top responsive-img img-fluid" alt="${val.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${val.name}</h5>
                                    <p class="card-text">${val.designation}</p>
                                    <p class="card-text">${val.about}</p>
                                    <button class="btn btn-danger" onclick="deleteTestimonial(${val.sno})">Delete</button>
                                </div>
                            </div>
                        </div>`;
                        testimonialList.append(testimonialCard);
                    });
                }
            });
        }

        $(document).ready(function() {
            
            loadTestimonials();

            $("#testimonial-form").submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(form[0]);
                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData, 
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        alert(data);
                        loadTestimonials();
                        form[0].reset();
                    }
                });
            });
        });
    </script>
</body>

</html>