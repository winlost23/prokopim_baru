<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PROKOPIM BERAU LOGIN ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_favicon ?>">

    <!-- App css -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg">

    <!-- Log In page -->
    <div class="container">
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="<?= base_url() ?>" class="logo logo-admin"><img src="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_favicon ?>" height="55" alt="logo" class="auth-logo"></a>
                                </div>
                                <!--end auth-logo-box-->

                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 mt-5">PROKOPIM BERAU</h4>
                                    <p class="text-muted mb-0">Login</p>
                                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                                </div>
                                <!--end auth-logo-text-->


                                <form class="form-horizontal auth-form my-4" action="<?= base_url('auth/check_login') ?>" method="post">

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                                        </div>
                                    </div>
                                    <!--end form-group-->

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="userpassword" placeholder="Enter password" name="password">
                                        </div>
                                    </div>
                                    <!--end form-group-->

                                    <div class="form-group row mt-4">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-switch switch-success">
                                                <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-sm-6 text-right">
                                            <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end form-group-->

                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end form-group-->
                                </form>
                                <!--end form-->
                            </div>
                            <!--end /div-->

                            <div class="m-3 text-center text-muted">
                                <p class="">Don't have an account ? <a href="<?= base_url() ?>/authentication/auth-register.html" class="text-primary ml-2">Free Register</a></p>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end auth-page-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
    <!-- End Log In page -->




    <!-- jQuery  -->
    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/metismenu.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>/assets/js/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.slimscroll.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>