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
                                        <form class="theme-form" action="login.php" method="POST">
                                            <div class="mb-3">
                                                <label class="col-form-label pt-0">Username</label>
                                                <input class="form-control" type="text" name="username" id="username"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Password</label>
                                                <input class="form-control" type="password" name="password"
                                                    id="password" required>
                                            </div>
                                            <div class="form-row mt-3">
                                                <input type="submit" class="btn btn-primary btn-block w-100"
                                                    name="LOGIN" />
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-sm-8">
                                                    <div class="text-start mt-2 m-l-20">Want to register yourself?  <a
                                                            class="btn-link text-capitalize" href="register_form.php">Signup</a>
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
</body>

</html>