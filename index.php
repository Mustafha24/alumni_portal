<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="./assets/swiper/swiper-bundle.min.css" />
    <!-- Add this in the head section of your HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typed.js@2.0.12" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyOfn1PzXaUw4l2Yw9COA/JFqU5TJHbs1B" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="icon" href="./assets/img/logo2.png" />
    <title>Alumni Portal</title>
</head>

<body>

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="./assets/img/logo2.png" alt="Icon" style="height: 30px; width: 30px; margin-right: 8px;">
            Alumni Portal
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#administration">Administration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Association</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact Us</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Carousel Section -->
    <section id="home" class="carousel-section mt-5 pt-4">
        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./assets/img/ssn.png" class="d-block w-100 carousel-image" alt="Image 1">
                    <div class="carousel-overlay">
                        <div class="carousel-text">
                            <h2><span class="typed-word-1"></span><span class="typed-cursor-1">|</span></h2>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./assets/img/clg1.jpeg" class="d-block w-100 carousel-image" alt="Image 1">
                    <div class="carousel-overlay">
                        <div class="carousel-text">
                            <h2><span class="typed-word-2"></span><span class="typed-cursor-2">|</span></h2>
                        </div>
                    </div>
                </div>

                <!-- Add more carousel images as needed -->
            </div>
            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    
    <!-- Achievements and Events Section -->
    <section id="achievements-events" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Achievements and Events</h2>
        <div class="row">
            <!-- Column for Achievements -->
            <div class="col-md-6 mt-3">
                <div class="achievements" style="height: 400px; overflow-y: auto;">
                    <!-- Display Alumni Stories in Achievements Section -->
                    <div class="mt-4" id="stories">
                        <h3 class="text-center">Alumni Stories</h3>
                        <!-- You can load alumni stories here using AJAX similar to the upcoming events -->
                    </div>
                </div>
            </div>

            <!-- Column for Events -->
            <div class="col-md-6  mt-3" >
                <div class="events" style="height: 400px; overflow-y: auto;">
                    <!-- Display Upcoming Events -->
                    <div class="mt-4" id="upcomingEventsList">
                        <h3 class="text-center">Upcoming Events</h3>
                        <!-- Upcoming events will be loaded dynamically here using AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- About Us Section with AOS Animations -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="fade-up">ABOUT US</h2>
            <div class="row">
                <!-- First Row: Image on Left, Text on Right -->
                <div class="col-lg-6" data-aos="fade-up">
                    <img src="./assets/img/about1.jpg" alt="About Us" class="img-fluid">
                </div>
                <div class="col-lg-6" data-aos="fade-down">
                    <div class="about-text">
                        <h3>Engagement</h3>
                        <!-- Add Font Awesome icons before list items -->
                        <ul>
                            <li><i class="fas fa-check"></i> Stay connected with fellow alumni.</li>
                            <li><i class="fas fa-check"></i> Participate in alumni events and reunions.</li>
                            <li><i class="fas fa-check"></i> Contribute to mentoring programs for current students.</li>
                            <li><i class="fas fa-check"></i> Access exclusive resources and updates from the university.
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Second Row: Text on Left, Image on Right -->

                <div class="col-lg-6" data-aos="zoom-in">
                    <img src="./assets/img/about2.jpg" alt="About Us" class="img-fluid">
                </div>
                <div class="col-lg-6" data-aos="zoom-in">
                    <div class="about-text">
                        <h3>Career Development</h3>
                        <ul>
                            <li><i class="fas fa-check"></i> Explore job opportunities shared by alumni and employers.</li>
                            <li><i class="fas fa-check"></i> Attend career fairs and networking events.</li>
                            <li><i class="fas fa-check"></i> Access career resources, workshops, and webinars.</li>
                            <li><i class="fas fa-check"></i> Receive guidance from experienced alumni in your field.</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Administration Section with Swiper Animation -->
    <section id="administration" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="fade-up">Administration</h2>
            <div class="row">
                <!-- Chancellor -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center admin-person">
                        <img src="./assets/img/kc-reddy.jpg" alt="Chancellor" class="img-fluid">
                        <h4>Prof K.C. Reddy</h4>
                        <p>Chancellor</p>
                    </div>
                </div>

                <!-- Director -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center admin-person">
                        <img src="./assets/img/vc vijay kumar.jpg" alt="Vice-Chancellor" class="img-fluid">
                        <h4>Prof M.Vijaya Kumar</h4>
                        <p>Vice-Chancellor</p>
                    </div>
                </div>
                <!-- Officer on Special Duty (OSD) -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center admin-person">
                        <img src="./assets/img/dir.jpeg" alt="Director" class="img-fluid">
                        <h4>Dr.Bhaskar Patel</h4>
                        <p>Director</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials Section with Swiper Animation -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <h2 class="text-center" data-aos="fade-up">Testimonials</h2>
            <div class="testimonial mySwiper" data-aos="fade-up" data-aos-delay="200">
                <div class="testi-content swiper-wrapper">
                    <!-- Dynamic content will be added here using AJAX -->
                </div>
                <div class="swiper-button-next nav-btn"></div>
                <div class="swiper-button-prev nav-btn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>


    <!-- Gallery Section with Sliding Images -->
    <section id="gallery" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center">Gallery</h2>
            <div id="galleryCarousel" class="carousel slide" data-ride="carousel" data-aos="fade-up">
                <div class="carousel-inner" id="images_list">

                    <!-- Add more images as needed -->
                </div>
                <!-- Add Navigation -->
                <a class="carousel-control-prev" href="#galleryCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#galleryCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php
    require './footer.php';
    ?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="./assets/js/scripts.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- Swiper JS -->
    <script src="./assets/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        AOS.init();
    </script>

    <!-- Add this script after including the Typed.js library -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typedWordElement1 = document.querySelector('.typed-word-1');
            const typedWordElement2 = document.querySelector('.typed-word-2');

            const wordsToType = ["Welcome To Our Alumni Portal"];
            let currentIndex1 = 0;
            let currentIndex2 = 0;

            function typeWord(typedWordElement, currentIndex) {
                const wordToType = wordsToType[currentIndex];
                let currentWord = '';

                function typeCharacter() {
                    currentWord += wordToType[currentWord.length];
                    typedWordElement.textContent = currentWord;

                    if (currentWord.length < wordToType.length) {
                        setTimeout(typeCharacter, 150); // Adjust typing speed
                    } else {
                        // Start erasing after typing
                        setTimeout(() => eraseWord(typedWordElement, currentIndex), 1000); // Adjust pause before erasing
                    }
                }

                typeCharacter();
            }

            function eraseWord(typedWordElement, currentIndex) {
                const currentText = typedWordElement.textContent;
                const newText = currentText.slice(0, -1);
                typedWordElement.textContent = newText;

                if (newText.length > 0) {
                    setTimeout(() => eraseWord(typedWordElement, currentIndex), 75); // Adjust erasing speed
                } else {
                    // Move to the next word after erasing
                    const nextIndex = (currentIndex + 1) % wordsToType.length;
                    setTimeout(() => typeWord(typedWordElement, nextIndex), 500); // Adjust pause before typing again
                }
            }

            typeWord(typedWordElement1, currentIndex1);
            setTimeout(() => typeWord(typedWordElement2, currentIndex2), 2500);

            // Additional code for the rest of your script
            // ...
        });
    </script>


    <!-- Initialize Swiper for Administration Section -->

    <script>
        $(document).ready(function() {

            // Function to load testimonials dynamically
            function loadTestimonials(data) {
                const testimonialList = $('#to_load_testimonials');
                testimonialList.empty(); // Clear the previous testimonials
                $.each(data, function(key, val) {
                    const testimonialCard = `
    <div class="swiper-slide">
        <div class="testimonial-wrap">
            <div class="testimonial-item">
                <img src="${val.url}" class="testimonial-img" alt="${val.name}">
                <h3>${val.name}</h3>
                <h4>${val.designation}</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    ${val.about}
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>
        </div>
    </div>`;
                    testimonialList.append(testimonialCard);
                });
            }

            $.ajax({
                type: "GET",
                url: "load_testimonials.php", // Replace with the actual path to your PHP script
                dataType: "json",
                success: function(data) {
                    if (data) {
                        console.log(data);

                        // Clear existing testimonials
                        $(".testi-content").empty();

                        // Iterate through the fetched testimonials and add them to the swiper wrapper
                        $.each(data, function(index, testimonial) {
                            // Create a testimonial slide and append it to the swiper wrapper
                            var testimonialSlide = $("<div class='slide swiper-slide'>" +
                                "<div class='row align-items-center'>" +
                                "<div class='col-md-4'>" +
                                "<img src='" + testimonial.url + "' alt='' class='img-fluid image' />" +
                                "</div>" +
                                "<div class='col-md-8'>" +
                                "<p>" + testimonial.about + "</p>" +
                                "<i class='bx bxs-quote-alt-left quote-icon'></i>" +
                                "<div class='details'>" +
                                "<span class='name'>" + testimonial.name + "</span>" +
                                "<span class='job'>" + testimonial.designation + "</span>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</div>");

                            $(".testi-content").append(testimonialSlide);
                        });

                        // Initialize Swiper after dynamically adding testimonials
                        var swiper = new Swiper(".mySwiper", {
                            slidesPerView: 1,
                            grabCursor: true,
                            loop: true,
                            pagination: {
                                el: ".swiper-pagination",
                                clickable: true,
                            },
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },
                        });
                    } else {
                        console.log("No data received or data is empty.");
                    }
                },
                error: function() {
                    console.log("Error loading testimonials.");
                }
            });


            $.ajax({
                type: "GET",
                url: "get_images.php", // Replace with the actual path to your PHP script
                dataType: "json",
                success: function(data) {
                    if (data) {
                        // Iterate through the fetched images and add them to the #images_list
                        $.each(data, function(index, image) {
                            // Create an image element and append it to #images_list
                            var imgElement = $("<div class='carousel-item'>" +
                                "<img src='" + image.url + "' class='d-block w-100' alt='Image " + (index + 1) + "'>" +
                                "</div>");
                            $("#images_list").append(imgElement);
                        });

                        // Activate the first item in the carousel
                        $("#images_list .carousel-item:first").addClass("active");
                    } else {
                        console.log("No data received or data is empty.");
                    }
                },
                error: function() {
                    console.log("Error fetching images.");
                }
            });

        });
    </script>


    <script>
        $('document').ready(function() {
            $.ajax({
                url: "fetch_stories.php",
                type: "POST",
                success: function(data) {
                    $.each(data, function(key, val) {
                        var storyCard = `
                            <div class="col-md-12 mb-4 mx-auto">
                                <div class="card custom-card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 text-center">
                                            <div class="profile-container d-flex align-items-center">
                                                <img src="${val.alumni_url}" class="card-img img-fluid rounded profile-img"
                                                    alt="Profile Image" style="width:100px;height:100px">
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
    <script>
        $(document).ready(function() {
            $.ajax({
    url: "fetch_events.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
        if (data.length > 0) {
            // Iterate through the fetched events and append them to the container
            $.each(data, function (index, event) {
                var eventCard = `
                    <div class="col-md-12 mb-4 mx-auto">
                        <div class="card custom-card">
                            <div class="row no-gutters">
                                <div class="col-md-4 text-center">
                                    <img src="${event.banner}" class="card-img img-fluid rounded event-img" alt="Event Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${event.title}</h5>
                                        <p class="card-text">${event.content}</p>
                                        <div class="event-schedule">
                                            <span class="calendar-icon">&#128197;</span>
                                            <div>${event.schedule}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                $('#upcomingEventsList').append(eventCard);
            });
        } else {
            // Display a message if there are no upcoming events
            $('#upcomingEventsList').append('<div class="alert alert-warning text-center" style="margin-top:25%" role="alert">No upcoming events</div>');
        }
    },
    error: function () {
        console.log('Error fetching upcoming events.');
    }
});

        });
    </script>



</body>

</html>