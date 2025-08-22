<?php
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once('lib/model.php');
$contacts = getRecord('contacts', 1);
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>Register Member</title>
    <link rel=icon href="<?= PATH_URL ?>public/img/<?= $contacts['favicon'] ?>" sizes="32x32">
    <!-- Custom Css -->
    <link rel="stylesheet" href="admin/themes/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/themes/css/style.min.css">
</head>

<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form method="POST" class="card auth_form" action="index.php?controller=register">
                        <div class="header">
                            <img class="logo" src="assets/images/logo.svg" alt="">
                            <h5>Sign Up</h5>
                            <span>Register a new member</span>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                </div>
                            </div>
                            <div class="checkbox">
                                <input id="remember_me" type="checkbox" required>
                                <label for="remember_me">I have read and agree to the <a href="javascript:void(0);">terms of use</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN UP</button>
                            <div class="signin_with mt-3">
                                <a class="link" href="admin.php">Already have an account? Go to "Login"!</a>
                            </div>
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear().toString())
                        </script>,
                        <span>Design: <a href="https://thememakker.com/" target="_blank">ThemeMakker</a></span><span> - Developed by <a href="https://tanhongit.com" target="_blank">TanHongIT</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="admin/themes/images/signup.svg" alt="Sign Up" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="admin/themes/bundles/libscripts.bundle.js"></script>
    <script src="admin/themes/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>

</html>
