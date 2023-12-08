<?php
session_start();
if(isset($_SESSION['admin'])){
  header("Location:./admin_panel.php");
}
elseif(isset($_SESSION['alumni'])){
  header("Location:./alumni_panel.php");
}
elseif(isset($_SESSION['student_email'])){
  header("Location:./student_panel.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <!-- Favicons -->
  <link href="./assets/img/logo2.png" rel="icon">
  <style>
    #submit {
      background-color: transparent;
      border: none;
      font-weight: bolder;
      padding: 10px 20px;
      color: white;
      text-align: center;
      text-decoration: none;
      font-size: 20px;
      border-radius: 5px;
    }

    #forgotPassword {
      color: #3498db;
      text-decoration: none;
      font-size: 14px;
      margin-top: 10px;
      display: inline-block;
    }

    #forgotPassword:hover {
      text-decoration: none;
    }
  </style>
  <link href="./assets/css/login2.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>

<body>

  <div class="login-box">
    <h2>Login</h2>
    <form action="./validate.php" method="POST">
      <div class="user-box">
        <select class="role-dropdown" name="role" id="role">
          <option value="select">Select Role</option>
          <option value="admin">Admin</option>
          <option value="alumni">Alumni</option>
          <option value="student">Student</option>
        </select>
        <label style="background-color:transparent;margin-top:-10px;">User Role</label>
      </div>
      <div class="user-box">
        <input type="text" name="email" id="email">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" id="password">
        <label>Password</label>
      </div>
      <!-- Add the dropdown select element -->
      <a href="./forgot_password.php" id="forgotPassword">Forgot Password?</a>

      <div class="submit">
        <a href="#">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <input type="submit" value="Submit" name="submit" id="submit" />
        </a>
      </div>
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $('#submit').on('click', function (e) {
      var role = $('#role').val();
      var email = $('#email').val();
      var password = $('#password').val();
      e.preventDefault()
      $.ajax({
        url: './validate.php',
        data: {
          role: role,
          email: email,
          password: password
        },
        type: "POST",
        dataType: "JSON",
        success: function (resp) {
          if (resp.status == true) {
            window.location.href = resp.url;
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Invalid Credentials',
              text: 'Please check your email and password',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            });
          }
        }
      })
    })
  </script>

</body>

</html>
