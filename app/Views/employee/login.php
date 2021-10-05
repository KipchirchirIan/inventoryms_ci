<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Administrator</title>

    <!--  General CSS files  -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">

    <!--  CSS Libraries  -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/bootstrap-social/bootstrap-social.css') ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>
<body>

<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="<?php echo base_url("assets/img/rd_logo.jpg"); ?>" alt="logo" width="150"
                             class="shadow-light">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>Login</h4></div>

                        <div class="card-body">
                            <?php if (session()->has('error_message')) : ?>
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?= session()->get('error_message') ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <form method="post" action="<?= base_url('employee/login') ?>">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email"
                                           class="form-control <?= isset(session()->getFlashdata('validation')['email']) ? 'is-invalid' : ''; ?>"
                                           name="email" value="<?= old('email') ?? $employee['email'] ?? ''; ?>" tabindex="1" autofocus>
                                    <?php if (isset(session()->getFlashdata('validation')['email'])): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('validation')['email'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                        <div class="float-right">
                                            <a href="#"
                                               class="text-small">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <input id="password" type="password"
                                           class="form-control <?= isset(session()->getFlashdata('validation')['password']) ? 'is-invalid' : ''; ?>"
                                           name="password"
                                           tabindex="2">
                                    <?php if (isset(session()->getFlashdata('validation')['password'])): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('validation')['password'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                               id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                                <div class="text-center">
                                    <a href="<?=  base_url('admin/') ?>">Login as Admin</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center">
                        Don't have an account? <a href="#">Contact Administrator</a>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; BitRev Labs <?= date('Y') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="<?= base_url("assets/modules/jquery.min.js") ?>"></script>
<script src="<?= base_url("assets/modules/popper.js") ?>"></script>
<script src="<?= base_url("assets/modules/tooltip.js") ?>"></script>
<script src="<?= base_url("assets/modules/bootstrap/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("assets/modules/nicescroll/jquery.nicescroll.min.js") ?>"></script>
<script src="<?= base_url("assets/modules/moment.min.js") ?>"></script>
<script src="<?= base_url("assets/js/stisla.js") ?>"></script>

<!-- Template JS File -->
<script src="<?= base_url("assets/js/scripts.js") ?>"></script>
<script src="<?= base_url("assets/js/custom.js") ?>"></script>
</body>
</html>