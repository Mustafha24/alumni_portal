<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="assets/img/logo.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Stories</title>

    <style>

body {
            background-image: url('./assets/img/curtain.jpg');
            background-size: cover;
            background-attachment: fixed;
            /* Add other styling as needed */
        }

        .profile-container {
            width: 100px;
            height:100px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            /* border-radius: 50%; */
            margin-top: 20px;
            margin-left: 50px;
        }

        .custom-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .custom-card:hover {
            transform: scale(1.03);
        }

        .profile-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: auto;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            color: #007bff;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.4;
        }

        .text-muted {
            color: #777;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row justify-content-center" id="stories">
            <!-- Your cards go here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('document').ready(function() {
            $.ajax({
                url: "fetch_stories.php",
                type: "POST",
                success: function(data) {
                    console.log(data);
                    $.each(data, function(key, val) {
                        var storyCard = `
                            <div class="col-md-8 mb-4 mx-auto">
                                <div class="card custom-card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 text-center">
                                            <div class="profile-container d-flex align-items-center">
                                                <img src="${val.alumni_url}" class="card-img img-fluid rounded profile-img"
                                                    alt="Profile Image">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">${val.story_title}</h5>
                                                <p class="card-text">
                                                    <span class="fa fa-quote-left " style="color:gold;"></span>
                                                    ${val.story_content}
                                                    <span class="fa fa-quote-right " style="color:gold;"></span>
                                                </p>
                                                <p class="card-text text-muted">Posted by: ${val.alumni_id}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#stories').append(storyCard);
                    });
                }
            });
        });
    </script>
</body>

</html>