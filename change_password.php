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
                                <li><a href="edit_profile.php"><i data-feather="user"></i> Change Password</a></li>
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
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <div class="page-header-left">
                                    <h3>Change Password</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">Profile</li>
                                        <li class="breadcrumb-item active">Change Password</li>
                                    </ol>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="edit-profile">
                        <div class="row">
                            <div class="col-xl-12">
                                <form class="card" action='update_password.php' method='POST' id="passwordChangeForm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Current Password</label>
                                                    <input class="form-control" type="password" name="current_password"
                                                        id="current_password" required placeholder="Current Password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">New Password</label>
                                                    <input class="form-control" type="password" name="new_password"
                                                        id="new_password" required placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Reenter New Password</label>
                                                    <input class="form-control" type="password"
                                                        name="confirm_new_password" id="confirm_new_password" required
                                                        placeholder="Reenter New Password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <div id="message"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">Change Password</button>
                                    </div>
                                </form>
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
    <script>
    $(document).ready(function() {
        $("#passwordChangeForm").submit(function(e) {
            e.preventDefault();

            var currentPassword = $("#current_password").val();
            var newPassword = $("#new_password").val();
            var confirmNewPassword = $("#confirm_new_password").val();

            $.ajax({
                type: "POST",
                url: "update_password.php",
                data: {
                    current_password: currentPassword,
                    new_password: newPassword,
                    confirm_new_password: confirmNewPassword
                },
                success: function(response) {
                    if (response.success) {
                        // Profile updated successfully
                        $("#message").html("<div class='alert alert-success'>" + response
                            .message + "</div>");
                        $("#current_password").val('');
                        $("#new_password").val('');
                        $("#confirm_new_password").val('');
                    } else {
                        // Profile update encountered an error
                        $("#message").html("<div class='alert alert-danger'>" + response
                            .message + "</div>");
                    }
                },
                dataType: 'json' // Specify that the response should be treated as JSON
            });
        });

    });
    </script>
</body>

</html>