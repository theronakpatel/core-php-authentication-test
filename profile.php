<!DOCTYPE html>
<html lang="en">
<?php include_once('./pages/header.php') ?>

<body>
    <?php
    // Start the session to access user data
    session_start();
    $username = '';
    $email = '';
    $last_login = '';
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Include the database connection file
        require_once("db.php");

        // Retrieve user information based on the session user ID
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT username, email, last_login FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($username, $email, $last_login);
        $stmt->fetch();
        $stmt->close();

    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login_form.php");
        exit();
    }
    ?>

    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader bg-white">
            <div class="whirly-loader"> </div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper box-layout">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left col-auto px-0 d-lg-none">
                    <div class="logo-wrapper"><a href="index.html"><img src="assets/images/endless-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="vertical-mobile-sidebar col-auto ps-3 d-none"><i class="fa fa-bars sidebar-bar"></i></div>
                <div class="mobile-sidebar col-auto ps-0 d-block">
                    <div class="media-body switch-sm">
                        <label class="switch"><a href="#"><i id="sidebar-toggle"
                                    data-feather="align-left"></i></a></label>
                    </div>
                </div>
                <div class="nav-right col p-0">
                    <ul class="nav-menus">
                        <li>
                            <form class="form-inline search-form" action="#" method="get">
                                <div class="form-group me-0">
                                    <div class="Typeahead Typeahead--twitterUsers">
                                        <div class="u-posRelative">
                                            <input class="Typeahead-input form-control-plaintext" id="demo-input"
                                                type="text" name="q" placeholder="Search...">
                                            <div class="spinner-border Typeahead-spinner" role="status"><span
                                                    class="sr-only">Loading...</span></div><span
                                                class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                                        </div>
                                        <div class="Typeahead-menu"></div>
                                    </div>
                                </div>
                            </form>
                        </li>

                        <li class="onhover-dropdown">
                            <div class="media align-items-center"><img
                                    class="align-self-center pull-right img-50 rounded-circle"
                                    src="assets/images/dashboard/user.png" alt="header-user">
                                <div class="dotted-animation"><span class="animate-circle"></span><span
                                        class="main-circle"></span></div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div p-20">
                                <li><a href="edit_profile.php"><i data-feather="user"></i> Edit Profile</a></li>
                                <li><a href="change_password.php"><i data-feather="lock"></i> Change Password</a></li>
                                <li><a href="logout.php"><i data-feather="log-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
                </div>
                <script id="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"><?= $username ?></div>
            </div>
            </div>
          </script>
                <script id="empty-template" type="text/x-handlebars-template">
                    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
          </script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Right sidebar Start-->
            <?php include_once('./pages/sidebar.php') ?>
            <!-- Right sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="user-profile">
                        <div class="row">
                            <!-- user profile first-style start-->
                            <div class="col-sm-12">
                                <div class="card hovercard text-center">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-user"></i>  Username</h6>
                                                            <span><?= $username ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-envelope"></i>  Email</h6>
                                                            <span><?= $email ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-lock"></i>  Last Login</h6>
                                                            <span><?= $last_login ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->

        </div>
    </div>
    <?php include_once('./pages/scripts.php') ?>
</body>

</html>