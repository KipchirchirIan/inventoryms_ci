<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?= link_tag('assets/modules/bootstrap/css/bootstrap.min.css'); ?>
    <?= link_tag('assets/modules/fontawesome/css/all.min.css'); ?>

    <title>Super Admin | Login</title>
    <style>
        .form-container {
            width: 30% !important;
            margin-top: 75px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="#">IMS</a>
</nav>

<div class="container">

    <div class="mx-auto card p-4 form-container">
        <div class="text-center pb-4">
            <p class="h5">Inventory Management System</p>
            <p class="h6 text-muted">Super Admin Login</p>
        </div>
        <?php if (session()->has('error_message')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error_message'); ?>
        </div>
        <?php endif; ?>
        <form class="" action="<?= base_url('superadmin/login') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label class="sr-only" for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo isset($sadmin['email']) ? $sadmin['email'] : ''; ?>" aria-describedby="emailHelp">
                <?php if (isset($validation) && $validation->hasError('email')): ?>
                    <small class="text-danger"><?php echo $validation->getError('email'); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="sr-only" for="password">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" id="password">
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                    <small class="text-danger"><?php echo $validation->getError('password'); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" disabled>
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
        </form>
    </div>
</div>

<?= script_tag('assets/modules/jquery.min.js'); ?>
<?= script_tag('assets/modules/popper.js'); ?>
<?= script_tag('assets/modules/tooltip.js'); ?>
<?= script_tag('assets/modules/bootstrap/js/bootstrap.min.js'); ?>

</body>
</html>