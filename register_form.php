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
        <div class="container-fluid">
            <!-- sign up page start-->
            <div class="authentication-main">
                <div class="row">
                    <div class="col-sm-12 p-0">
                        <div class="auth-innerright">
                            <div class="authentication-box">
                                <div class="text-center"><img src="./assets/images/endless-logo.png" alt=""></div>
                                <div class="card mt-4 p-4">
                                    <h4 class="text-center">NEW USER</h4>
                                    <h6 class="text-center">Enter your Username and Password For Signup</h6>
                                    <form class="theme-form" action="register.php" method="POST" onsubmit="return validateForm()">

                                        <div class="mb-3">
                                            <label class="col-form-label">User Name</label>
                                            <input class="form-control" type="text" placeholder="Enter username" name="username" id="username" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="col-form-label">Email address</label>
                                            <input class="form-control" type="email" placeholder="Enter email address" name="email" id="email" required>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-md-6 mt-0">
                                                <div class="mb-3">
                                                    <label class="col-form-label">Password</label>
                                                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="mb-3">
                                                    <label class="col-form-label">Password again</label>
                                                    <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Reenter password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-sm-4">
                                                <button class="btn btn-primary" type="submit">Sign Up</button>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-start mt-2 m-l-20">Are you already user?  <a
                                                        class="btn-link text-capitalize" href="index.php">Login</a>
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
            <!-- sign up page ends-->
        </div>
    </div>
    <!-- page-wrapper Ends-->
    <?php include_once('./pages/scripts.php') ?>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;

            if (password !== confirm_password) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>