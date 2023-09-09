<!DOCTYPE html>
<html lang="en">
<?php include_once('./pages/header.php') ?>

<body>
    <?php
    // Start the session to manage user sessions
    session_start();
    // Check if the user is already logged in
    if (isset($_SESSION['user_id'])) {
        // If logged in, redirect to the profile page
        header("Location: profile.php");
        exit();
    }
    ?>

    <!-- page-wrapper Start-->
    <div class="page-wrapper box-layout">
        <div class="container-fluid p-0">
            <!-- login page start-->
            <div class="authentication-main">
                <div class="row">
                    <div class="col-md-12">
                        <div class="auth-innerright">
                            <div class="authentication-box">
                                <div class="text-center"><img src="./assets/images/endless-logo.png" alt=""></div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h4>LOGIN</h4>
                                            <h6>Enter your Username and Password </h6>
                                        </div>
                                        <form class="theme-form" id="login-form">
                                            <div class="mb-3">
                                                <label class="col-form-label pt-0">Username</label>
                                                <input class="form-control" type="text" name="username" id="username" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" required>
                                            </div>
                                            <div class="mb-3">
                                                <div id="login-message"></div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <input type="submit" class="btn btn-primary btn-block w-100" name="LOGIN" value="LOGIN" />
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-sm-8">
                                                    <div class="text-start mt-2 m-l-20">Want to register yourself?  <a class="btn-link text-capitalize" href="register_form.php">Signup</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login page end-->
        </div>
    </div>
    <?php include_once('./pages/scripts.php') ?>
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Serialize the form data into a JSON object
                var formData = {
                    username: $('#username').val(),
                    password: $('#password').val()
                };

                // Send an AJAX POST request to the login.php script
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // If login is successful, redirect to another page or perform other actions
                            window.location.href = 'profile.php';
                        } else {
                            // Display the error message
                            $('#login-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        // Handle any AJAX errors here
                        $('#login-message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>