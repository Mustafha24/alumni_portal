<section id="contact"> 
<footer class="footer bg-dark text-light">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 col-12 text-center mb-4">
                <h4>Connect with Us</h4>
                <ul class="social-icons">
                    <li><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter fa-2x"></i></a></li>
                    <li><a href="https://www.linkedin.com/company/alumni-rgukt-ongole"><i class="fab fa-linkedin fa-2x"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
                </ul>
            </div>
            <div class="col-md-6 col-12 text-center mb-4">

                <h4>Contact Us</h4>

                <p class="text-center">Have questions or suggestions? Reach out to us!</p>

                <form class="contact-form" id="contactForm">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name" id="name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Your Email" value="<?php echo isset($_SESSION['alumni']) ? $_SESSION['alumni'] : '' ?>" id="email" <?php echo isset($_SESSION['alumni']) ? 'disabled' : 'disabled' ?>>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Your Message" id="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="sendMessage" <?php echo isset($_SESSION['alumni']) ? ($_SESSION['alumni'] ? '' : 'disabled') : 'disabled' ?>>Send Message</button>
                    <p id="loginMessage" style="display: none; color: red; margin-top: 5px;"></p>
                    <div class="form-group" id="messageBox" style="display: none; margin-top: 10px;"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-secondary text-center mt-4 py-2">
    <a href='http://www.freevisitorcounters.com'>Freevisitorcounters.com</a> <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=910f34d75da665e741cba45411baf5e36fc01f82'></script>
<script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/1107804/t/5"></script>
        <!-- Inside the footer section -->
<p class="project-name">&copy; 2023 Alumni Project. All rights reserved.</p>
<p class="developer" title="mustafha.ahmad24@gmail.com">Developed By <a href="mailto:mustafha.ahmad24@gmail.com" style="all:unset">Mustafha Ahmad</a></p>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').submit(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var message = $('#message').val();

                if (email === '' && $('#email').prop('disabled')) {
                    $('#loginMessage').text('Please log in to submit a message.');
                    $('#loginMessage').show();
                    setTimeout(function() {
                        $('#loginMessage').hide();
                    }, 3000); 
                    return;
                }

                $('#sendMessage').prop('disabled', true);
                $('#messageBox').empty().html('Please wait, sending your message...');
                $('#messageBox').show();

                $.ajax({
                    type: 'POST',
                    url: 'connect_with_us.php',
                    data: {
                        name: name,
                        email: email,
                        message: message
                    },
                    success: function(response) {
                        if (response.includes('sent')) {
                            displayMessage('Message sent successfully to the organization!', 'success');
                            $('#contactForm')[0].reset(); // Reset the form
                        } else {
                            displayMessage('Failed to send the message.', 'error');
                        }
                        $('#sendMessage').prop('disabled', false);
                        $('#messageBox').fadeOut(3000); 
                    },
                    error: function() {
                        displayMessage('Request failed. Please try again.', 'error');
                        $('#sendMessage').prop('disabled', false);
                        $('#messageBox').fadeOut(3000); 
                    }
                });
            });
        });

        function displayMessage(message, type) {
            var messageBox = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '</div>');
            $('#messageBox').empty().append(messageBox);
        }
    </script>
</footer>
</section>